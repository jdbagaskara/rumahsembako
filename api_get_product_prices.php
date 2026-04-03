<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Content-Type: application/json");
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}
include 'koneksi.php';

header("Content-Type: application/json");

$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

if ($product_id > 0) {
    // Ambil data harga jual per satuan
    $query = "SELECT
                pup.unit_id,
                u.name as unit_name,
                pup.price_sell
            FROM product_unit_prices pup
            LEFT JOIN units u ON pup.unit_id = u.id
            WHERE pup.product_id = ?
            ORDER BY u.name ASC";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $prices = [];

    while ($row = $result->fetch_assoc()) {
        $prices[] = [
            'unit_id' => $row['unit_id'],
            'unit_name' => $row['unit_name'],
            'price_sell' => floatval($row['price_sell'])
        ];
    }

    echo json_encode(['success' => true, 'prices' => $prices]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
}
exit;
?>
