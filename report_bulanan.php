<?php 
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
include 'koneksi.php';

$month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
$year = substr($month, 0, 4);
$mon = substr($month, 5, 2);
$days_in_month = cal_days_in_month(CAL_GREGORIAN, intval($mon), intval($year));

// Monthly summary
$sum = $conn->query("SELECT COUNT(*) as total_trx, COALESCE(SUM(total_amount),0) as total_sales, COALESCE(SUM(fee_amount),0) as total_fee, COALESCE(SUM(net_amount),0) as total_net FROM sales WHERE DATE_FORMAT(sale_date, '%Y-%m') = '$month'")->fetch_assoc();
$sum_buy = $conn->query("SELECT COUNT(*) as total_trx, COALESCE(SUM(total_amount),0) as total_buy FROM purchases WHERE DATE_FORMAT(purchase_date, '%Y-%m') = '$month'")->fetch_assoc();

// Per platform
$platforms = $conn->query("SELECT platform, COUNT(*) as trx, SUM(total_amount) as total, SUM(fee_amount) as fee, SUM(net_amount) as net FROM sales WHERE DATE_FORMAT(sale_date, '%Y-%m') = '$month' GROUP BY platform ORDER BY total DESC");

// Daily breakdown
$daily = $conn->query("SELECT sale_date, COUNT(*) as trx, SUM(total_amount) as total, SUM(fee_amount) as fee, SUM(net_amount) as net FROM sales WHERE DATE_FORMAT(sale_date, '%Y-%m') = '$month' GROUP BY sale_date ORDER BY sale_date ASC");
$daily_data = [];
while($d = $daily->fetch_assoc()) { $daily_data[$d['sale_date']] = $d; }

// Top products
$top = $conn->query("SELECT p.name, SUM(sd.base_qty) as total_base, u.name as base_unit, SUM(sd.subtotal) as total_val FROM sale_details sd JOIN sales s ON sd.sale_id = s.id JOIN products p ON sd.product_id = p.id LEFT JOIN units u ON p.base_unit_id = u.id WHERE DATE_FORMAT(s.sale_date, '%Y-%m') = '$month' GROUP BY sd.product_id ORDER BY total_val DESC LIMIT 10");

// Profit estimate (sales - purchases)
$profit = $sum['total_net'] - $sum_buy['total_buy'];

$script = '';
?>
<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Laporan Bulanan</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium"><a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary"><iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon> Dashboard</a></li>
            <li>-</li>
            <li class="fw-medium">Laporan Bulanan</li>
        </ul>
    </div>

    <!-- Month Filter -->
    <div class="card mb-3">
        <div class="card-body">
            <form class="d-flex align-items-center gap-2" method="GET" style="max-width:350px;">
                <label class="form-label mb-0">Pilih Bulan:</label>
                <input type="month" name="month" class="form-control" value="<?= $month ?>" onchange="this.form.submit()">
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-3">
        <div class="col-xl col-md-6">
            <div style="background: white; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9;">
                <div class="d-flex align-items-start justify-content-between">
                    <div style="flex: 1;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 500; margin-bottom: 6px;">Total Penjualan</div>
                        <div style="font-size: 20px; font-weight: 700; color: #3b82f6; margin-bottom: 2px;">Rp <?= number_format($sum['total_sales'],0,',','.') ?></div>
                        <div style="font-size: 10px; color: #64748b;"><?= $sum['total_trx'] ?> transaksi</div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <iconify-icon icon="solar:cash-out-bold" style="font-size: 22px; color: #3b82f6;"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl col-md-6">
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
        <div class="col-xl col-md-6">
            <div style="background: white; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9;">
                <div class="d-flex align-items-start justify-content-between">
                    <div style="flex: 1;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 500; margin-bottom: 6px;">Nett Penjualan</div>
                        <div style="font-size: 20px; font-weight: 700; color: #10b981; margin-bottom: 2px;">Rp <?= number_format($sum['total_net'],0,',','.') ?></div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <iconify-icon icon="solar:wallet-money-bold" style="font-size: 22px; color: #10b981;"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl col-md-6">
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
        <div class="col-xl col-md-6">
            <div style="background: white; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9;<?= $profit >= 0 ? 'background:#f0fdf4;' : 'background:#fef2f2;' ?>">
                <div class="d-flex align-items-start justify-content-between">
                    <div style="flex: 1;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 500; margin-bottom: 6px;">Estimasi Profit</div>
                        <div style="font-size: 20px; font-weight: 700; color:<?= $profit >= 0 ? '#16a34a' : '#dc2626' ?>; margin-bottom: 2px;">Rp <?= number_format($profit,0,',','.') ?></div>
                        <div style="font-size: 10px;color:<?= $profit >= 0 ? '#16a34a' : '#dc2626' ?>;"><?= $profit >= 0 ? '↑ Untung' : '↓ Rugi' ?></div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background:<?= $profit >= 0 ? 'linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%)' : 'linear-gradient(135deg, #fee2e2 0%, #fecaca 100%)' ?>; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <iconify-icon icon="<?= $profit >= 0 ? 'solar:graph-up-bold' : 'solar:graph-down-bold' ?>" style="font-size: 22px; color:<?= $profit >= 0 ? '#16a34a' : '#dc2626' ?>;"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <!-- Kiri: Platform + Top Produk -->
        <div class="col-lg-4">
            <div class="card basic-data-table mb-3">
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
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card basic-data-table">
                <div class="card-header">
                    <h6 class="card-title mb-0">Top 10 Produk Terlaris</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table bordered-table mb-0" style="font-size:12px;">
                        <thead><tr><th>#</th><th>Produk</th><th class="text-center">Terjual</th><th class="text-end">Revenue</th></tr></thead>
                        <tbody>
                        <?php $no=1; while($tp = $top->fetch_assoc()): ?>
                            <tr>
                                <td class="text-muted"><?= $no++ ?></td>
                                <td class="fw-semibold"><?= htmlspecialchars($tp['name']) ?></td>
                                <td class="text-center"><?= round(floatval($tp['total_base'])) ?> <?= htmlspecialchars($tp['base_unit'] ?? '') ?></td>
                                <td class="text-end">Rp <?= number_format($tp['total_val'],0,',','.') ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kanan: Daily Breakdown -->
        <div class="col-lg-8">
            <div class="card basic-data-table">
                <div class="card-header">
                    <h6 class="card-title mb-0">Rekap Harian — <?= date('F Y', strtotime($month.'-01')) ?></h6>
                </div>
                <div class="card-body p-0">
                    <table class="table bordered-table mb-0" style="font-size:12px;">
                        <thead><tr><th>Tanggal</th><th class="text-center">Trx</th><th class="text-end">Penjualan</th><th class="text-end">Fee</th><th class="text-end">Nett</th><th></th></tr></thead>
                        <tbody>
                        <?php for($di=1; $di<=$days_in_month; $di++):
                            $dateStr = $month . '-' . str_pad($di, 2, '0', STR_PAD_LEFT);
                            $row = isset($daily_data[$dateStr]) ? $daily_data[$dateStr] : null;
                            $dayName = date('D', strtotime($dateStr));
                            $isToday = ($dateStr == date('Y-m-d'));
                        ?>
                            <tr<?= $isToday ? ' style="background:#eff6ff;"' : '' ?><?= !$row ? ' class="text-muted"' : '' ?>>
                                <td>
                                    <?= $di ?> <?= $dayName ?>
                                    <?php if($isToday): ?><span class="badge bg-primary border-0" style="font-size:9px;">Hari Ini</span><?php endif; ?>
                                </td>
                                <td class="text-center"><?= $row ? $row['trx'] : '-' ?></td>
                                <td class="text-end"><?= $row ? 'Rp '.number_format($row['total'],0,',','.') : '-' ?></td>
                                <td class="text-end text-danger"><?= $row && $row['fee'] > 0 ? '-Rp '.number_format($row['fee'],0,',','.') : '-' ?></td>
                                <td class="text-end fw-semibold"><?= $row ? 'Rp '.number_format($row['net'],0,',','.') : '-' ?></td>
                                <td class="text-center"><?php if($row): ?><a href="report_harian.php?date=<?= $dateStr ?>" class="text-primary"><iconify-icon icon="solar:eye-outline" style="font-size:16px;"></iconify-icon></a><?php endif; ?></td>
                            </tr>
                        <?php endfor; ?>
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold" style="background:#f8fafc;">
                                <td colspan="2">TOTAL BULAN INI</td>
                                <td class="text-end">Rp <?= number_format($sum['total_sales'],0,',','.') ?></td>
                                <td class="text-end text-danger">-Rp <?= number_format($sum['total_fee'],0,',','.') ?></td>
                                <td class="text-end text-success">Rp <?= number_format($sum['total_net'],0,',','.') ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
