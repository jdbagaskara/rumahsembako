<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Handle Add/Edit/Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $code = $_POST['code'];
        if (empty($code)) {
            $maxResult = $conn->query("SELECT MAX(id) as max_id FROM products");
            $maxRow = $maxResult->fetch_assoc();
            $next_id = ($maxRow['max_id'] ? $maxRow['max_id'] : 0) + 1;
            $code = 'PRD-' . date('ym') . '-' . str_pad($next_id, 4, '0', STR_PAD_LEFT);
        }
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $base_unit_id = $_POST['base_unit_id'];
        $price_buy_offline = $_POST['price_buy_offline'];
        $price_buy_online = $_POST['price_buy_online'];
        $exp_date = $_POST['exp_date'];

        $stmt = $conn->prepare("INSERT INTO products (code, name, category_id, base_unit_id, price_buy_offline, price_buy_online, exp_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiddds", $code, $name, $category_id, $base_unit_id, $price_buy_offline, $price_buy_online, $exp_date);
        $stmt->execute();
    } elseif ($_POST['action'] == 'edit') {
        $id = $_POST['id'];
        $code = $_POST['code'];
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $base_unit_id = $_POST['base_unit_id'];
        $price_buy_offline = $_POST['price_buy_offline'];
        $price_buy_online = $_POST['price_buy_online'];
        $exp_date = $_POST['exp_date'];

        $stmt = $conn->prepare("UPDATE products SET code=?, name=?, category_id=?, base_unit_id=?, price_buy_offline=?, price_buy_online=?, exp_date=? WHERE id=?");
        $stmt->bind_param("ssidddsi", $code, $name, $category_id, $base_unit_id, $price_buy_offline, $price_buy_online, $exp_date, $id);
        $stmt->execute();
    } elseif ($_POST['action'] == 'delete') {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    header("Location: master_produk.php");
    exit;
}

$query = "SELECT p.*, c.name as category_name, u.name as unit_name
          FROM products p
          LEFT JOIN categories c ON p.category_id = c.id
          LEFT JOIN units u ON p.base_unit_id = u.id
          ORDER BY p.id DESC";
$products = $conn->query($query);
$categories = $conn->query("SELECT * FROM categories ORDER BY name ASC");
$units = $conn->query("SELECT * FROM units ORDER BY name ASC");

// Fetch for modals
$cat_options = '';
while($c = $categories->fetch_assoc()) {
    $cat_options .= '<option value="'.$c['id'].'">'.htmlspecialchars($c['name']).'</option>';
}

$unit_options = '';
while($u = $units->fetch_assoc()) {
    $unit_options .= '<option value="'.$u['id'].'">'.htmlspecialchars($u['name']).'</option>';
}

$script = '
    <script>
       let table = new DataTable("#dataTable");

       function editProduct(id, code, name, cat, unit, pbuy_offline, pbuy_online, exp) {
           $("#edit_id").val(id);
           $("#edit_code").val(code);
           $("#edit_name").val(name);
           $("#edit_category_id").val(cat);
           $("#edit_base_unit_id").val(unit);
           $("#edit_price_buy_offline").val(pbuy_offline);
           $("#edit_price_buy_online").val(pbuy_online);
           $("#edit_exp_date").val(exp);
           $("#editModal").modal("show");
       }

       function manageUnitPrices(productId, productName) {
           $("#manage_product_id").val(productId);
           $("#manage_product_name").text(productName);
           loadUnitPrices(productId);
           $("#unitPriceModal").modal("show");
       }

       function loadUnitPrices(productId) {
           $.get("api_get_product_prices.php", { product_id: productId }, function(data) {
               var html = "";
               if (data.prices && data.prices.length > 0) {
                   data.prices.forEach(function(price) {
                       html += `
                           <tr>
                               <td>
                                   <input type="hidden" class="edit-unit-id" value="${price.unit_id}">
                                   <span class="unit-name">${price.unit_name}</span>
                               </td>
                               <td>
                                   <input type="number" class="form-control price-sell-input"
                                          value="${price.price_sell}" step="0.01" min="0">
                               </td>
                               <td>
                                   <button class="btn btn-success btn-sm" onclick="saveUnitPrice(${productId})">
                                       <iconify-icon icon="lucide:save"></iconify-icon>
                                   </button>
                                   <button class="btn btn-danger btn-sm" onclick="deleteUnitPrice(${productId}, ${price.unit_id})">
                                       <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                   </button>
                               </td>
                           </tr>
                       `;
                   });
               } else {
                   html = `<tr><td colspan="3" class="text-center text-muted">Belum ada harga jual per satuan</td></tr>`;
               }
               $("#unitPricesBody").html(html);
           });
       }

       function saveUnitPrice(productId) {
           var row = $(event.target).closest("tr");
           var unitId = row.find(".edit-unit-id").val();
           var priceSell = row.find(".price-sell-input").val();

           $.post("api_save_product_price.php", {
               action: "save_price",
               product_id: productId,
               unit_id: unitId,
               price_sell: priceSell
           }, function(data) {
               if (data.success) {
                   alert("Harga berhasil disimpan");
                   loadUnitPrices(productId);
               } else {
                   alert("Gagal menyimpan: " + data.message);
               }
           });
       }

       function deleteUnitPrice(productId, unitId) {
           if (confirm("Hapus harga jual untuk satuan ini?")) {
               $.post("api_save_product_price.php", {
                   action: "delete_price",
                   product_id: productId,
                   unit_id: unitId
               }, function(data) {
                   if (data.success) {
                       loadUnitPrices(productId);
                   } else {
                       alert("Gagal menghapus: " + data.message);
                   }
               });
           }
       }

       function showAddUnitPrice(productId) {
           $.get("api_get_units_no_price.php", { product_id: productId }, function(data) {
               if (data.units && data.units.length > 0) {
                   var options = "";
                   data.units.forEach(function(unit) {
                       options += `<option value="${unit.id}">${unit.name}</option>`;
                   });
                   $("#add_unit_id").html(options);
                   $("#addUnitPriceSection").show();
               } else {
                   alert("Semua satuan sudah memiliki harga jual");
               }
           });
       }

       function addNewUnitPrice(productId) {
           var unitId = $("#add_unit_id").val();
           var priceSell = $("#add_price_sell").val();

           if (!unitId || !priceSell) {
               alert("Pilih satuan dan masukkan harga jual");
               return;
           }

           $.post("api_save_product_price.php", {
               action: "save_price",
               product_id: productId,
               unit_id: unitId,
               price_sell: priceSell
           }, function(data) {
               if (data.success) {
                   $("#add_price_sell").val("");
                   $("#addUnitPriceSection").hide();
                   loadUnitPrices(productId);
               } else {
                   alert("Gagal menambah: " + data.message);
               }
           });
       }
    </script>
';
?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Master Produk</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Master Produk</li>
                </ul>
            </div>

            <div class="card basic-data-table">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Data Produk Barang</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Produk</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Satuan Dasar</th>
                                    <th scope="col">Harga Beli (Offline)</th>
                                    <th scope="col">Harga Beli (Online)</th>
                                    <th scope="col">Harga Jual</th>
                                    <th scope="col">Expired Date</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $products->data_seek(0);
                                while($row = $products->fetch_assoc()):
                                    // Get unit prices count
                                    $pid = $row['id'];
                                    $priceCount = 0;
                                    $priceQuery = $conn->query("SELECT COUNT(*) as cnt FROM product_unit_prices WHERE product_id = $pid");
                                    if ($priceQuery) {
                                        $priceCount = $priceQuery->fetch_assoc()['cnt'];
                                    }
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['code']) ?></td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['category_name']) ?></td>
                                    <td><?= htmlspecialchars($row['unit_name']) ?></td>
                                    <td>Rp <?= number_format($row['price_buy_offline'],0,',','.') ?></td>
                                    <td>Rp <?= number_format($row['price_buy_online'],0,',','.') ?></td>
                                    <td>
                                        <span class="badge bg-<?= $priceCount > 0 ? 'success' : 'warning' ?>">
                                            <?= $priceCount ?> satuan
                                        </span>
                                        <button type="button" class="btn btn-sm btn-outline-primary ms-1"
                                                onclick="manageUnitPrices(<?= $row['id'] ?>, '<?= addslashes($row['name']) ?>')">
                                            <iconify-icon icon="lucide:dollar-sign"></iconify-icon> Atur
                                        </button>
                                    </td>
                                    <td>
                                        <?php
                                            echo empty($row['exp_date']) ? '-' : date('d M Y', strtotime($row['exp_date']));
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success p-2 py-1 mb-1" onclick="editProduct(<?= $row['id'] ?>, '<?= addslashes($row['code']) ?>', '<?= addslashes($row['name']) ?>', '<?= $row['category_id'] ?>', '<?= $row['base_unit_id'] ?>', '<?= $row['price_buy_offline'] ?>', '<?= $row['price_buy_online'] ?>', '<?= $row['exp_date'] ?>')">
                                            <iconify-icon icon="lucide:edit"></iconify-icon> Edit
                                        </button>
                                        <form method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <button type="submit" class="btn btn-danger p-2 py-1 mb-1">
                                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Produk Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST">
                <div class="modal-body">
                  <input type="hidden" name="action" value="add">
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <label class="form-label">Kode Barang / Barcode</label>
                          <input type="text" name="code" class="form-control" placeholder="Opsional">
                      </div>
                      <div class="col-md-8 mb-3">
                          <label class="form-label">Nama Lengkap Produk</label>
                          <input type="text" name="name" class="form-control" required>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label class="form-label">Kategori</label>
                          <select name="category_id" class="form-select text-secondary" required>
                              <option value="">Pilih Kategori...</option>
                              <?= $cat_options ?>
                          </select>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label class="form-label">Satuan Dasar (Terkecil)</label>
                          <select name="base_unit_id" class="form-select text-secondary" required>
                              <option value="">Pilih Satuan...</option>
                              <?= $unit_options ?>
                          </select>
                      </div>
                      <div class="col-md-4 mb-3">
                          <label class="form-label">Harga Beli (Offline)</label>
                          <input type="number" name="price_buy_offline" class="form-control" value="0" step="0.01">
                          <small class="text-muted">Harga beli dari pasar/supplier offline</small>
                      </div>
                      <div class="col-md-4 mb-3">
                          <label class="form-label">Harga Beli (Online)</label>
                          <input type="number" name="price_buy_online" class="form-control" value="0" step="0.01">
                          <small class="text-muted">Harga beli dari marketplace online</small>
                      </div>
                      <div class="col-md-4 mb-3">
                          <label class="form-label">Tanggal Expired</label>
                          <input type="date" name="exp_date" class="form-control">
                      </div>
                      <div class="col-12 mb-3">
                          <div class="alert alert-info">
                              <iconify-icon icon="lucide:info"></iconify-icon>
                              <strong>Info:</strong> Harga jual per satuan akan diatur setelah produk disimpan melalui tombol "Atur" di tabel.
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST">
                <div class="modal-body">
                  <input type="hidden" name="action" value="edit">
                  <input type="hidden" name="id" id="edit_id">
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <label class="form-label">Kode Barang</label>
                          <input type="text" name="code" id="edit_code" class="form-control" readonly>
                      </div>
                      <div class="col-md-8 mb-3">
                          <label class="form-label">Nama Produk</label>
                          <input type="text" name="name" id="edit_name" class="form-control" required>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label class="form-label">Kategori</label>
                          <select name="category_id" id="edit_category_id" class="form-select text-secondary" required>
                              <?= $cat_options ?>
                          </select>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label class="form-label">Satuan Dasar</label>
                          <select name="base_unit_id" id="edit_base_unit_id" class="form-select text-secondary" required>
                              <?= $unit_options ?>
                          </select>
                      </div>
                      <div class="col-md-4 mb-3">
                          <label class="form-label">Harga Beli (Offline)</label>
                          <input type="number" name="price_buy_offline" id="edit_price_buy_offline" class="form-control" required step="0.01">
                          <small class="text-muted">Harga beli dari pasar/supplier offline</small>
                      </div>
                      <div class="col-md-4 mb-3">
                          <label class="form-label">Harga Beli (Online)</label>
                          <input type="number" name="price_buy_online" id="edit_price_buy_online" class="form-control" required step="0.01">
                          <small class="text-muted">Harga beli dari marketplace online</small>
                      </div>
                      <div class="col-md-4 mb-3">
                          <label class="form-label">Tanggal Expired</label>
                          <input type="date" name="exp_date" id="edit_exp_date" class="form-control">
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Unit Price Management Modal -->
        <div class="modal fade" id="unitPriceModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Atur Harga Jual Per Satuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <input type="hidden" id="manage_product_id">
                  <h6 class="mb-3">Produk: <span id="manage_product_name" class="text-primary"></span></h6>

                  <div class="mb-3">
                      <button type="button" class="btn btn-success btn-sm" onclick="showAddUnitPrice($('#manage_product_id').val())">
                          <iconify-icon icon="lucide:plus"></iconify-icon> Tambah Harga Jual Baru
                      </button>
                  </div>

                  <div id="addUnitPriceSection" class="card mb-3" style="display:none;">
                      <div class="card-body">
                          <h6 class="card-title mb-3">Tambah Harga Jual Baru</h6>
                          <div class="row">
                              <div class="col-md-6 mb-2">
                                  <label class="form-label">Satuan</label>
                                  <select id="add_unit_id" class="form-select">
                                      <option value="">Pilih satuan...</option>
                                  </select>
                              </div>
                              <div class="col-md-4 mb-2">
                                  <label class="form-label">Harga Jual</label>
                                  <input type="number" id="add_price_sell" class="form-control" step="0.01" min="0">
                              </div>
                              <div class="col-md-2 mb-2">
                                  <label class="form-label">&nbsp;</label>
                                  <button type="button" class="btn btn-primary w-100" onclick="addNewUnitPrice($('#manage_product_id').val())">
                                                                      <iconify-icon icon="lucide:plus"></iconify-icon>
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="table-responsive">
                      <table class="table table-bordered">
                          <thead class="table-light">
                              <tr>
                                  <th>Satuan</th>
                                  <th>Harga Jual (Rp)</th>
                                  <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody id="unitPricesBody">
                              <tr><td colspan="3" class="text-center">Loading...</td></tr>
                          </tbody>
                      </table>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
