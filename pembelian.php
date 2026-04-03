<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$query = "SELECT p.*, f.platform as fee_platform 
          FROM purchases p 
          LEFT JOIN admin_fees f ON p.admin_fee_id = f.id 
          ORDER BY p.id DESC";
$purchases = $conn->query($query);

$script = '
    <script>
       let table = new DataTable("#dataTable");
    </script>
';
?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Data Pembelian (Stok Masuk)</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Pembelian</li>
                </ul>
            </div>

            <div class="card basic-data-table">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Riwayat Pembelian Barang</h5>
                    <a href="pembelian_add.php" class="btn btn-primary d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:add-circle-bold" class="text-xl"></iconify-icon>
                        Catat Pembelian Baru
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col">No. Invoice</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Suplier</th>
                                    <th scope="col">Total Belanja</th>
                                    <th scope="col">Fee</th>
                                    <th scope="col">Nett Bayar</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $purchases->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-primary-100 text-primary-600 border-0 fw-semibold px-12 py-6">
                                            <?= htmlspecialchars($row['invoice_num']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('d M Y', strtotime($row['purchase_date'])) ?></td>
                                    <td><?= htmlspecialchars($row['supplier_name'] ?: '-') ?></td>
                                    <td class="fw-semibold">Rp <?= number_format($row['total_amount'],0,',','.') ?></td>
                                    <td>
                                        <?php if($row['fee_percentage'] > 0): ?>
                                            <span class="badge bg-warning-100 text-warning-600 border-0 fw-semibold px-12 py-6">
                                                <?= htmlspecialchars($row['fee_platform'] ?? '') ?> (<?= floatval($row['fee_percentage']) ?>%)
                                            </span>
                                            <br><small class="text-danger-main">-Rp <?= number_format($row['fee_amount'],0,',','.') ?></small>
                                        <?php else: ?>
                                            <span class="text-neutral-400">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-bold text-primary-600">Rp <?= number_format($row['net_amount'] ?: $row['total_amount'],0,',','.') ?></td>
                                    <td>
                                        <a href="pembelian_detail.php?id=<?= $row['id'] ?>" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
