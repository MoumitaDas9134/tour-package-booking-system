<?php
session_start();

// Connect to database
$conn = new mysqli("localhost", "root", "", "tour_booking");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Match with admin table
$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  $_SESSION['admin'] = $username;
  header("Location: admin_dashboard.php");
  exit();
} else {
  header("Location: admin_login.php?error=Invalid username or password");
  exit();
}
?>
