<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'buyer') {
    header("Location: loginpage.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>My Orders</h1>
        <p>Track your orders here.</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Add PHP logic to fetch and display orders -->
                <tr>
                    <td>12345</td>
                    <td>Product Name</td>
                    <td>2</td>
                    <td>$20</td>
                    <td>Delivered</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
