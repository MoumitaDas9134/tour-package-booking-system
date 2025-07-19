<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "uploads/" . basename($image_name);

    if (!file_exists('uploads')) {
        mkdir('uploads');
    }

    move_uploaded_file($image_tmp, $image_path);

    $sql = "INSERT INTO packages (title, location, price, description, status, image)
            VALUES ('$title', '$location', '$price', '$description', '$status', '$image_path')";

    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Package Saved</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #5cb8d2ff, #58a6c0ff);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .message-box {
      background: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
      text-align: center;
      animation: zoomIn 0.5s ease;
    }

    h2 {
      color: #27ae60;
      margin-bottom: 20px;
    }

    a.button {
      display: inline-block;
      padding: 12px 20px;
      margin: 10px;
      background: #3498db;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      transition: 0.3s ease;
    }

    a.button:hover {
      background: #2980b9;
    }

    .button-secondary {
      background: #2ecc71;
    }

    .button-secondary:hover {
      background: #27ae60;
    }

    @keyframes zoomIn {
      from { transform: scale(0.8); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }
  </style>
</head>
<body>

<div class="message-box">
  <h2>✅ Package Added Successfully!</h2>
  <a class="button" href="admin_add_package.php">➕ Add Another</a>
  <a class="button button-secondary" href="admin_manage_packages.php">📦 Manage Packages</a>
</div>

</body>
</html>
