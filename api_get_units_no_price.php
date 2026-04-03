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
    // Get units that don't have a price for this product yet
    // Include BOTH base unit AND conversion units
    $query = "SELECT u.id, u.name
              FROM units u
              WHERE u.id IN (
                  -- Base unit
                  SELECT p.base_unit_id FROM products p WHERE p.id = ?
                  UNION
                  -- Conversion units
                  SELECT pc.unit_id FROM product_conversions pc WHERE pc.product_id = ?
              )
              AND u.id NOT IN (
                  SELECT unit_id FROM product_unit_prices WHERE product_id = ?
              )
              ORDER BY u.name ASC";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $product_id, $product_id, $product_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $units = [];

    while ($row = $result->fetch_assoc()) {
        $units[] = [
            'id' => $row['id'],
            'name' => $row['name']
        ];
    }

    echo json_encode(['success' => true, 'units' => $units]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
}
exit;
?>
