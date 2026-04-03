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
        $product_id = $_POST['product_id'];
        $unit_id = $_POST['unit_id'];
        $multiplier = $_POST['multiplier'];
        
        $stmt = $conn->prepare("INSERT INTO product_conversions (product_id, unit_id, multiplier) VALUES (?, ?, ?)");
        $stmt->bind_param("iid", $product_id, $unit_id, $multiplier);
        $stmt->execute();
    } elseif ($_POST['action'] == 'edit') {
        $id = $_POST['id'];
        $product_id = $_POST['product_id'];
        $unit_id = $_POST['unit_id'];
        $multiplier = $_POST['multiplier'];

        $stmt = $conn->prepare("UPDATE product_conversions SET product_id=?, unit_id=?, multiplier=? WHERE id=?");
        $stmt->bind_param("iidi", $product_id, $unit_id, $multiplier, $id);
        $stmt->execute();
    } elseif ($_POST['action'] == 'delete') {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM product_conversions WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    header("Location: master_konversi.php");
    exit;
}

$query = "SELECT pc.*, p.name as product_name, p.code as product_code, u.name as unit_name, pbu.name as base_unit_name
          FROM product_conversions pc 
          JOIN products p ON pc.product_id = p.id 
          JOIN units u ON pc.unit_id = u.id 
          LEFT JOIN units pbu ON p.base_unit_id = pbu.id
          ORDER BY pc.id DESC";
$conversions = $conn->query($query);

$products = $conn->query("SELECT p.id, p.code, p.name as product_name, u.name as base_unit_name FROM products p LEFT JOIN units u ON p.base_unit_id = u.id ORDER BY p.name ASC");
$units = $conn->query("SELECT * FROM units ORDER BY name ASC");

// Fetch options
$prod_options = '';
while($p = $products->fetch_assoc()) {
    $prod_options .= '<option value="'.$p['id'].'" data-baseunit="'.htmlspecialchars($p['base_unit_name'] ?? '-').'">['.htmlspecialchars($p['code']).'] '.htmlspecialchars($p['product_name']).'</option>';
}

$unit_options = '';
while($u = $units->fetch_assoc()) {
    $unit_options .= '<option value="'.$u['id'].'">'.htmlspecialchars($u['name']).'</option>';
}

$script = '
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
       let table = new DataTable("#dataTable");

       // To use searchable select in Modals
       $(document).ready(function() {
           $(".select2").select2({
               dropdownParent: $("#addModal")
           });
           $(".select2-edit").select2({
               dropdownParent: $("#editModal")
           });

           $("#add_product_id").on("change", function(){
               var base = $(this).find("option:selected").data("baseunit");
               $("#baseUnitInfoText").val(base ? base : "-");
           });
           $("#edit_product_id").on("change", function(){
               var base = $(this).find("option:selected").data("baseunit");
               $("#editBaseUnitInfoText").val(base ? base : "-");
           });
       });
       
       function editConversion(id, pid, uid, mult) {
           $("#edit_id").val(id);
           $("#edit_product_id").val(pid).trigger("change");
           $("#edit_unit_id").val(uid);
           $("#edit_multiplier").val(mult);
           $("#editModal").modal("show");
       }
    </script>
    <style>
      .select2-container .select2-selection--single { height: 50px; border-radius: 12px; border: 1px solid #e5e5e5; padding: 10px; }
      .select2-container--default .select2-selection--single .select2-selection__arrow { height: 50px; }
    </style>
';
?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Konversi Satuan</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Konversi Satuan</li>
                </ul>
            </div>

            <div class="card basic-data-table">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Data Konversi Produk</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Konversi</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">Kode Produk</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Konversi Aturan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $conversions->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['product_code']) ?></td>
                                    <td><?= htmlspecialchars($row['product_name']) ?></td>
                                    <td>
                                        <strong>1 <?= htmlspecialchars($row['base_unit_name'] ?? 'Satuan Utama') ?></strong> = <?= floatval($row['multiplier']) ?> <?= htmlspecialchars($row['unit_name']) ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success p-2 py-1 mb-1" onclick="editConversion(<?= $row['id'] ?>, <?= $row['product_id'] ?>, <?= $row['unit_id'] ?>, <?= $row['multiplier'] ?>)">
                                            <iconify-icon icon="lucide:edit"></iconify-icon> Edit
                                        </button>
                                        <form method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus konversi ini?')">
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
                <h5 class="modal-title">Set Konversi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST">
                <div class="modal-body">
                  <input type="hidden" name="action" value="add">
                  <div class="mb-3">
                      <label class="form-label">Pilih Produk</label>
                      <select name="product_id" id="add_product_id" class="form-select select2 w-100" required>
                          <option value="">Cari dan Pilih Produk...</option>
                          <?= $prod_options ?>
                      </select>
                  </div>
                  <div class="row align-items-center">
                     <div class="col-md-4 mb-3">
                         <label class="form-label">Satuan Utama (Bawaan)</label>
                         <div class="input-group">
                             <span class="input-group-text bg-base fw-bold">1</span>
                             <input type="text" class="form-control bg-light" id="baseUnitInfoText" value="-" readonly>
                         </div>
                     </div>
                     <div class="col-md-1 mb-3 text-center">
                        <span class="fs-4 fw-bold mt-4 d-block">=</span>
                     </div>
                     <div class="col-md-4 mb-3">
                         <label class="form-label">Pecahan berjumlah</label>
                         <input type="number" step="0.01" name="multiplier" class="form-control" required placeholder="Contoh: 40">
                     </div>
                     <div class="col-md-3 mb-3">
                         <label class="form-label">Pilih Satuan</label>
                         <select name="unit_id" class="form-select" required>
                             <option value="">Pilih...</option>
                             <?= $unit_options ?>
                         </select>
                     </div>
                  </div>
                  <div class="alert alert-info">
                      <strong>Contoh Kasus:</strong> Jika Anda memilih Indomie Goreng (Satuan Utama: Karton), lalu mau menset isi 1 Karton = 40 Pcs. Di kolom bernilai isi "40", lalu Pilih Satuan "Pcs".
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
                <h5 class="modal-title">Edit Konversi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST">
                <div class="modal-body">
                  <input type="hidden" name="action" value="edit">
                  <input type="hidden" name="id" id="edit_id">
                  <div class="mb-3">
                      <label class="form-label">Pilih Produk</label>
                      <select name="product_id" id="edit_product_id" class="form-select select2-edit w-100" required>
                          <?= $prod_options ?>
                      </select>
                  </div>
                  <div class="row align-items-center">
                     <div class="col-md-4 mb-3">
                         <label class="form-label">Satuan Utama (Bawaan)</label>
                         <div class="input-group">
                             <span class="input-group-text bg-base fw-bold">1</span>
                             <input type="text" class="form-control bg-light" id="editBaseUnitInfoText" readonly>
                         </div>
                     </div>
                     <div class="col-md-1 mb-3 text-center">
                        <span class="fs-4 fw-bold mt-4 d-block">=</span>
                     </div>
                     <div class="col-md-4 mb-3">
                         <label class="form-label">Pecahan berjumlah</label>
                         <input type="number" step="0.01" name="multiplier" id="edit_multiplier" class="form-control" required>
                     </div>
                     <div class="col-md-3 mb-3">
                         <label class="form-label">Pilih Satuan</label>
                         <select name="unit_id" id="edit_unit_id" class="form-select" required>
                             <?= $unit_options ?>
                         </select>
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
