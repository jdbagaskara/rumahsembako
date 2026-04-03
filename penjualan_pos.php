<?php 
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
include 'koneksi.php';

// Handle sale save
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'save_sale') {
    $platform = $_POST['platform'];
    $sale_date = date('Y-m-d');
    $admin_fee_id = !empty($_POST['admin_fee_id']) ? intval($_POST['admin_fee_id']) : NULL;
    $fee_pct = 0;
    if ($admin_fee_id) {
        $fq = $conn->prepare("SELECT fee_percentage FROM admin_fees WHERE id = ?");
        $fq->bind_param("i", $admin_fee_id); $fq->execute();
        $fr = $fq->get_result()->fetch_assoc();
        if ($fr) $fee_pct = floatval($fr['fee_percentage']);
    }
    $maxR = $conn->query("SELECT MAX(id) as mx FROM sales")->fetch_assoc();
    $next = ($maxR['mx'] ? $maxR['mx'] : 0) + 1;
    $invoice_num = 'INV-' . date('ymd') . '-' . str_pad($next, 4, '0', STR_PAD_LEFT);
    $stmt = $conn->prepare("INSERT INTO sales (invoice_num, sale_date, platform, admin_fee_id, fee_percentage) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssid", $invoice_num, $sale_date, $platform, $admin_fee_id, $fee_pct);
    if ($stmt->execute()) {
        $sale_id = $conn->insert_id;
        $products = $_POST['product_id']; $units = $_POST['unit_id'];
        $qtys = $_POST['qty']; $multipliers = $_POST['multiplier']; $prices = $_POST['price_unit'];
        $grand = 0;
        for ($i = 0; $i < count($products); $i++) {
            $pid=$products[$i]; $uid=$units[$i]; $q=$qtys[$i]; $m=$multipliers[$i]; $p=$prices[$i];
            $sub = $q * $p; $bq = $q / $m; $grand += $sub;
            $ds = $conn->prepare("INSERT INTO sale_details (sale_id,product_id,unit_id,qty,base_qty,price_unit,subtotal) VALUES (?,?,?,?,?,?,?)");
            $ds->bind_param("iiidddd", $sale_id, $pid, $uid, $q, $bq, $p, $sub); $ds->execute();
            $conn->query("UPDATE products SET stock = stock - $bq WHERE id = $pid");
        }
        $fee_amt = $grand * ($fee_pct / 100); $net = $grand - $fee_amt;
        $conn->query("UPDATE sales SET total_amount=$grand, fee_amount=$fee_amt, net_amount=$net WHERE id=$sale_id");
        echo json_encode(['ok'=>true,'invoice'=>$invoice_num,'total'=>$grand,'fee'=>$fee_amt,'net'=>$net]);
        exit;
    }
    echo json_encode(['ok'=>false]); exit;
}

$products = $conn->query("SELECT p.id, p.code, p.name, p.stock,
                                  COALESCE(pup.price_sell, p.price_sell) as price_sell,
                                  u.name as base_unit, c.name as cat_name
                           FROM products p
                           LEFT JOIN units u ON p.base_unit_id = u.id
                           LEFT JOIN categories c ON p.category_id = c.id
                           LEFT JOIN product_unit_prices pup ON pup.product_id = p.id AND pup.unit_id = p.base_unit_id
                           ORDER BY p.name ASC");
$prod_list = [];
while ($p = $products->fetch_assoc()) { $prod_list[] = $p; }

$fees = $conn->query("SELECT f.*, c.name as cat_name FROM admin_fees f LEFT JOIN categories c ON f.category_id = c.id ORDER BY platform");
$fee_list = [];
while ($f = $fees->fetch_assoc()) { $fee_list[] = $f; }

$script = '
<script>
var products = '.json_encode($prod_list).';
var fees = '.json_encode($fee_list).';
var cart = [];

$(document).ready(function(){
    $("#searchProduct").on("change", function(){
        var pid = $(this).val();
        if(!pid) return;
        addProductToCart(parseInt(pid));
        $(this).val("");
    });
    $("#platformSelect").on("change", loadFeeForPlatform);
});

function findProduct(id){ return products.find(p => p.id == id); }

function addProductToCart(pid) {
    var existing = cart.find(c => c.pid == pid && c.unit_id == c.unit_id);
    if(existing) {
        var maxQty = existing.stock * existing.multiplier;
        if(existing.qty >= maxQty) { alert("Stok tidak cukup! Tersedia: "+existing.stock+" "+existing.base_unit); return; }
        existing.qty++; renderCart(); return;
    }
    var prod = findProduct(pid);
    if(!prod) return;
    $.getJSON("api_get_units.php?product_id="+pid, function(units){
        var baseUnit = units.find(u => u.multiplier == 1);
        var initMult = baseUnit ? 1 : units[0].multiplier;
        // Use unit-specific price if available, otherwise use base price / multiplier
        var initPrice = baseUnit && baseUnit.price_sell > 0 ? baseUnit.price_sell : (units[0].price_sell > 0 ? units[0].price_sell : parseFloat(prod.price_sell));
        cart.push({
            pid: pid, code: prod.code, name: prod.name,
            base_price: parseFloat(prod.price_sell) || 0,
            price: initPrice,
            qty: 1,
            unit_id: baseUnit ? baseUnit.unit_id : units[0].unit_id,
            unit_name: baseUnit ? baseUnit.unit_name : units[0].unit_name,
            multiplier: initMult,
            units: units, stock: parseFloat(prod.stock), base_unit: prod.base_unit
        });
        renderCart();
    });
}

function renderCart() {
    var html = "", total = 0;
    if(cart.length === 0) {
        html = \'<div class="text-center py-5 text-muted"><iconify-icon icon="solar:box-outline" style="font-size:64px;" class="d-block mx-auto mb-2 opacity-25"></iconify-icon><span class="d-block fs-6">Keranjang kosong</span><small class="d-block">Klik produk untuk menambahkan</small></div>\';
        $("#cart_body").html(html); grandTotal=0; calcSummary(); return;
    }
    cart.forEach(function(item, idx){
        var sub = item.qty * item.price; total += sub;
        var usel = \'<select class="form-select form-select-sm" style="font-size:11px;padding:4px 8px;height:30px;border-radius:4px;" onchange="changeUnit(\'+idx+\',this)">\';
        item.units.forEach(function(u){
            var priceDisplay = u.price_sell > 0 ? \' (@Rp \'+u.price_sell.toLocaleString("id-ID")+\') : \'\';
            usel += \'<option value="\'+u.unit_id+\'" data-mult="\'+u.multiplier+\'" data-name="\'+u.unit_name+\'" \'+(u.unit_id==item.unit_id?"selected":"")+\'>\'+u.unit_name+priceDisplay+\'</option>\';
        });
        usel += \'</select>\';

        html += \'<div style="border-bottom:1px solid #f1f5f9;padding:12px;">\';
        // Baris 1: Nama dan kode produk + tombol delete
        html += \'<div class="d-flex justify-content-between align-items-start mb-2">\';
        html += \'<div style="flex:1;min-width:0; padding-right:8px;">\';
        html += \'<div class="fw-semibold text-truncate" style="font-size:13px;color:#0f172a;margin-bottom:2px;">\'+item.name+\'</div>\';
        html += \'<div class="text-muted" style="font-size:11px;">\'+item.code+\'</div>\';
        html += \'</div>\';
        html += \'<a href="javascript:void(0)" class="text-danger" onclick="removeItem(\'+idx+\')" style="flex-shrink:0;"><iconify-icon icon="mingcute:delete-2-line" style="font-size:18px;"></iconify-icon></a>\';
        html += \'</div>\';

        // Baris 2: Unit, Qty, Harga
        html += \'<div class="d-flex align-items-center gap-2">\';
        html += \'<div style="flex:0 0 auto;">\'+usel+\'</div>\';
        html += \'<div class="d-flex align-items-center gap-1" style="flex-shrink:0;">\';
        html += \'<button type="button" class="btn btn-light border" style="width:30px;height:30px;padding:0;font-size:16px;line-height:1;border-radius:4px;" onclick="changeQty(\'+idx+\',-1)">−</button>\';
        html += \'<input type="number" class="form-control text-center" style="width:50px;height:30px;padding:0;font-size:12px;font-weight:600;border-radius:4px;" value="\'+item.qty+\'" onchange="setQty(\'+idx+\',this.value)" min="1">\';
        html += \'<button type="button" class="btn btn-light border" style="width:30px;height:30px;padding:0;font-size:16px;line-height:1;border-radius:4px;" onclick="changeQty(\'+idx+\',1)">+</button>\';
        html += \'</div>\';
        html += \'<div class="text-end" style="flex:1;"><div class="fw-bold" style="font-size:14px;color:#0f172a;">Rp \'+sub.toLocaleString("id-ID")+\'</div><div class="text-muted" style="font-size:10px;">@\'+item.price.toLocaleString("id-ID")+\'</div></div>\';
        html += \'</div>\';
        html += \'</div>\';
    });
    $("#cart_body").html(html); grandTotal = total; calcSummary();
    $("#cart_count").text(cart.length + " item");
}

function changeUnit(idx,sel){
    var o=sel.options[sel.selectedIndex];
    cart[idx].unit_id=parseInt(o.value);
    cart[idx].unit_name=o.dataset.name;
    var newMult=parseFloat(o.dataset.mult);
    cart[idx].multiplier=newMult;
    // Find the unit-specific price from the units array
    var unitData = cart[idx].units.find(u => u.unit_id == cart[idx].unit_id);
    if(unitData && unitData.price_sell > 0) {
        cart[idx].price = unitData.price_sell;
    } else {
        // Fallback to auto-calculate if no unit-specific price
        cart[idx].price = Math.round(cart[idx].base_price / newMult);
    }
    var maxQ=cart[idx].stock*newMult;
    if(cart[idx].qty>maxQ)cart[idx].qty=Math.max(1,Math.floor(maxQ));
    renderCart();
}
function changeQty(idx,d){var nq=cart[idx].qty+d;var maxQ=cart[idx].stock*cart[idx].multiplier;if(nq>maxQ){alert("Stok tidak cukup! Max: "+Math.floor(maxQ)+" "+cart[idx].unit_name);return;}cart[idx].qty=Math.max(1,nq);renderCart();}
function setQty(idx,v){var nq=parseFloat(v)||1;var maxQ=cart[idx].stock*cart[idx].multiplier;if(nq>maxQ){alert("Stok tidak cukup! Max: "+Math.floor(maxQ)+" "+cart[idx].unit_name);nq=Math.floor(maxQ);}cart[idx].qty=Math.max(1,nq);renderCart();}
function removeItem(idx){cart.splice(idx,1);renderCart();}

var grandTotal = 0;
function loadFeeForPlatform(){
    var plat=$("#platformSelect").val();var feeId="";var feePct=0;
    if(plat&&plat!=="Offline"){var match=fees.find(f=>f.platform.toLowerCase()===plat.toLowerCase());if(match){feeId=match.id;feePct=parseFloat(match.fee_percentage);}}
    $("#admin_fee_id").val(feeId);$("#fee_pct_val").val(feePct);calcSummary();
}
function calcSummary(){
    var pct=parseFloat($("#fee_pct_val").val())||0;var fee=grandTotal*(pct/100);var net=grandTotal-fee;
    $("#s_sub").text("Rp "+grandTotal.toLocaleString("id-ID"));
    if(pct>0){$("#s_fee_row").show();$("#s_fee_l").text("Fee Admin ("+pct+"%)");$("#s_fee_v").text("-Rp "+fee.toLocaleString("id-ID"));}else{$("#s_fee_row").hide();}
    $("#s_net").text("Rp "+(pct>0?net:grandTotal).toLocaleString("id-ID"));
}
function selectPlatform(el,val){$(".plat-chip").removeClass("plat-active");$(el).addClass("plat-active");$("#platformSelect").val(val).trigger("change");}

function submitSale(){
    if(!cart.length){alert("Keranjang kosong!");return;}
    var fd=new FormData();fd.append("action","save_sale");fd.append("platform",$("#platformSelect").val());fd.append("admin_fee_id",$("#admin_fee_id").val());
    cart.forEach(function(i){fd.append("product_id[]",i.pid);fd.append("unit_id[]",i.unit_id);fd.append("qty[]",i.qty);fd.append("multiplier[]",i.multiplier);fd.append("price_unit[]",i.price);});
    $.ajax({url:"penjualan_pos.php",type:"POST",data:fd,processData:false,contentType:false,success:function(resp){
        var r=JSON.parse(resp);if(r.ok){
            $("#rInv").text(r.invoice);$("#rTotal").text("Rp "+r.total.toLocaleString("id-ID"));
            $("#rFee").text("Rp "+r.fee.toLocaleString("id-ID"));$("#rNet").text("Rp "+r.net.toLocaleString("id-ID"));
            $("#successModal").modal("show");cart=[];renderCart();$("#platformSelect").val("Offline");loadFeeForPlatform();
            $(".plat-chip").removeClass("plat-active");$(".plat-chip").first().addClass("plat-active");
        }else{alert("Gagal!");}
    }});
}
</script>
<style>
.prod-card{border:1px solid #e2e8f0;border-radius:8px;cursor:pointer;transition:all .2s;overflow:hidden;background:#fff;height:100%;display:flex;flex-direction:column;}
.prod-card:hover{border-color:#6366f1;box-shadow:0 4px 12px rgba(99,102,241,.15);transform:translateY(-2px);}
.prod-card .pc-body{padding:12px;flex:1;display:flex;flex-direction:column;}
.prod-card .pc-name{font-size:12px;font-weight:600;color:#0f172a;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;min-height:34px;margin-bottom:4px;}
.prod-card .pc-code{font-size:10px;color:#64748b;margin-bottom:6px;}
.prod-card .pc-price{font-size:13px;font-weight:700;color:#6366f1;margin-top:auto;padding-top:4px;}
.prod-card .pc-stock{font-size:9px;margin-top:6px;}
.prod-card .pc-stock span{padding:3px 8px;border-radius:4px;font-weight:600;}
.plat-chip{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border:1px solid #e2e8f0;border-radius:20px;font-size:12px;font-weight:600;cursor:pointer;transition:all .2s;color:#64748b;background:#fff;}
.plat-chip:hover{border-color:#94a3b8;background:#f8fafc;}
.plat-chip.plat-active{border-color:#6366f1;background:#eff6ff;color:#6366f1;}
.pos-summary{background:linear-gradient(135deg,#1e293b 0%,#334155 100%);border-radius:10px;padding:16px;color:#fff;}
.pos-summary hr{border-color:rgba(255,255,255,.1);margin:10px 0;}
.cart-scroll{overflow-y:auto;max-height:450px;}
</style>
';
?>

<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Point of Sale / Kasir</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium"><a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary"><iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon> Dashboard</a></li>
            <li>-</li>
            <li class="fw-medium">POS</li>
        </ul>
    </div>

    <div class="row g-3">
        <!-- KIRI: Search + Product Grid -->
        <div class="col-lg-7">
            <div class="card mb-3">
                <div class="card-body">
                    <label class="form-label">Cari Produk</label>
                    <select id="searchProduct" class="form-select">
                        <option value="">-- Ketik nama produk atau scan barcode --</option>
                        <?php foreach($prod_list as $p): ?>
                        <option value="<?= $p['id'] ?>">[<?= htmlspecialchars($p['code']) ?>] <?= htmlspecialchars($p['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Daftar Produk</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <?php foreach($prod_list as $p):
                            $stk = floatval($p['stock']);
                            if($stk > 10) {
                                $stockBadge = 'bg-success';
                                $stockText = $stk == intval($stk) ? intval($stk) : number_format($stk,2,',','.');
                            } elseif($stk > 0) {
                                $stockBadge = 'bg-warning';
                                $stockText = $stk == intval($stk) ? intval($stk) : number_format($stk,2,',','.');
                            } else {
                                $stockBadge = 'bg-danger';
                                $stockText = 'HABIS';
                            }
                        ?>
                        <div class="col-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3">
                            <div class="prod-card<?= $stk <= 0 ? ' opacity-50' : '' ?>" <?= $stk > 0 ? 'onclick="addProductToCart('.$p['id'].')"' : '' ?>>
                                <div class="pc-body">
                                    <div class="pc-name"><?= htmlspecialchars($p['name']) ?></div>
                                    <div class="pc-code"><?= htmlspecialchars($p['code']) ?></div>
                                    <div class="pc-price">Rp <?= number_format($p['price_sell'],0,',','.') ?></div>
                                    <div class="pc-stock">
                                        <span class="badge <?= $stockBadge ?> text-white">
                                            <?= $stockText ?> <?= htmlspecialchars($p['base_unit'] ?? '') ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- KANAN: Cart Panel -->
        <div class="col-lg-5">
            <div class="card" style="position:sticky;top:24px;">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">🧾 Keranjang</h6>
                            <small class="text-muted" id="cart_count">0 item</small>
                        </div>
                        <span class="text-muted"><?= date('d M Y') ?></span>
                    </div>
                </div>

                <div class="card-body p-0">
                    <!-- Platform Chips -->
                    <div class="px-3 py-2 border-bottom d-flex flex-wrap gap-2" style="background:#f8fafc;">
                        <span class="plat-chip plat-active" onclick="selectPlatform(this,'Offline')"><iconify-icon icon="solar:shop-2-bold"></iconify-icon> Offline</span>
                        <span class="plat-chip" onclick="selectPlatform(this,'Shopee')"><iconify-icon icon="simple-icons:shopee" style="color:#ee4d2d;"></iconify-icon> Shopee</span>
                        <span class="plat-chip" onclick="selectPlatform(this,'Tokopedia')"><iconify-icon icon="simple-icons:tokopedia" style="color:#42b549;"></iconify-icon> Tokopedia</span>
                        <span class="plat-chip" onclick="selectPlatform(this,'Grab')"><iconify-icon icon="simple-icons:grab" style="color:#00b14f;"></iconify-icon> Grab</span>
                        <span class="plat-chip" onclick="selectPlatform(this,'Lainnya')"><iconify-icon icon="solar:menu-dots-bold"></iconify-icon> Lain</span>
                    </div>
                    <input type="hidden" id="platformSelect" value="Offline">
                    <input type="hidden" id="admin_fee_id" value="">
                    <input type="hidden" id="fee_pct_val" value="0">

                    <!-- Cart Items -->
                    <div class="cart-scroll" id="cart_body" style="background:#fff;">
                        <div class="text-center py-5 text-muted">
                            <!-- <iconify-icon icon="solar:box-outline" style="font-size:64px;" class="d-block mx-auto mb-2 opacity-25"></iconify-icon> -->
                            <span class="d-block fs-6">Keranjang kosong</span>
                            <small class="d-block">Klik produk untuk menambahkan</small>
                        </div>
                    </div>
                </div>

                <!-- Summary + Pay -->
                <div class="card-footer">
                    <div class="pos-summary mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span style="opacity:.8;">Subtotal</span>
                            <span id="s_sub">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" id="s_fee_row" style="display:none;">
                            <span style="opacity:.8;" id="s_fee_l">Fee Admin</span>
                            <span style="color:#fbbf24;" id="s_fee_v">-Rp 0</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">TOTAL</span>
                            <span class="fw-bold" style="font-size:24px;" id="s_net">Rp 0</span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success w-100 py-2 fw-bold" onclick="submitSale()">
                        <iconify-icon icon="solar:check-circle-bold" class="me-1"></iconify-icon> Bayar & Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center p-4">
        <div style="width:64px;height:64px;border-radius:50%;background:#dcfce7;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
            <iconify-icon icon="solar:check-circle-bold" style="font-size:36px;color:#16a34a;"></iconify-icon>
        </div>
        <h6 class="fw-bold mb-1">Transaksi Berhasil!</h6>
        <p class="text-muted mb-3">Invoice: <strong id="rInv"></strong></p>
        <div class="bg-light rounded p-3 mb-3 text-start" style="font-size:12px;">
            <div class="d-flex justify-content-between mb-1"><span class="text-muted">Total</span><strong id="rTotal"></strong></div>
            <div class="d-flex justify-content-between mb-1"><span class="text-muted">Fee Admin</span><strong id="rFee"></strong></div>
            <hr class="my-2">
            <div class="d-flex justify-content-between"><span class="fw-bold">Nett Diterima</span><strong class="text-success" id="rNet"></strong></div>
        </div>
        <button class="btn btn-primary w-100" data-bs-dismiss="modal">Transaksi Baru</button>
      </div>
    </div>
  </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
