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
        $platform = $_POST['platform'];
        $category_id = empty($_POST['category_id']) ? NULL : $_POST['category_id'];
        $fee_percentage = $_POST['fee_percentage'] ?: 0;

        $stmt = $conn->prepare("INSERT INTO admin_fees (platform, category_id, fee_percentage) VALUES (?, ?, ?)");
        $stmt->bind_param("sid", $platform, $category_id, $fee_percentage);
        $stmt->execute();
    } elseif ($_POST['action'] == 'edit') {
        $id = $_POST['id'];
        $platform = $_POST['platform'];
        $category_id = empty($_POST['category_id']) ? NULL : $_POST['category_id'];
        $fee_percentage = $_POST['fee_percentage'] ?: 0;

        $stmt = $conn->prepare("UPDATE admin_fees SET platform=?, category_id=?, fee_percentage=? WHERE id=?");
        $stmt->bind_param("sidi", $platform, $category_id, $fee_percentage, $id);
        $stmt->execute();
    } elseif ($_POST['action'] == 'delete') {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM admin_fees WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    header("Location: master_fee.php");
    exit;
}

$query = "SELECT f.*, c.name as category_name
          FROM admin_fees f
          LEFT JOIN categories c ON f.category_id = c.id
          ORDER BY f.id DESC";
$fees = $conn->query($query);
$categories = $conn->query("SELECT * FROM categories ORDER BY name ASC");

$cat_options = '';
while($c = $categories->fetch_assoc()) {
    $cat_options .= '<option value="'.$c['id'].'">'.htmlspecialchars($c['name']).'</option>';
}

$script = '
    <script>
       let table = new DataTable("#dataTable");

       function editFee(id, plat, cat, perc) {
           $("#edit_id").val(id);
           $("#edit_platform").val(plat);
           $("#edit_category_id").val(cat);
           $("#edit_fee_percentage").val(perc);
           $("#editModal").modal("show");
       }
    </script>
';
?>

<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Master Biaya Admin</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Biaya Admin</li>
        </ul>
    </div>

    <div class="card basic-data-table">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">Aturan Potongan Fee</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah Fee</button>
        </div>
        <div class="card-body">
            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">Platform</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Potongan (%)</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $fees->fetch_assoc()): ?>
                    <tr>
                        <td><span class="badge bg-primary text-white border-0 fw-bold"><?= htmlspecialchars($row['platform']) ?></span></td>
                        <td><?= $row['category_id'] ? htmlspecialchars($row['category_name']) : '<i class="text-muted">-- Semua Kategori --</i>' ?></td>
                        <td><span class="text-danger fw-bold"><?= floatval($row['fee_percentage']) ?>%</span></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm mb-1" onclick="editFee(<?= $row['id'] ?>, '<?= addslashes($row['platform']) ?>', '<?= $row['category_id'] ?>', <?= floatval($row['fee_percentage']) ?>)">
                                <iconify-icon icon="lucide:edit"></iconify-icon> Edit
                            </button>
                            <form method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm mb-1">
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

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Aturan Fee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <input type="hidden" name="action" value="add">
          <div class="mb-3">
              <label class="form-label">Platform (Shopee, Tokopedia, Offline dsb)</label>
              <input type="text" name="platform" class="form-control" placeholder="Contoh: Shopee" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Terapkan pada Kategori (Kosongkan bila semua kategori)</label>
              <select name="category_id" class="form-select">
                  <option value="">-- Semua Kategori --</option>
                  <?= $cat_options ?>
              </select>
          </div>
          <div class="mb-3">
              <label class="form-label">Potongan Persen (%)</label>
              <input type="number" step="0.01" name="fee_percentage" class="form-control" value="0">
          </div>
          <div class="alert alert-warning text-sm">
              Kalkulasi Otomatis: Nett = Total - (Total × Potongan %)
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Aturan Fee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <input type="hidden" name="action" value="edit">
          <input type="hidden" name="id" id="edit_id">
          <div class="mb-3">
              <label class="form-label">Platform</label>
              <input type="text" name="platform" id="edit_platform" class="form-control" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Kategori Spesifik</label>
              <select name="category_id" id="edit_category_id" class="form-select">
                  <option value="">-- Semua Kategori --</option>
                  <?= $cat_options ?>
              </select>
          </div>
          <div class="mb-3">
              <label class="form-label">Potongan Persen (%)</label>
              <input type="number" step="0.01" name="fee_percentage" id="edit_fee_percentage" class="form-control">
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

<?php include './partials/layouts/layoutBottom.php' ?>
