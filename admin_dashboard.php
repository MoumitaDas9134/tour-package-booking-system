<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(120deg, #89f7fe, #66a6ff);
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .container {
      background: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
      width: 350px;
      text-align: center;
      animation: fadeIn 1s ease-in-out;
    }

    h2 {
      color: #2c3e50;
      margin-bottom: 30px;
    }

    a {
      display: block;
      text-decoration: none;
      background-color: #3498db;
      color: white;
      padding: 12px;
      border-radius: 8px;
      margin: 10px 0;
      font-size: 16px;
      transition: background-color 0.3s ease, transform 0.2s;
    }

    a:hover {
      background-color: #2980b9;
      transform: scale(1.03);
    }

    .logout {
      background-color: #e74c3c;
    }

    .logout:hover {
      background-color: #c0392b;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<div class="container">
    <h2>Welcome, Admin 👋</h2>
    
    <a href="admin_add_package.php">➕ Add Package</a>
    <a href="admin_manage_packages.php">🛠 Manage Packages</a>
    <a href="admin_view_bookings.php">📅 Booking Details</a>
    <a class="logout" href="admin_logout.php">🚪 Logout</a>
</div>

</body>
</html>
