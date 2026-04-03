<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// If POST handle saving
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'save_purchase') {
    $invoice_num = $_POST['invoice_num'];
    $purchase_date = $_POST['purchase_date'];
    $supplier_name = $_POST['supplier_name'];
    $has_fee = isset($_POST['has_admin_fee']) ? 1 : 0;
    $admin_fee_id = $has_fee && !empty($_POST['admin_fee_id']) ? intval($_POST['admin_fee_id']) : NULL;
    $fee_pct = 0;

    if ($admin_fee_id) {
        $fee_q = $conn->prepare("SELECT fee_percentage FROM admin_fees WHERE id = ?");
        $fee_q->bind_param("i", $admin_fee_id);
        $fee_q->execute();
        $fee_r = $fee_q->get_result()->fetch_assoc();
        if ($fee_r) $fee_pct = floatval($fee_r['fee_percentage']);
    }

    $stmt = $conn->prepare("INSERT INTO purchases (invoice_num, purchase_date, supplier_name, total_amount, admin_fee_id, fee_percentage, fee_amount, net_amount) VALUES (?, ?, ?, 0, ?, ?, 0, 0)");
    $stmt->bind_param("sssid", $invoice_num, $purchase_date, $supplier_name, $admin_fee_id, $fee_pct);
    if($stmt->execute()) {
        $purchase_id = $conn->insert_id;

        if(isset($_POST['product_id']) && is_array($_POST['product_id'])) {
            $products = $_POST['product_id'];
            $units = $_POST['unit_id'];
            $qtys = $_POST['qty'];
            $multipliers = $_POST['multiplier'];
            $prices = $_POST['price_unit'];
            $grand_total = 0;

            for($i=0; $i < count($products); $i++){
                $pid = $products[$i]; $uid = $units[$i]; $q = $qtys[$i]; $m = $multipliers[$i]; $p = $prices[$i];
                $subtotal = $q * $p; $base_qty = $q / $m; $grand_total += $subtotal;

                $d_stmt = $conn->prepare("INSERT INTO purchase_details (purchase_id, product_id, unit_id, qty, base_qty, price_unit, subtotal) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $d_stmt->bind_param("iiidddd", $purchase_id, $pid, $uid, $q, $base_qty, $p, $subtotal);
                $d_stmt->execute();

                $stock_stmt = $conn->prepare("UPDATE products SET stock = stock + ? WHERE id = ?");
                $stock_stmt->bind_param("di", $base_qty, $pid);
                $stock_stmt->execute();
            }

            $fee_amount = $grand_total * ($fee_pct / 100);
            $net_amount = $grand_total - $fee_amount;
            $conn->query("UPDATE purchases SET total_amount = $grand_total, fee_amount = $fee_amount, net_amount = $net_amount WHERE id = $purchase_id");
        }

        echo "<script>alert('Pembelian Berhasil Disimpan & Stok Bertambah!'); window.location='pembelian.php';</script>";
        exit;
    }
}

// Fetch for dropdowns
$products = $conn->query("SELECT p.id, p.code, p.name FROM products p ORDER BY name ASC");
$prod_options = '';
while($p = $products->fetch_assoc()) {
    $prod_options .= '<option value="'.$p['id'].'">['.htmlspecialchars($p['code']).'] '.htmlspecialchars($p['name']).'</option>';
}

$fees = $conn->query("SELECT f.*, c.name as category_name FROM admin_fees f LEFT JOIN categories c ON f.category_id = c.id ORDER BY f.platform ASC");
$fee_options = '';
while($f = $fees->fetch_assoc()) {
    $label = htmlspecialchars($f['platform']);
    if ($f['category_id']) $label .= ' - ' . htmlspecialchars($f['category_name']);
    $label .= ' (' . floatval($f['fee_percentage']) . '%)';
    $fee_options .= '<option value="'.$f['id'].'" data-pct="'.floatval($f['fee_percentage']).'">'.$label.'</option>';
}

$script = '
    <script>
       $(document).ready(function() {
           $("#chk_admin_fee").on("change", function(){
               if($(this).is(":checked")) { $("#admin_fee_section").slideDown(200); }
               else { $("#admin_fee_section").slideUp(200); $("#admin_fee_id").val(""); recalcFee(); }
           });
           $("#admin_fee_id").on("change", function(){ recalcFee(); });
       });

       function fetchUnits() {
           var pid = $("#item_product").val();
           if(!pid) { $("#item_unit").html(\'<option value="">Pilih...</option>\'); return; }
           $("#item_unit").html(\'<option value="">Memuat...</option>\');
           $.getJSON("api_get_units.php?product_id="+pid, function(data){
               var html = "";
               $.each(data, function(i, v){
                   html += \'<option value="\'+v.unit_id+\'" data-mult="\'+v.multiplier+\'">\'+v.unit_name+\'</option>\';
               });
               $("#item_unit").html(html);
               calcLine();
           });
       }
       function calcLine() {
           var q = parseFloat($("#item_qty").val()) || 0;
           var p = parseFloat($("#item_price").val()) || 0;
           $("#item_sub_display").text("Rp " + (q*p).toLocaleString("id-ID"));
       }
       function addToCart() {
           var pid = $("#item_product").val(), pname = $("#item_product option:selected").text();
           var uid = $("#item_unit").val(), uname = $("#item_unit option:selected").text();
           var mult = $("#item_unit option:selected").data("mult") || 1;
           var qty = parseFloat($("#item_qty").val()) || 0, price = parseFloat($("#item_price").val()) || 0;
           var subtotal = qty * price;
           if(!pid || !uid || qty <= 0 || price <= 0) { alert("Lengkapi data dulu!"); return; }
           var idx = $("#cart_body tr.ci").length + 1;
           var r = \'<tr class="ci"><td class="text-center">\'+idx+\'</td>\';
           r += \'<td>\'+pname+\'<input type="hidden" name="product_id[]" value="\'+pid+\'"></td>\';
           r += \'<td><span class="badge bg-light text-dark border">\'+uname+\'</span><input type="hidden" name="unit_id[]" value="\'+uid+\'"><input type="hidden" name="multiplier[]" value="\'+mult+\'"></td>\';
           r += \'<td class="text-center">\'+qty+\'<input type="hidden" name="qty[]" value="\'+qty+\'"></td>\';
           r += \'<td class="text-end">Rp \'+price.toLocaleString("id-ID")+\'<input type="hidden" name="price_unit[]" value="\'+price+\'"></td>\';
           r += \'<td class="text-end fw-semibold">Rp \'+subtotal.toLocaleString("id-ID")+\'</td>\';
           r += \'<td class="text-center"><a href="javascript:void(0)" class="text-danger" onclick="removeRow(this,\'+subtotal+\')"><iconify-icon icon="mingcute:delete-2-line"></iconify-icon></a></td></tr>\';
           $("#cart_body").append(r);
           $("#cart_empty").hide();
           $("#item_product").val("");
           $("#item_unit").html(\'<option value="">Pilih...</option>\');
           $("#item_qty").val(1); $("#item_price").val(""); $("#item_sub_display").text("Rp 0");
           grandTotal += subtotal; refreshTotals();
       }
       function removeRow(el, sub) {
           $(el).closest("tr").remove(); grandTotal -= sub; refreshTotals();
           $("#cart_body tr.ci").each(function(i){ $(this).find("td:first").text(i+1); });
           if(!$("#cart_body tr.ci").length) $("#cart_empty").show();
       }
       var grandTotal = 0;
       function recalcFee() { refreshTotals(); }
       function refreshTotals() {
           $("#d_subtotal").text("Rp " + grandTotal.toLocaleString("id-ID"));
           var pct = 0;
           if($("#chk_admin_fee").is(":checked")) pct = parseFloat($("#admin_fee_id option:selected").data("pct")) || 0;
           var fee = grandTotal * (pct / 100), net = grandTotal - fee;
           if(pct > 0) { $("#fee_row").show(); $("#d_fee_label").text("Biaya Admin ("+pct+"%)"); $("#d_fee").text("- Rp "+fee.toLocaleString("id-ID")); }
           else { $("#fee_row").hide(); }
           $("#d_net").text("Rp " + (pct > 0 ? net : grandTotal).toLocaleString("id-ID"));
       }
    </script>
';
?>

<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">
            <a href="pembelian.php" class="text-muted me-1"><iconify-icon icon="solar:arrow-left-linear"></iconify-icon></a>
            Input Pembelian Baru
        </h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium"><a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary"><iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon> Dashboard</a></li>
            <li>-</li>
            <li class="fw-medium"><a href="pembelian.php" class="hover-text-primary">Pembelian</a></li>
            <li>-</li>
            <li class="fw-medium">Input Baru</li>
        </ul>
    </div>

    <form method="POST" action="">
    <input type="hidden" name="action" value="save_purchase">
    <div class="row g-3">
        <!-- KIRI -->
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Input Barang</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Produk</label>
                        <select id="item_product" class="form-select" onchange="fetchUnits()">
                            <option value="">-- Cari Produk --</option>
                            <?= $prod_options ?>
                        </select>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-3">
                            <label class="form-label">Satuan</label>
                            <select id="item_unit" class="form-select"><option value="">Pilih...</option></select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" id="item_qty" class="form-control" value="1" step="0.01" min="0.01" oninput="calcLine()">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Harga</label>
                            <input type="number" id="item_price" class="form-control" placeholder="0" oninput="calcLine()">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <button type="button" class="btn btn-primary w-100" onclick="addToCart()">
                                Tambah
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3" style="border-top: 1px solid #f1f5f9;">
                        <span class="text-muted">Subtotal:</span>
                        <strong class="text-danger" style="font-size:16px;" id="item_sub_display">Rp 0</strong>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Barang</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="cart_table">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:50px">#</th>
                                    <th>Produk</th>
                                    <th>Satuan</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-end">Subtotal</th>
                                    <th class="text-center" style="width:50px"></th>
                                </tr>
                            </thead>
                            <tbody id="cart_body">
                                <tr id="cart_empty">
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        
                                        <span class="d-block fs-6">Belum ada barang</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- KANAN -->
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informasi Pembelian</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">No. Invoice</label>
                        <input type="text" name="invoice_num" class="form-control" placeholder="INV-001" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="purchase_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Supplier</label>
                        <input type="text" name="supplier_name" class="form-control" placeholder="Opsional">
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="form-check form-switch d-flex justify-content-between align-items-center">
                        <label class="form-check-label fw-medium" for="chk_admin_fee">
                            <iconify-icon icon="solar:tag-price-bold" class="text-warning me-2"></iconify-icon>
                            Potong Biaya Admin?
                        </label>
                        <input class="form-check-input" type="checkbox" id="chk_admin_fee" name="has_admin_fee" value="1">
                    </div>
                    <div id="admin_fee_section" style="display:none;" class="mt-3">
                        <select name="admin_fee_id" id="admin_fee_id" class="form-select">
                            <option value="">-- Pilih Platform --</option>
                            <?= $fee_options ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body" style="background:linear-gradient(135deg,#6366f1 0%,#4f46e5 100%); border-radius:12px; padding:20px; color:#fff;">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="opacity:.8; font-size:13px;">Subtotal</span>
                        <span class="fw-semibold" id="d_subtotal" style="font-size:15px;">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2" id="fee_row" style="display:none;">
                        <span style="opacity:.8; font-size:13px;" id="d_fee_label">Biaya Admin</span>
                        <span class="fw-semibold" style="color:#ffd54f;" id="d_fee">- Rp 0</span>
                    </div>
                    <hr style="border-color:rgba(255,255,255,.2); margin:12px 0;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Total Bayar</span>
                        <span class="fw-bold" style="font-size:22px;" id="d_net">Rp 0</span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100 mb-2">
                Simpan
            </button>
            <a href="pembelian.php" class="btn btn-outline-secondary w-100">
                Kembali
            </a>
        </div>
    </div>
    </form>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
