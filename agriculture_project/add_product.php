<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'buyer') {
    header("Location: loginpage.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    // Database connection
    $host = 'localhost';
    $dbname = 'agriculture_db';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert query
        $sql = "INSERT INTO products (name, price, stock, description, added_by) VALUES (:name, :price, :stock, :description, :added_by)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':price' => $price,
            ':stock' => $stock,
            ':description' => $description,
            ':added_by' => $_SESSION['user_id']
        ]);

        echo "Product added successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
