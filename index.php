<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
include 'koneksi.php';

// === TODAY DATA ===
$today = date('Y-m-d');
$todaySales = $conn->query("SELECT COUNT(*) as trx, COALESCE(SUM(total_amount),0) as total, COALESCE(SUM(fee_amount),0) as fee, COALESCE(SUM(net_amount),0) as net FROM sales WHERE sale_date = '$today'")->fetch_assoc();
$todayBuy = $conn->query("SELECT COUNT(*) as trx, COALESCE(SUM(total_amount),0) as total FROM purchases WHERE purchase_date = '$today'")->fetch_assoc();

// === THIS MONTH DATA ===
$thisMonth = date('Y-m');
$monthSales = $conn->query("SELECT COUNT(*) as trx, COALESCE(SUM(total_amount),0) as total, COALESCE(SUM(fee_amount),0) as fee, COALESCE(SUM(net_amount),0) as net FROM sales WHERE DATE_FORMAT(sale_date,'%Y-%m') = '$thisMonth'")->fetch_assoc();
$monthBuy = $conn->query("SELECT COUNT(*) as trx, COALESCE(SUM(total_amount),0) as total FROM purchases WHERE DATE_FORMAT(purchase_date,'%Y-%m') = '$thisMonth'")->fetch_assoc();
$monthProfit = $monthSales['net'] - $monthBuy['total'];

// === PRODUCT COUNT & LOW STOCK ===
$totalProducts = $conn->query("SELECT COUNT(*) as c FROM products")->fetch_assoc()['c'];
$lowStock = $conn->query("SELECT COUNT(*) as c FROM products WHERE stock <= 5 AND stock > 0")->fetch_assoc()['c'];
$outOfStock = $conn->query("SELECT COUNT(*) as c FROM products WHERE stock <= 0")->fetch_assoc()['c'];

// === TOP 5 PRODUCTS THIS MONTH ===
$topProducts = $conn->query("SELECT p.name, SUM(sd.subtotal) as revenue, SUM(sd.base_qty) as sold_qty, u.name as base_unit FROM sale_details sd JOIN sales s ON sd.sale_id = s.id JOIN products p ON sd.product_id = p.id LEFT JOIN units u ON p.base_unit_id = u.id WHERE DATE_FORMAT(s.sale_date,'%Y-%m') = '$thisMonth' GROUP BY sd.product_id ORDER BY revenue DESC LIMIT 5");

// === RECENT 7 SALES ===
$recentSales = $conn->query("SELECT * FROM sales ORDER BY id DESC LIMIT 7");

// === LOW STOCK PRODUCTS ===
$lowStockProducts = $conn->query("SELECT p.name, p.code, p.stock, u.name as unit_name FROM products p LEFT JOIN units u ON p.base_unit_id = u.id WHERE p.stock <= 10 ORDER BY p.stock ASC LIMIT 8");

// === EXPIRING PRODUCTS ===
$expiringSoon = $conn->query("SELECT p.name, p.code, p.exp_date, DATEDIFF(p.exp_date, CURDATE()) as days_left FROM products p WHERE p.exp_date IS NOT NULL AND p.exp_date >= CURDATE() AND DATEDIFF(p.exp_date, CURDATE()) <= 30 ORDER BY p.exp_date ASC LIMIT 5");
$expiredProducts = $conn->query("SELECT p.name, p.code, p.exp_date, DATEDIFF(CURDATE(), p.exp_date) as days_expired FROM products p WHERE p.exp_date IS NOT NULL AND p.exp_date < CURDATE() ORDER BY p.exp_date DESC LIMIT 5");
$totalExpiring = $conn->query("SELECT COUNT(*) as c FROM products p WHERE p.exp_date IS NOT NULL AND p.exp_date >= CURDATE() AND DATEDIFF(p.exp_date, CURDATE()) <= 30")->fetch_assoc()['c'];
$totalExpired = $conn->query("SELECT COUNT(*) as c FROM products p WHERE p.exp_date IS NOT NULL AND p.exp_date < CURDATE()")->fetch_assoc()['c'];

// === DAILY CHART DATA (LAST 7 DAYS) ===
$chartLabels = []; $chartSales = []; $chartBuy = [];
for ($i = 6; $i >= 0; $i--) {
    $d = date('Y-m-d', strtotime("-$i days"));
    $chartLabels[] = date('d M', strtotime($d));
    $sr = $conn->query("SELECT COALESCE(SUM(net_amount),0) as t FROM sales WHERE sale_date='$d'")->fetch_assoc();
    $br = $conn->query("SELECT COALESCE(SUM(total_amount),0) as t FROM purchases WHERE purchase_date='$d'")->fetch_assoc();
    $chartSales[] = floatval($sr['t']);
    $chartBuy[] = floatval($br['t']);
}

// === PLATFORM MIX THIS MONTH ===
$platformMix = $conn->query("SELECT platform, COUNT(*) as trx, SUM(net_amount) as net FROM sales WHERE DATE_FORMAT(sale_date,'%Y-%m') = '$thisMonth' GROUP BY platform ORDER BY net DESC");
$platData = []; $platLabels = []; $platValues = [];
while ($pm = $platformMix->fetch_assoc()) {
    $platData[] = $pm;
    $platLabels[] = $pm['platform'];
    $platValues[] = floatval($pm['net']);
}

$script = '
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
// 7-Day Chart
var opt1 = {
    chart: { type: "area", height: 260, toolbar: { show: false }, fontFamily: "inherit", background: "transparent" },
    series: [
        { name: "Penjualan (Nett)", data: '.json_encode($chartSales).' },
        { name: "Pembelian", data: '.json_encode($chartBuy).' }
    ],
    colors: ["#6366f1", "#f43f5e"],
    xaxis: { categories: '.json_encode($chartLabels).', labels: { style: { fontSize: "11px", colors: "#64748b" } }, axisBorder: { show: false }, axisTicks: { show: false } },
    yaxis: { labels: { formatter: function(v){ if(v >= 1000000) return (v/1000000).toFixed(1) + "jt"; if(v >= 1000) return (v/1000).toFixed(0) + "rb"; return v; }, style: { fontSize: "11px", colors: "#64748b" } } },
    stroke: { curve: "smooth", width: 2 },
    fill: { type: "gradient", gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.05, stops: [0, 90, 100] } },
    dataLabels: { enabled: false },
    tooltip: { y: { formatter: function(v){ return "Rp " + v.toLocaleString("id-ID"); }, style: { fontSize: "12px" } }, theme: "light" },
    legend: { position: "top", horizontalAlign: "right", fontSize: "12px", fontWeight: 500, itemMargin: { horizontal: 12, vertical: 0 } },
    grid: { borderColor: "#f1f5f9", strokeDashArray: 4, yaxis: { lines: { show: true } } },
    padding: { top: 0, right: 0, bottom: 0, left: 0 }
};
new ApexCharts(document.querySelector("#salesChart"), opt1).render();

// Platform Donut
'.( count($platValues) > 0 ? '
var opt2 = {
    chart: { type: "donut", height: 240, fontFamily: "inherit", background: "transparent" },
    series: '.json_encode($platValues).',
    labels: '.json_encode($platLabels).',
    colors: ["#6366f1","#f43f5e","#10b981","#f59e0b","#8b5cf6","#06b6d4"],
    legend: { position: "bottom", fontSize: "11px", fontWeight: 500, itemMargin: { horizontal: 6, vertical: 4 }, formatter: function(seriesName, opts) { return seriesName + ": " + opts.w.globals.series[opts.seriesIndex].toLocaleString("id-ID") } },
    dataLabels: { enabled: false },
    tooltip: { y: { formatter: function(v){ return "Rp " + v.toLocaleString("id-ID"); } } },
    plotOptions: { pie: { donut: { size: "70%", labels: { show: true, total: { show: true, label: "Total", fontSize: "12px", fontWeight: 500, color: "#64748b", formatter: function(w){ return "Rp " + w.globals.seriesTotals.reduce((a,b)=>a+b,0).toLocaleString("id-ID"); } } } } } },
    stroke: { show: false }
};
new ApexCharts(document.querySelector("#platformChart"), opt2).render();
' : '').'
</script>
';
?>
<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body" style="padding: 24px; background: #f8fafc; min-height: 100vh;">
    <!-- Header Section -->
    <div style="margin-bottom: 24px;">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <h2 style="font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 2px;">Dashboard</h2>
                <p style="font-size: 12px; color: #64748b; margin-bottom: 0;">Selamat datang! Ringkasan bisnis Toko Sembako Anin</p>
            </div>
            <div class="d-flex gap-2">
                <a href="penjualan_pos.php" class="btn d-flex align-items-center gap-2" style="background: #6366f1; color: white; border: none; padding: 8px 16px; font-size: 12px; font-weight: 500; border-radius: 8px;">
                    <iconify-icon icon="solar:cash-out-bold" style="font-size: 16px;"></iconify-icon> Buka Kasir
                </a>
                <a href="pembelian_add.php" class="btn d-flex align-items-center gap-2" style="background: white; color: #6366f1; border: 1px solid #e0e7ff; padding: 8px 16px; font-size: 12px; font-weight: 500; border-radius: 8px;">
                    <iconify-icon icon="solar:cart-plus-bold" style="font-size: 16px;"></iconify-icon> Catat Pembelian
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3" style="margin-bottom: 24px;">
        <!-- Penjualan Hari Ini -->
        <div class="col-xl-3 col-md-6">
            <div style="background: white; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9; height: 100%;">
                <div class="d-flex align-items-start justify-content-between">
                    <div style="flex: 1;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 500; margin-bottom: 6px;">Penjualan Hari Ini</div>
                        <div style="font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 2px;">Rp <?= number_format($todaySales['total'],0,',','.') ?></div>
                        <div style="font-size: 10px; color: #64748b;">
                            <span style="color: #10b981; font-weight: 500;"><?= $todaySales['trx'] ?> transaksi</span>
                            <span style="margin: 0 4px;">·</span>
                            <span>Nett: Rp <?= number_format($todaySales['net'],0,',','.') ?></span>
                        </div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <iconify-icon icon="solar:cash-out-bold" style="font-size: 22px; color: #6366f1;"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pembelian Hari Ini -->
        <div class="col-xl-3 col-md-6">
            <div style="background: white; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9; height: 100%;">
                <div class="d-flex align-items-start justify-content-between">
                    <div style="flex: 1;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 500; margin-bottom: 6px;">Pembelian Hari Ini</div>
                        <div style="font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 2px;">Rp <?= number_format($todayBuy['total'],0,',','.') ?></div>
                        <div style="font-size: 10px; color: #64748b;">
                            <span style="color: #f43f5e; font-weight: 500;"><?= $todayBuy['trx'] ?> transaksi</span>
                        </div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <iconify-icon icon="solar:cart-large-4-bold" style="font-size: 22px; color: #f43f5e;"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profit Bulan Ini -->
        <div class="col-xl-3 col-md-6">
            <div style="background: white; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9; height: 100%;">
                <div class="d-flex align-items-start justify-content-between">
                    <div style="flex: 1;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 500; margin-bottom: 6px;">Profit Bulan Ini <?= $monthProfit >= 0 ? '↑' : '↓' ?></div>
                        <div style="font-size: 20px; font-weight: 700; color: <?= $monthProfit >= 0 ? '#10b981' : '#f43f5e' ?>; margin-bottom: 2px;">Rp <?= number_format(abs($monthProfit),0,',','.') ?></div>
                        <div style="font-size: 10px; color: #64748b;">
                            <span>Nett: <?= number_format($monthSales['net'],0,',','.') ?></span>
                            <span style="margin: 0 4px;">·</span>
                            <span>Beli: <?= number_format($monthBuy['total'],0,',','.') ?></span>
                        </div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: <?= $monthProfit >= 0 ? 'linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%)' : 'linear-gradient(135deg, #fee2e2 0%, #fecaca 100%)' ?>; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <iconify-icon icon="<?= $monthProfit >= 0 ? 'solar:graph-up-bold' : 'solar:graph-down-bold' ?>" style="font-size: 22px; color: <?= $monthProfit >= 0 ? '#10b981' : '#f43f5e' ?>;"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inventori -->
        <div class="col-xl-3 col-md-6">
            <div style="background: white; border-radius: 12px; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9; height: 100%;">
                <div class="d-flex align-items-start justify-content-between">
                    <div style="flex: 1;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 500; margin-bottom: 6px;">Inventori</div>
                        <div style="font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 2px;"><?= $totalProducts ?> <span style="font-size: 13px; font-weight: 500;">Produk</span></div>
                        <div style="font-size: 10px; color: #64748b; margin-top: 6px;">
                            <?php if($lowStock > 0): ?><span style="background: #fef3c7; color: #d97706; padding: 2px 8px; border-radius: 4px; font-weight: 500;">⚠ <?= $lowStock ?> stok menipis</span><?php endif; ?>
                            <?php if($outOfStock > 0): ?><span style="background: #fee2e2; color: #dc2626; padding: 2px 8px; border-radius: 4px; font-weight: 500; margin-left: 4px;">🔴 <?= $outOfStock ?> habis</span><?php endif; ?>
                            <?php if($totalExpiring > 0): ?><span style="background: #fef9c3; color: #ca8a04; padding: 2px 8px; border-radius: 4px; font-weight: 500; margin-left: 4px;">⏰ <?= $totalExpiring ?> kadaluarsa</span><?php endif; ?>
                            <?php if($totalExpired > 0): ?><span style="background: #fecaca; color: #dc2626; padding: 2px 8px; border-radius: 4px; font-weight: 500; margin-left: 4px;">⚠️ <?= $totalExpired ?> expired</span><?php endif; ?>
                            <?php if($lowStock == 0 && $outOfStock == 0 && $totalExpiring == 0 && $totalExpired == 0): ?><span style="background: #d1fae5; color: #059669; padding: 2px 8px; border-radius: 4px; font-weight: 500;">✓ Semua aman</span><?php endif; ?>
                        </div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <iconify-icon icon="solar:box-bold" style="font-size: 22px; color: #f59e0b;"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-3" style="margin-bottom: 24px;">
        <!-- Trend Chart -->
        <div class="col-lg-8">
            <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9; overflow: hidden;">
                <div style="padding: 14px 18px; border-bottom: 1px solid #f1f5f9;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 style="font-size: 13px; font-weight: 600; color: #0f172a; margin-bottom: 1px;">Tren Penjualan vs Pembelian</h6>
                            <p style="font-size: 11px; color: #64748b; margin-bottom: 0;">7 hari terakhir</p>
                        </div>
                        <a href="report_harian.php" style="font-size: 11px; color: #6366f1; text-decoration: none; font-weight: 500;">Lihat Detail →</a>
                    </div>
                </div>
                <div style="padding: 12px 18px 18px;">
                    <div id="salesChart"></div>
                </div>
            </div>
        </div>

        <!-- Platform Mix -->
        <div class="col-lg-4">
            <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9; overflow: hidden;">
                <div style="padding: 14px 18px; border-bottom: 1px solid #f1f5f9;">
                    <h6 style="font-size: 13px; font-weight: 600; color: #0f172a; margin-bottom: 1px;">Platform Penjualan</h6>
                    <p style="font-size: 11px; color: #64748b; margin-bottom: 0;"><?= date('F Y') ?></p>
                </div>
                <div style="padding: 12px 18px 18px;">
                    <?php if(count($platValues) > 0): ?>
                    <div id="platformChart"></div>
                    <?php else: ?>
                    <div style="text-align: center; color: #94a3b8; padding: 32px 0; font-size: 12px;">Belum ada data penjualan bulan ini</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Section -->
    <div class="row g-3" style="margin-bottom: 24px;">
        <!-- Top Products -->
        <div class="col-lg-4">
            <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9; overflow: hidden;">
                <div style="padding: 14px 18px; border-bottom: 1px solid #f1f5f9;">
                    <h6 style="font-size: 13px; font-weight: 600; color: #0f172a; margin-bottom: 0;">🏆 Top Produk Bulan Ini</h6>
                </div>
                <div style="padding: 0;">
                    <table class="table table-sm mb-0" style="font-size: 11px;">
                        <tbody>
                        <?php $rank=1; while($tp = $topProducts->fetch_assoc()): ?>
                            <tr style="border-bottom: 1px solid #f8fafc;">
                                <td style="padding: 10px 18px; width: 40px; text-align: center;">
                                    <?php if($rank <= 3): ?><span style="font-size: 16px;"><?= ['🥇','🥈','🥉'][$rank-1] ?></span>
                                    <?php else: ?><span style="color: #94a3b8; font-weight: 500;"><?= $rank ?></span><?php endif; ?>
                                </td>
                                <td style="padding: 10px 0 10px 10px;">
                                    <div style="font-weight: 600; color: #0f172a; margin-bottom: 1px;"><?= htmlspecialchars($tp['name']) ?></div>
                                    <div style="color: #64748b; font-size: 10px;">Terjual: <?= round(floatval($tp['sold_qty'])) ?> <?= htmlspecialchars($tp['base_unit'] ?? '') ?></div>
                                </td>
                                <td style="padding: 10px 18px 10px 10px; text-align: right; font-weight: 600; color: #6366f1;">Rp <?= number_format($tp['revenue'],0,',','.') ?></td>
                            </tr>
                        <?php $rank++; endwhile; ?>
                        <?php if($rank == 1): ?><tr><td colspan="3" style="text-align: center; color: #94a3b8; padding: 32px 18px;">Belum ada penjualan</td></tr><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="col-lg-4">
            <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9; overflow: hidden;">
                <div style="padding: 14px 18px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                    <h6 style="font-size: 13px; font-weight: 600; color: #0f172a; margin-bottom: 0;">Transaksi Terakhir</h6>
                    <a href="report_harian.php" style="font-size: 11px; color: #6366f1; text-decoration: none; font-weight: 500;">Semua →</a>
                </div>
                <div style="padding: 0;">
                    <?php $hasSales = false; while($rs = $recentSales->fetch_assoc()): $hasSales = true; ?>
                    <div style="padding: 10px 18px; border-bottom: 1px solid #f8fafc; display: flex; align-items: center; justify-content: space-between;">
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-weight: 600; color: #0f172a; font-size: 11px; margin-bottom: 1px;"><?= htmlspecialchars($rs['invoice_num']) ?></div>
                            <div style="color: #64748b; font-size: 10px;">
                                <?= date('d M Y', strtotime($rs['sale_date'])) ?>
                                <span style="background: #f1f5f9; color: #475569; padding: 2px 6px; border-radius: 3px; font-size: 9px; margin-left: 4px;"><?= htmlspecialchars($rs['platform']) ?></span>
                            </div>
                        </div>
                        <div style="text-align: right; margin-left: 8px;">
                            <div style="font-weight: 600; color: #0f172a; font-size: 11px;">Rp <?= number_format($rs['net_amount'],0,',','.') ?></div>
                            <?php if($rs['fee_amount'] > 0): ?><div style="color: #f43f5e; font-size: 9px; font-weight: 500;">-<?= number_format($rs['fee_amount'],0,',','.') ?></div><?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php if(!$hasSales): ?><div style="text-align: center; color: #94a3b8; padding: 32px 18px; font-size: 12px;">Belum ada transaksi</div><?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div class="col-lg-4">
            <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9; overflow: hidden;">
                <div style="padding: 14px 18px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                    <h6 style="font-size: 13px; font-weight: 600; color: #0f172a; margin-bottom: 0;">⚠️ Peringatan Stok</h6>
                    <a href="current_stock.php" style="font-size: 11px; color: #6366f1; text-decoration: none; font-weight: 500;">Lihat Semua →</a>
                </div>
                <div style="padding: 0;">
                    <?php $hasLow = false; while($ls = $lowStockProducts->fetch_assoc()): $hasLow = true;
                        $stk = floatval($ls['stock']);
                        if($stk <= 0) {
                            $badgeBg = '#fee2e2';
                            $badgeColor = '#dc2626';
                            $badgeText = 'HABIS';
                        } elseif($stk <= 5) {
                            $badgeBg = '#fef3c7';
                            $badgeColor = '#d97706';
                            $badgeText = ($stk == intval($stk) ? intval($stk) : number_format($stk,2,',','.')).' '.htmlspecialchars($ls['unit_name'] ?? '');
                        } else {
                            $badgeBg = '#d1fae5';
                            $badgeColor = '#059669';
                            $badgeText = ($stk == intval($stk) ? intval($stk) : number_format($stk,2,',','.')).' '.htmlspecialchars($ls['unit_name'] ?? '');
                        }
                    ?>
                    <div style="padding: 10px 18px; border-bottom: 1px solid #f8fafc; display: flex; align-items: center; justify-content: space-between;">
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-weight: 600; color: #0f172a; font-size: 11px; margin-bottom: 1px;"><?= htmlspecialchars($ls['name']) ?></div>
                            <div style="color: #64748b; font-size: 10px;"><?= htmlspecialchars($ls['code']) ?></div>
                        </div>
                        <span style="background: <?= $badgeBg ?>; color: <?= $badgeColor ?>; padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: 600; white-space: nowrap; margin-left: 8px;">
                            <?= $badgeText ?>
                        </span>
                    </div>
                    <?php endwhile; ?>
                    <?php if(!$hasLow): ?><div style="text-align: center; color: #94a3b8; padding: 32px 18px; font-size: 12px;">✅ Semua stok aman!</div><?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Expiry Alert -->
        <div class="col-lg-4">
            <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f1f5f9; overflow: hidden;">
                <div style="padding: 14px 18px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                    <h6 style="font-size: 13px; font-weight: 600; color: #0f172a; margin-bottom: 0;">⏰ Peringatan Kadaluarsa</h6>
                    <a href="master_produk.php" style="font-size: 11px; color: #6366f1; text-decoration: none; font-weight: 500;">Lihat Semua →</a>
                </div>
                <div style="padding: 0;">
                    <?php $hasExp = false;
                    // Show expiring products first
                    while($ex = $expiringSoon->fetch_assoc()): $hasExp = true;
                        $days = intval($ex['days_left']);
                        if($days <= 7) {
                            $badgeBg = '#fee2e2';
                            $badgeColor = '#dc2626';
                            $badgeText = $days == 0 ? 'Hari Ini' : $days.' hari lagi';
                        } elseif($days <= 14) {
                            $badgeBg = '#fef9c3';
                            $badgeColor = '#ca8a04';
                            $badgeText = $days.' hari lagi';
                        } else {
                            $badgeBg = '#dbeafe';
                            $badgeColor = '#3b82f6';
                            $badgeText = $days.' hari lagi';
                        }
                    ?>
                    <div style="padding: 10px 18px; border-bottom: 1px solid #f8fafc; display: flex; align-items: center; justify-content: space-between;">
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-weight: 600; color: #0f172a; font-size: 11px; margin-bottom: 1px;"><?= htmlspecialchars($ex['name']) ?></div>
                            <div style="color: #64748b; font-size: 10px;"><?= htmlspecialchars($ex['code']) ?></div>
                        </div>
                        <span style="background: <?= $badgeBg ?>; color: <?= $badgeColor ?>; padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: 600; white-space: nowrap; margin-left: 8px;">
                            <?= $badgeText ?>
                        </span>
                    </div>
                    <?php endwhile; ?>

                    <?php
                    // Then show expired products
                    while($ex = $expiredProducts->fetch_assoc()): $hasExp = true;
                    ?>
                    <div style="padding: 10px 18px; border-bottom: 1px solid #f8fafc; display: flex; align-items: center; justify-content: space-between; background: #fef2f2;">
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-weight: 600; color: #dc2626; font-size: 11px; margin-bottom: 1px;"><?= htmlspecialchars($ex['name']) ?></div>
                            <div style="color: #991b1b; font-size: 10px;"><?= htmlspecialchars($ex['code']) ?></div>
                        </div>
                        <span style="background: #dc2626; color: #fff; padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: 600; white-space: nowrap; margin-left: 8px;">
                            EXPIRED
                        </span>
                    </div>
                    <?php endwhile; ?>

                    <?php if(!$hasExp): ?><div style="text-align: center; color: #94a3b8; padding: 32px 18px; font-size: 12px;">✅ Tidak ada produk kadaluarsa</div><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Summary -->
    <div class="row">
        <div class="col-12">
            <div style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); border-radius: 12px; padding: 20px 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div style="color: rgba(255,255,255,0.6); font-size: 11px; font-weight: 500; margin-bottom: 6px;">Total Penjualan Bulan Ini</div>
                        <div style="color: #ffffff; font-size: 18px; font-weight: 700;">Rp <?= number_format($monthSales['total'],0,',','.') ?></div>
                    </div>
                    <div class="col-md-3" style="border-left: 1px solid rgba(255,255,255,0.1); border-right: 1px solid rgba(255,255,255,0.1);">
                        <div style="color: rgba(255,255,255,0.6); font-size: 11px; font-weight: 500; margin-bottom: 6px;">Fee Admin Bulan Ini</div>
                        <div style="color: #fbbf24; font-size: 18px; font-weight: 700;">-Rp <?= number_format($monthSales['fee'],0,',','.') ?></div>
                    </div>
                    <div class="col-md-3" style="border-right: 1px solid rgba(255,255,255,0.1);">
                        <div style="color: rgba(255,255,255,0.6); font-size: 11px; font-weight: 500; margin-bottom: 6px;">Nett Bulan Ini</div>
                        <div style="color: #4ade80; font-size: 18px; font-weight: 700;">Rp <?= number_format($monthSales['net'],0,',','.') ?></div>
                    </div>
                    <div class="col-md-3">
                        <div style="color: rgba(255,255,255,0.6); font-size: 11px; font-weight: 500; margin-bottom: 6px;">Total Pembelian Bulan Ini</div>
                        <div style="color: #f87171; font-size: 18px; font-weight: 700;">Rp <?= number_format($monthBuy['total'],0,',','.') ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
