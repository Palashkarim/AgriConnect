<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'seller') {
    header("Location: login.html");
    exit;
}

// Database connection settings
$host = 'localhost'; // Change to your host if different
$dbname = 'agriculture_db'; // Your database name
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password (empty for XAMPP's default)

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $cname = $_POST['cname'];
        $ccategory = $_POST['ccategory'];
        $nprice = $_POST['nprice'];

        // Validate data (basic example)
        if (!empty($cname) && !empty($ccategory) && is_numeric($nprice)) {
            // Insert data into the product table
            $sql = "INSERT INTO product_t (cname, ccategory, nprice) VALUES (:cname, :ccategory, :nprice)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':cname' => $cname,
                ':ccategory' => $ccategory,
                ':nprice' => $nprice,
            ]);
            $successMessage = "Product saved successfully!";
        } else {
            $errorMessage = "Please fill all fields correctly.";
        }
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Retail Shop Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="retailShop.css">
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
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="#">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Products</a></li> 
          <div class="d-flex align-items-center ms-auto">
    <!-- Welcome Text -->
    <span class="text-light me-3">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
    
    <!-- Logout Button -->
    <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
</div>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Dashboard Section -->
  <section class="dashboard-section py-5">
    <div class="container">
      <h2 class="text-center mb-4">Retail Shop Dashboard</h2>

      <!-- Display success or error message -->
      <?php if (isset($successMessage)) { ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
      <?php } elseif (isset($errorMessage)) { ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
      <?php } ?>

      <form id="productForm" method="POST">
        <div class="row g-3">
          <!-- Product Name -->
          <div class="col-md-6">
            <label for="cname" class="form-label">Product Name</label>
            <input type="text" name="cname" class="form-control" placeholder="Enter Product Name" required>
          </div>
          <!-- Category -->
          <div class="col-md-6">
            <label for="ccategory" class="form-label">Category</label>
            <input type="text" name="ccategory" class="form-control" placeholder="Enter Category" required>
          </div>
          <!-- Price -->
          <div class="col-md-6">
            <label for="nprice" class="form-label">Price</label>
            <input type="number" step="0.01" name="nprice" class="form-control" placeholder="Enter Price" required>
          </div>
        </div>

        <!-- Save Button -->
        <div class="text-center mt-4">
          <button type="submit" class="btn btn-success btn-lg">Save</button>
        </div>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-light py-3 text-center">
    <p>&copy; 2024 AgriConnect | All Rights Reserved</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
