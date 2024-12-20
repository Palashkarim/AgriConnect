<?php
session_start();
require 'db_connection.php'; // Database connection file

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.html");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get product details from the form
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$price = $_POST['price'];

// Check if the product is already in the cart
$stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id");
$stmt->execute([':user_id' => $user_id, ':product_id' => $product_id]);
$existing_product = $stmt->fetch();

if ($existing_product) {
    // Update quantity if the product already exists in the cart
    $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE user_id = :user_id AND product_id = :product_id");
    $stmt->execute([':user_id' => $user_id, ':product_id' => $product_id]);
} else {
    // Add new product to the cart
    $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, product_name, price, quantity) VALUES (:user_id, :product_id, :product_name, :price, 1)");
    $stmt->execute([
        ':user_id' => $user_id,
        ':product_id' => $product_id,
        ':product_name' => $product_name,
        ':price' => $price
    ]);
}

header("Location: cart.php");
exit;
?>
