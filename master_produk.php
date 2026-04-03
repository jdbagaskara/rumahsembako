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
            // Format PRD-YYMM-000X
            $code = 'PRD-' . date('ym') . '-' . str_pad($next_id, 4, '0', STR_PAD_LEFT);
        }
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $base_unit_id = $_POST['base_unit_id'];
        $price_buy = $_POST['price_buy'];
        $price_sell = $_POST['price_sell'];
        $exp_date = $_POST['exp_date'];
        
        $stmt = $conn->prepare("INSERT INTO products (code, name, category_id, base_unit_id, price_buy, price_sell, exp_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiidds", $code, $name, $category_id, $base_unit_id, $price_buy, $price_sell, $exp_date);
        $stmt->execute();
    } elseif ($_POST['action'] == 'edit') {
        $id = $_POST['id'];
        $code = $_POST['code'];
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $base_unit_id = $_POST['base_unit_id'];
        $price_buy = $_POST['price_buy'];
        $price_sell = $_POST['price_sell'];
        $exp_date = $_POST['exp_date'];

        $stmt = $conn->prepare("UPDATE products SET code=?, name=?, category_id=?, base_unit_id=?, price_buy=?, price_sell=?, exp_date=? WHERE id=?");
        $stmt->bind_param("ssiiddsi", $code, $name, $category_id, $base_unit_id, $price_buy, $price_sell, $exp_date, $id);
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
       
       function editProduct(id, code, name, cat, unit, pbuy, psell, exp) {
           $("#edit_id").val(id);
           $("#edit_code").val(code);
           $("#edit_name").val(name);
           $("#edit_category_id").val(cat);
           $("#edit_base_unit_id").val(unit);
           $("#edit_price_buy").val(pbuy);
           $("#edit_price_sell").val(psell);
           $("#edit_exp_date").val(exp);
           $("#editModal").modal("show");
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
                                    <th scope="col">Harga Beli</th>
                                    <th scope="col">Harga Jual</th>
                                    <th scope="col">Expired Date</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $products->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['code']) ?></td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['category_name']) ?></td>
                                    <td><?= htmlspecialchars($row['unit_name']) ?></td>
                                    <td>Rp <?= number_format($row['price_buy'],0,',','.') ?></td>
                                    <td>Rp <?= number_format($row['price_sell'],0,',','.') ?></td>
                                    <td>
                                        <?php 
                                            // Highlight if expired or near expiry (optional logic can go here)
                                            echo empty($row['exp_date']) ? '-' : date('d M Y', strtotime($row['exp_date'])); 
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success p-2 py-1 mb-1" onclick="editProduct(<?= $row['id'] ?>, '<?= addslashes($row['code']) ?>', '<?= addslashes($row['name']) ?>', '<?= $row['category_id'] ?>', '<?= $row['base_unit_id'] ?>', '<?= $row['price_buy'] ?>', '<?= $row['price_sell'] ?>', '<?= $row['exp_date'] ?>')">
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
                          <label class="form-label">Harga Beli</label>
                          <input type="number" name="price_buy" class="form-control" value="0">
                      </div>
                      <div class="col-md-4 mb-3">
                          <label class="form-label">Harga Jual</label>
                          <input type="number" name="price_sell" class="form-control" value="0">
                      </div>
                      <div class="col-md-4 mb-3">
                          <label class="form-label">Tanggal Expired</label>
                          <input type="date" name="exp_date" class="form-control">
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
                          <label class="form-label">Harga Beli</label>
                          <input type="number" name="price_buy" id="edit_price_buy" class="form-control" required>
                      </div>
                      <div class="col-md-4 mb-3">
                          <label class="form-label">Harga Jual</label>
                          <input type="number" name="price_sell" id="edit_price_sell" class="form-control" required>
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

<?php include './partials/layouts/layoutBottom.php' ?>
