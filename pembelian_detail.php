<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id == 0) { header("Location: pembelian.php"); exit; }

$stmt = $conn->prepare("SELECT p.*, f.platform as fee_platform FROM purchases p LEFT JOIN admin_fees f ON p.admin_fee_id = f.id WHERE p.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$purchase = $stmt->get_result()->fetch_assoc();
if (!$purchase) { header("Location: pembelian.php"); exit; }

$d_stmt = $conn->prepare("SELECT pd.*, pr.code as product_code, pr.name as product_name, u.name as unit_name FROM purchase_details pd JOIN products pr ON pd.product_id = pr.id JOIN units u ON pd.unit_id = u.id WHERE pd.purchase_id = ?");
$d_stmt->bind_param("i", $id);
$d_stmt->execute();
$details = $d_stmt->get_result();

$script = '';
?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">
                    <a href="pembelian.php" class="text-secondary hover-text-primary"><iconify-icon icon="solar:arrow-left-outline" class="me-1"></iconify-icon></a>
                    Detail Pembelian
                </h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium"><a href="pembelian.php" class="hover-text-primary">Pembelian</a></li>
                    <li>-</li>
                    <li class="fw-medium">Detail</li>
                </ul>
            </div>

            <div class="row gy-4">
                <!-- Kiri: Detail Info -->
                <div class="col-xl-4">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center gap-2">
                            <iconify-icon icon="solar:document-text-bold" class="text-xl text-primary-600"></iconify-icon>
                            <h6 class="card-title mb-0">Informasi Nota</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-16">
                                <span class="text-secondary text-sm">No. Invoice</span>
                                <span class="fw-bold"><?= htmlspecialchars($purchase['invoice_num']) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-16">
                                <span class="text-secondary text-sm">Tanggal</span>
                                <span class="fw-semibold"><?= date('d M Y', strtotime($purchase['purchase_date'])) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-16">
                                <span class="text-secondary text-sm">Suplier</span>
                                <span class="fw-semibold"><?= htmlspecialchars($purchase['supplier_name'] ?: '-') ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Card -->
                    <div class="card overflow-hidden">
                        <div class="p-4" style="background: linear-gradient(135deg, #487fff 0%, #304ffe 100%);">
                            <div class="d-flex justify-content-between align-items-center mb-12">
                                <span class="text-white text-white-50 text-sm">Subtotal Barang</span>
                                <span class="text-white fw-semibold">Rp <?= number_format($purchase['total_amount'],0,',','.') ?></span>
                            </div>
                            <?php if($purchase['fee_percentage'] > 0): ?>
                            <div class="d-flex justify-content-between align-items-center mb-12">
                                <span class="text-white text-white-50 text-sm"><?= htmlspecialchars($purchase['fee_platform'] ?? 'Fee') ?> (<?= floatval($purchase['fee_percentage']) ?>%)</span>
                                <span class="text-warning-300 fw-semibold">- Rp <?= number_format($purchase['fee_amount'],0,',','.') ?></span>
                            </div>
                            <?php endif; ?>
                            <hr class="border-white border-opacity-25 my-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-white fw-bold">Nett Bayar</span>
                                <span class="text-white fw-bold fs-3">Rp <?= number_format($purchase['net_amount'] ?: $purchase['total_amount'],0,',','.') ?></span>
                            </div>
                        </div>
                    </div>

                    <a href="pembelian.php" class="btn btn-outline-primary w-100 mt-3 py-10 d-flex align-items-center justify-content-center gap-2 rounded-3">
                        <iconify-icon icon="solar:arrow-left-outline"></iconify-icon>
                        Kembali ke Daftar
                    </a>
                </div>

                <!-- Kanan: Rincian Barang -->
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center gap-2">
                            <iconify-icon icon="solar:cart-large-4-bold" class="text-xl text-primary-600"></iconify-icon>
                            <h6 class="card-title mb-0">Rincian Barang</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table bordered-table mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:50px">#</th>
                                            <th>Kode</th>
                                            <th>Nama Produk</th>
                                            <th>Satuan</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-end">Harga</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; while($d = $details->fetch_assoc()): ?>
                                        <tr>
                                            <td class="text-center text-sm"><?= $no++ ?></td>
                                            <td><span class="badge bg-primary-100 text-primary-600 border-0 px-12 py-6"><?= htmlspecialchars($d['product_code']) ?></span></td>
                                            <td class="fw-semibold"><?= htmlspecialchars($d['product_name']) ?></td>
                                            <td><?= htmlspecialchars($d['unit_name']) ?></td>
                                            <td class="text-center"><?= floatval($d['qty']) ?></td>
                                            <td class="text-end">Rp <?= number_format($d['price_unit'],0,',','.') ?></td>
                                            <td class="text-end fw-bold">Rp <?= number_format($d['subtotal'],0,',','.') ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6" class="text-end fw-bold text-primary-600">Grand Total</td>
                                            <td class="text-end fw-bold text-primary-600 fs-6">Rp <?= number_format($purchase['total_amount'],0,',','.') ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>
