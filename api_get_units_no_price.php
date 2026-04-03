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
    // Get all available units from conversions
    $query = "SELECT DISTINCT u.id, u.name
              FROM units u
              INNER JOIN product_conversions pc ON u.id = pc.unit_id
              WHERE pc.product_id = ?
              AND u.id NOT IN (
                  SELECT unit_id FROM product_unit_prices WHERE product_id = ?
              )
              ORDER BY u.name ASC";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $product_id, $product_id);
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
