<?php
include 'db_connection.php';

$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product) {
    echo "<p>{$product['name']} - {$product['price']} - {$product['stock']} - {$product['description']}</p>";
}
?>
