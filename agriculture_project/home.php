<?php
session_start(); // Start the session for user management
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - AgriConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand" href="#">AgriConnect</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <!-- Search Bar -->
        <form class="d-flex mx-auto" role="search" style="max-width: 300px; width: 100%;">
          <input class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search">
          <button class="btn btn-light" type="submit">Search</button>
        </form>

        <!-- Dynamic Links Based on Login Status -->
        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="profile.php">Welcome, <?= htmlspecialchars($_SESSION['user_name']); ?></a></li>
          <li class="nav-item"><a class="nav-link btn btn-light text-success" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
          <li class="nav-item"><a class="nav-link btn btn-light text-success" href="login.html">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.html">Join Us</a></li>
        <?php endif; ?>
        
        <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero-section text-center text-light d-flex align-items-center" style="background: url(home.jpg) no-repeat center center/cover; height: 600px;">
  <div class="container">
    <h1 class="display-4 fw-bold">Welcome to AgriConnect</h1>
    <p class="lead">Bridging the gap between farmers, vendors, and consumers</p>

    <!-- Dynamic Call to Action -->
    <?php if (isset($_SESSION['user_id'])): ?>
      <?php if ($_SESSION['user_type'] === 'buyer'): ?>
        <a href="products.php" class="btn btn-light btn-lg mt-3">Browse Products</a>
      <?php elseif ($_SESSION['user_type'] === 'seller'): ?>
        <a href="manage_products.php" class="btn btn-light btn-lg mt-3">Manage Your Products</a>
      <?php elseif ($_SESSION['user_type'] === 'admin'): ?>
        <a href="admin_dashboard.php" class="btn btn-light btn-lg mt-3">Go to Dashboard</a>
      <?php endif; ?>
    <?php else: ?>
      <a href="product.html" class="btn btn-light btn-lg mt-3">Explore Products</a>
      <a href="register.html" class="btn btn-outline-light btn-lg mt-3">Join Us</a>
    <?php endif; ?>
  </div>
</section>

<!-- Featured Sections -->
<div class="container my-5">
  <div class="row text-center">
    <h2 class="mb-4">What We Offer</h2>
    <div class="col-md-4">
      <div class="card p-3 shadow-sm">
        <img src="homeProduct.png" class="card-img-top" alt="Products">
        <div class="card-body">
          <h5 class="card-title">Wide Range of Products</h5>
          <p class="card-text">Browse and order fresh agricultural products directly from farmers.</p>
          <a href="product.html" class="btn btn-success">View Products</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 shadow-sm">
        <img src="homeSupplier.png" class="card-img-top" alt="Suppliers">
        <div class="card-body">
          <h5 class="card-title">Trusted Suppliers</h5>
          <p class="card-text">Connect with reliable suppliers for your agricultural needs.</p>
          <a href="#suppliers" class="btn btn-success">View Suppliers</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 shadow-sm">
        <img src="homeWirehouse.png" class="card-img-top" alt="Warehouses">
        <div class="card-body">
          <h5 class="card-title">Efficient Storage</h5>
          <p class="card-text">Access warehouses to store and manage your agricultural products.</p>
          <a href="#warehouses" class="btn btn-success">Learn More</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-light py-3 text-center">
  <p>&copy; 2024 AgriConnect | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
