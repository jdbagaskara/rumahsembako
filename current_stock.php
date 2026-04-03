<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Fetch all products with base unit
$query = "SELECT p.id, p.code, p.name, p.stock, c.name as category_name, u.name as base_unit_name 
          FROM products p 
          LEFT JOIN categories c ON p.category_id = c.id 
          LEFT JOIN units u ON p.base_unit_id = u.id 
          ORDER BY p.name ASC";
$products = $conn->query($query);

// Fetch ALL conversions grouped by product_id for JS
$conv_query = "SELECT pc.product_id, pc.unit_id, u.name as unit_name, pc.multiplier 
               FROM product_conversions pc 
               JOIN units u ON pc.unit_id = u.id 
               ORDER BY pc.product_id, u.name";
$convs = $conn->query($conv_query);
$conv_map = [];
while($cv = $convs->fetch_assoc()) {
    $conv_map[$cv['product_id']][] = $cv;
}

$script = '
    <style>
        .dataTables_wrapper .dataTables_length select {
            width: auto;
            display: inline-block;
            padding: 4px 8px;
            font-size: 12px;
            border: 1px solid #d9dee3;
            border-radius: 4px;
        }
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #d9dee3;
            border-radius: 4px;
            padding: 6px 12px;
            font-size: 12px;
            margin-left: 8px;
        }
        .dataTables_wrapper .dataTables_info {
            font-size: 12px;
            color: #64748b;
            padding-top: 12px;
        }
        .dataTables_wrapper .dataTables_paginate {
            font-size: 12px;
            padding-top: 8px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 4px 10px !important;
            margin: 0 2px;
            border-radius: 4px;
            border: 1px solid #d9dee3;
            background: white;
            color: #6366f1;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #6366f1 !important;
            color: white !important;
            border-color: #6366f1 !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f1f5f9 !important;
            border-color: #6366f1;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #cbd5e1;
            cursor: default;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            background: white !important;
            border-color: #d9dee3;
        }
    </style>
    <script>
       var convData = '.json_encode($conv_map).';
       let table = new DataTable("#dataTable", {
           pageLength: 25,
           language: {
               search: "Cari produk...",
               lengthMenu: "Tampilkan _MENU_ produk per halaman",
               info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ produk",
               paginate: {
                   first: "",
                   last: "",
                   next: "›",
                   previous: "‹"
               }
           }
       });

       function convertStock(pid) {
           var sel = document.getElementById("conv_" + pid);
           var baseStock = parseFloat(document.getElementById("base_" + pid).dataset.stock);
           var resultEl = document.getElementById("result_" + pid);

           if(sel.value === "" || sel.value === "base") {
               resultEl.textContent = "-";
               return;
           }

           var mult = parseFloat(sel.options[sel.selectedIndex].dataset.mult);
           if(mult > 0) {
               var converted = baseStock * mult;
               var formatted = converted % 1 === 0 ? converted.toFixed(0) : converted.toFixed(2);
               var unitName = sel.options[sel.selectedIndex].text;
               resultEl.innerHTML = \'<strong class="text-primary">\' + formatted + \'</strong> \' + unitName;
           } else {
               resultEl.textContent = "-";
           }
       }
    </script>
';
?>

<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Current Stock / Stok Barang</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium"><a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary"><iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon> Dashboard</a></li>
            <li>-</li>
            <li class="fw-medium">Current Stock</li>
        </ul>
    </div>

    <div class="card basic-data-table">
        <div class="card-header">
            <h5 class="card-title mb-0">Stok Produk Saat Ini</h5>
        </div>
        <div class="card-body">
            <table class="table bordered-table mb-0" id="dataTable">
                <thead>
                    <tr>
                        <th class="text-center" style="width:50px">#</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th class="text-center">Stok Dasar</th>
                        <th style="width:140px">Konversi</th>
                        <th class="text-center">Hasil</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; while($row = $products->fetch_assoc()):
                        $pid = $row['id'];
                        $has_conv = isset($conv_map[$pid]) && count($conv_map[$pid]) > 0;
                        $stock_val = floatval($row['stock']);
                        $stock_display = ($stock_val == intval($stock_val)) ? intval($stock_val) : number_format($stock_val, 2, ',', '.');

                        if ($stock_val <= 0) {
                            $stock_badge = 'bg-danger';
                            $stock_icon = '🔴';
                        } elseif ($stock_val <= 10) {
                            $stock_badge = 'bg-warning';
                            $stock_icon = '⚠️';
                        } else {
                            $stock_badge = 'bg-success';
                            $stock_icon = '✓';
                        }
                    ?>
                    <tr>
                        <td class="text-center text-muted"><?= $no++ ?></td>
                        <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($row['code']) ?></span></td>
                        <td class="fw-medium"><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['category_name'] ?? '-') ?></td>
                        <td class="text-center">
                            <span class="badge <?= $stock_badge ?> text-white" id="base_<?= $pid ?>" data-stock="<?= $stock_val ?>">
                                <?= $stock_icon ?> <?= $stock_display ?>
                            </span>
                            <small class="text-muted d-block"><?= htmlspecialchars($row['base_unit_name'] ?? '') ?></small>
                        </td>
                        <td>
                            <?php if($has_conv): ?>
                            <select class="form-select form-select-sm" id="conv_<?= $pid ?>" onchange="convertStock(<?= $pid ?>)">
                                <option value="">Pilih...</option>
                                <?php foreach($conv_map[$pid] as $c): ?>
                                <option value="<?= $c['unit_id'] ?>" data-mult="<?= $c['multiplier'] ?>"><?= htmlspecialchars($c['unit_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php else: ?>
                            <span class="text-muted"><small>−</small></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center" id="result_<?= $pid ?>">-</td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
