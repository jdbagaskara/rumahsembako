<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Content-Type: application/json");
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}
include 'koneksi.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'save_price') {
        $product_id = intval($_POST['product_id']);
        $unit_id = intval($_POST['unit_id']);
        $price_sell = floatval($_POST['price_sell']);

        // Cek apakah sudah ada
        $check = $conn->prepare("SELECT id FROM product_unit_prices WHERE product_id = ? AND unit_id = ?");
        $check->bind_param("ii", $product_id, $unit_id);
        $check->execute();
        $exists = $check->get_result()->num_rows > 0;

        if ($exists) {
            // Update
            $stmt = $conn->prepare("UPDATE product_unit_prices SET price_sell = ?, updated_at = NOW() WHERE product_id = ? AND unit_id = ?");
            $stmt->bind_param("dii", $price_sell, $product_id, $unit_id);
        } else {
            // Insert
            $stmt = $conn->prepare("INSERT INTO product_unit_prices (product_id, unit_id, price_sell) VALUES (?, ?, ?)");
            $stmt->bind_param("iid", $product_id, $unit_id, $price_sell);
        }

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Harga berhasil disimpan']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan harga']);
        }
    } elseif ($_POST['action'] == 'delete_price') {
        $product_id = intval($_POST['product_id']);
        $unit_id = intval($_POST['unit_id']);

        $stmt = $conn->prepare("DELETE FROM product_unit_prices WHERE product_id = ? AND unit_id = ?");
        $stmt->bind_param("ii", $product_id, $unit_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Harga berhasil dihapus']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus harga']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
exit;
?>
