<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.html");
    exit;
}
echo "Welcome, Admin " . $_SESSION['user_name'];
?>
