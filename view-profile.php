<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Fetch user data
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT id, username, role, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$script = '';
?>
<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Profil Saya</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium"><a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary"><iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon> Dashboard</a></li>
            <li>-</li>
            <li class="fw-medium">Profil</li>
        </ul>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card basic-data-table">
                <div class="card-header">
                    <h6 class="card-title mb-0">Informasi Akun</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($user['role']) ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Terdaftar Sejak</label>
                        <input type="text" class="form-control" value="<?= date('d M Y', strtotime($user['created_at'])) ?>" readonly>
                    </div>
                    <div class="alert alert-info">
                        <iconify-icon icon="solar:info-circle-bold" class="me-2"></iconify-icon>
                        Untuk mengubah password, silakan ke menu <a href="update_pass.php" class="fw-bold">Ubah Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
