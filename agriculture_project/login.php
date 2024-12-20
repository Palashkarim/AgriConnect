<?php
session_start(); // Start session for user authentication

// Database connection settings
$host = 'localhost';
$dbname = 'agriculture_db'; // Your database name
$db_user = 'root';          // Your database username
$db_pass = '';              // Your database password

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed. Please try again later.");
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Check if the user exists in the database
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct; set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_type'] = $user['user_type'];

        // Redirect based on user type
        switch ($user['user_type']) {
            case 'admin':
                header("Location: admin_dashboard.php");
                break;
            case 'seller':
                header("Location: seller_dashboard.php");
                break;
            case 'buyer':
                header("Location: buyer_dashboard.php");
                break;
            default:
                echo "Unauthorized user type.";
                exit;
        }
        exit;
    } else {
        // Invalid credentials
        echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }
}
?>

