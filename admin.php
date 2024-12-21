<?php
$servername = "localhost";
$username = "root";
$password = "your_password"; // Replace with your MySQL password
$dbname = "agriculture_db";

// Create connection
$conn = new mysqli('localhost', 'root', '', 'agriculture_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM agriculture_data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Agriculture Demand & Supply</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        nav {
            background-color: #343a40;
            padding: 10px;
            display: flex;
            justify-content: space-between;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        .btn {
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #218838;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Panel - Agriculture Demand & Supply</h1>
    </header>
    <nav>
        <a href="#">Dashboard</a>
        <a href="#">Demand Data</a>
        <a href="#">Supply Data</a>
        <a href="#">Reports</a>
        <a href="#">Settings</a>
    </nav>
    <div class="container">
        <h2>Manage Agriculture Data</h2>
        <button class="btn">Add New Entry</button>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item</th>
                    <th>Demand</th>
                    <th>Supply</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['item']}</td>
                                <td>{$row['demand']}</td>
                                <td>{$row['supply']}</td>
                                <td>
                                    <button class='btn'>Edit</button>
                                    <button class='btn btn-delete'>Delete</button>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        &copy; 2024 Agriculture Demand & Supply Management
    </footer>
</body>
</html>

<?php
$conn->close();
?>

