<?php
$conn = new mysqli("localhost", "root", "", "your_database");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch demand data
$query = "SELECT product_name, demand_quantity FROM product_demand";
$result = $conn->query($query);

// Prepare data
$data = [];
$total = 0;
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    $total += $row['demand_quantity'];
}

// Generate Pie Chart HTML
echo '<svg width="300" height="300" viewBox="0 0 42 42" class="donut">';
$offset = 25;
foreach ($data as $item) {
    $value = $item['demand_quantity'];
    $percentage = ($value / $total) * 100;
    echo "<circle class='donut-segment' cx='21' cy='21' r='15.9155' fill='transparent' stroke-width='3' stroke-dasharray='$percentage $offset'></circle>";
    $offset -= $percentage;
}
echo '</svg>';
?>
