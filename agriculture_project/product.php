<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$host = 'localhost';       // Replace with your database host
$dbname = 'agriculture_db';
$username = 'root';        // Replace with your database username
$password = '';            // Replace with your database password

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch products from the database
    $stmt = $pdo->query("SELECT * FROM product_t");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle connection errors
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="home.html">AgriConnect</a>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="text-center mb-4">Available Products</h1>
        <div class="row g-4">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $product) : ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="<?= htmlspecialchars($product['cname']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($product['cname']) ?></h5>
                                <p class="card-text">Category: <?= htmlspecialchars($product['ccatagory']) ?></p>
                                <p class="card-text">Price: $<?= htmlspecialchars($product['nprice']) ?></p>
                                <button class="btn btn-success">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">No products available.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer class="bg-dark text-light py-3 text-center">
        <p>&copy; 2024 AgriConnect | All Rights Reserved</p>
    </footer>
</body>
</html>

