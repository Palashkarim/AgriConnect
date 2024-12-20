<?php
// Database connection settings
$host = 'localhost';
$dbname = 'agriculture_db';
$username = 'root';
$password = '';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $location = trim($_POST['location']);
    $phone = trim($_POST['phone']);
    $user_type = trim($_POST['user_type']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Validate user type
    $valid_user_types = ['buyer', 'seller'];
    if (!in_array($user_type, $valid_user_types)) {
        die("Error: Invalid user type selected.");
    }

    // Prepare and execute the SQL query
    $sql = "INSERT INTO users (name, email, location, phone, user_type, password) 
            VALUES (:name, :email, :location, :phone, :user_type, :password)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':location' => $location,
            ':phone' => $phone,
            ':user_type' => $user_type,
            ':password' => $password,
        ]);
        echo "Registration successful!";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Handle duplicate email error
            echo "Error: Email already exists!";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
