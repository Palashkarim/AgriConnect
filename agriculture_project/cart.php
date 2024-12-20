<?php
session_start();
require 'db_connection.php'; // Database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.html");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch cart items for the logged-in user
$stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = :user_id");
$stmt->execute([':user_id' => $user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart - AgriConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
      <a class="navbar-brand" href="home.html">AgriConnect</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="cart.php">Cart</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Cart Section -->
  <div class="container my-5">
    <h2 class="text-center">Your Cart</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0; ?>
        <?php if (count($cart_items) > 0): ?>
          <?php foreach ($cart_items as $index => $item): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($item['product_name']) ?></td>
            <td>$<?= number_format($item['price'], 2) ?></td>
            <td><?= $item['quantity'] ?></td>
            <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
            <td>
              <form action="remove_from_cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                <button type="submit" class="btn btn-danger">Remove</button>
              </form>
            </td>
          </tr>
          <?php $total += $item['price'] * $item['quantity']; ?>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="text-center">Your cart is empty.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <h3>Total: $<?= number_format($total, 2) ?></h3>
    <?php if ($total > 0): ?>
      <button class="btn btn-success">Proceed to Checkout</button>
    <?php endif; ?>
  </div>

  <footer class="bg-dark text-light py-3 text-center">
    <p>&copy; 2024 AgriConnect | All Rights Reserved</p>
  </footer>
</body>
</html>
