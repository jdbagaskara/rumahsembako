<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    exit;
}
include 'koneksi.php';

$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
if ($product_id == 0) exit;

$units = [];

// Get the base unit first (multiplier = 1)
$query = "SELECT p.base_unit_id, u.name 
          FROM products p 
          JOIN units u ON p.base_unit_id = u.id 
          WHERE p.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$res = $stmt->get_result();
if ($row = $res->fetch_assoc()) {
    $units[] = [
        'unit_id' => $row['base_unit_id'],
        'unit_name' => $row['name'],
        'multiplier' => 1
    ];
}

// Get the conversion units
$query2 = "SELECT pc.unit_id, u.name, pc.multiplier 
           FROM product_conversions pc 
           JOIN units u ON pc.unit_id = u.id 
           WHERE pc.product_id = ?";
$stmt2 = $conn->prepare($query2);
$stmt2->bind_param("i", $product_id);
$stmt2->execute();
$res2 = $stmt2->get_result();
while($row2 = $res2->fetch_assoc()) {
    $units[] = [
        'unit_id' => $row2['unit_id'],
        'unit_name' => $row2['name'],
        'multiplier' => floatval($row2['multiplier'])
    ];
}

header('Content-Type: application/json');
echo json_encode($units);
?>
