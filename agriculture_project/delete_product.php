<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'buyer') {
    header("Location: loginpage.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];

    // Database connection
    $host = 'localhost';
    $dbname = 'agriculture_db';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Delete query
        $sql = "DELETE FROM products WHERE id = :product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':product_id' => $product_id]);

        echo "Product deleted successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
