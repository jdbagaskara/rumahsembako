<?php 
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
include 'koneksi.php';

$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

// Summary
$sum = $conn->query("SELECT COUNT(*) as total_trx, COALESCE(SUM(total_amount),0) as total_sales, COALESCE(SUM(fee_amount),0) as total_fee, COALESCE(SUM(net_amount),0) as total_net FROM sales WHERE sale_date = '$date'")->fetch_assoc();
$sum_buy = $conn->query("SELECT COUNT(*) as total_trx, COALESCE(SUM(total_amount),0) as total_buy FROM purchases WHERE purchase_date = '$date'")->fetch_assoc();

// Per platform
$platforms = $conn->query("SELECT platform, COUNT(*) as trx, SUM(total_amount) as total, SUM(fee_amount) as fee, SUM(net_amount) as net FROM sales WHERE sale_date = '$date' GROUP BY platform ORDER BY total DESC");

// Transactions
$sales = $conn->query("SELECT s.*, f.platform as fee_plat FROM sales s LEFT JOIN admin_fees f ON s.admin_fee_id = f.id WHERE s.sale_date = '$date' ORDER BY s.id DESC");

// Top products
$top = $conn->query("SELECT p.name, u.name as unit_name, SUM(sd.qty) as total_qty, SUM(sd.subtotal) as total_val FROM sale_details sd JOIN sales s ON sd.sale_id = s.id JOIN products p ON sd.product_id = p.id JOIN units u ON sd.unit_id = u.id WHERE s.sale_date = '$date' GROUP BY sd.product_id, sd.unit_id ORDER BY total_val DESC LIMIT 10");

$script = '';
?>
<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Laporan Harian</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium"><a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary"><iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon> Dashboard</a></li>
            <li>-</li>
            <li class="fw-medium">Laporan Harian</li>
        </ul>
    </div>

    <!-- Date Filter -->
    <div class="card mb-3">
        <div class="card-body">
            <form class="d-flex align-items-center gap-2" method="GET" style="max-width:300px;">
                <label class="form-label mb-0">Pilih Tanggal:</label>
                <input type="date" name="date" class="form-control" value="<?= $date ?>" onchange="this.form.submit()">
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-3">
        <div class="col-lg-3 col-md-6">
            <div style="background: white; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9;">
                <div class="d-flex align-items-start justify-content-between">
                    <div style="flex: 1;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 500; margin-bottom: 6px;">Total Penjualan</div>
                        <div style="font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 2px;">Rp <?= number_format($sum['total_sales'],0,',','.') ?></div>
                        <div style="font-size: 10px; color: #64748b;"><?= $sum['total_trx'] ?> transaksi</div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <iconify-icon icon="solar:cash-out-bold" style="font-size: 22px; color: #3b82f6;"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div style="background: white; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9;">
                <div class="d-flex align-items-start justify-content-between">
                    <div style="flex: 1;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 500; margin-bottom: 6px;">Fee Admin</div>
                        <div style="font-size: 20px; font-weight: 700; color: #ef4444; margin-bottom: 2px;">-Rp <?= number_format($sum['total_fee'],0,',','.') ?></div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: linear-gradient(135deg, #fef9c3 0%, #fef08a 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <iconify-icon icon="solar:tag-price-bold" style="font-size: 22px; color: #ca8a04;"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div style="background: white; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9;">
                <div class="d-flex align-items-start justify-content-between">
                    <div style="flex: 1;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 500; margin-bottom: 6px;">Nett Diterima</div>
                        <div style="font-size: 20px; font-weight: 700; color: #10b981; margin-bottom: 2px;">Rp <?= number_format($sum['total_net'],0,',','.') ?></div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <iconify-icon icon="solar:wallet-money-bold" style="font-size: 22px; color: #10b981;"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div style="background: white; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9;">
                <div class="d-flex align-items-start justify-content-between">
                    <div style="flex: 1;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 500; margin-bottom: 6px;">Total Pembelian</div>
                        <div style="font-size: 20px; font-weight: 700; color: #ef4444; margin-bottom: 2px;">Rp <?= number_format($sum_buy['total_buy'],0,',','.') ?></div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <iconify-icon icon="solar:cart-large-4-bold" style="font-size: 22px; color: #ef4444;"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <!-- Per Platform -->
        <div class="col-lg-4">
            <div class="card basic-data-table">
                <div class="card-header">
                    <h6 class="card-title mb-0">Per Platform</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table bordered-table mb-0" style="font-size:12px;">
                        <thead><tr><th>Platform</th><th class="text-center">Trx</th><th class="text-end">Total</th><th class="text-end">Nett</th></tr></thead>
                        <tbody>
                        <?php while($pl = $platforms->fetch_assoc()): ?>
                            <tr>
                                <td><span class="badge bg-primary text-white border-0 fw-bold" style="font-size:11px;"><?= htmlspecialchars($pl['platform']) ?></span></td>
                                <td class="text-center"><?= $pl['trx'] ?></td>
                                <td class="text-end">Rp <?= number_format($pl['total'],0,',','.') ?></td>
                                <td class="text-end fw-semibold">Rp <?= number_format($pl['net'],0,',','.') ?></td>
                            </tr>
                        <?php endwhile; ?>
                        <?php if ($sum['total_trx'] == 0): ?><tr><td colspan="4" class="text-center text-muted py-3">Belum ada transaksi</td></tr><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card basic-data-table">
                <div class="card-header">
                    <h6 class="card-title mb-0">Top Produk Terjual</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table bordered-table mb-0" style="font-size:12px;">
                        <thead><tr><th>Produk</th><th class="text-center">Qty</th><th class="text-end">Total</th></tr></thead>
                        <tbody>
                        <?php while($tp = $top->fetch_assoc()): ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars($tp['name']) ?></td>
                                <td class="text-center"><?= floatval($tp['total_qty']) ?> <?= htmlspecialchars($tp['unit_name']) ?></td>
                                <td class="text-end">Rp <?= number_format($tp['total_val'],0,',','.') ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Daftar Transaksi -->
        <div class="col-lg-8">
            <div class="card basic-data-table">
                <div class="card-header">
                    <h6 class="card-title mb-0">Daftar Transaksi — <?= date('d M Y', strtotime($date)) ?></h6>
                </div>
                <div class="card-body p-0">
                    <table class="table bordered-table mb-0" style="font-size:12px;">
                        <thead><tr><th>Invoice</th><th>Platform</th><th class="text-end">Total</th><th class="text-end">Fee</th><th class="text-end">Nett</th></tr></thead>
                        <tbody>
                        <?php while($s = $sales->fetch_assoc()): ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars($s['invoice_num']) ?></td>
                                <td><span class="badge bg-light text-dark border" style="font-size:10px;"><?= htmlspecialchars($s['platform']) ?></span></td>
                                <td class="text-end">Rp <?= number_format($s['total_amount'],0,',','.') ?></td>
                                <td class="text-end text-danger"><?= $s['fee_amount'] > 0 ? '-Rp '.number_format($s['fee_amount'],0,',','.') : '-' ?></td>
                                <td class="text-end fw-bold">Rp <?= number_format($s['net_amount'],0,',','.') ?></td>
                            </tr>
                        <?php endwhile; ?>
                        <?php if ($sum['total_trx'] == 0): ?><tr><td colspan="5" class="text-center text-muted py-3">Tidak ada transaksi di tanggal ini</td></tr><?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold" style="background:#f8fafc;">
                                <td colspan="2">TOTAL <?= $sum['total_trx'] ?> Transaksi</td>
                                <td class="text-end">Rp <?= number_format($sum['total_sales'],0,',','.') ?></td>
                                <td class="text-end text-danger">-Rp <?= number_format($sum['total_fee'],0,',','.') ?></td>
                                <td class="text-end text-success">Rp <?= number_format($sum['total_net'],0,',','.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
