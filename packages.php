<?php
include 'db.php';

$sql = "SELECT * FROM packages WHERE status = 'available'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tour Booking</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f2f6fa;
    }

    .navbar {
      background-color: #34495e;
      padding: 15px;
      text-align: center;
    }

    .navbar a {
      color: white;
      margin: 0 15px;
      text-decoration: none;
      font-weight: bold;
      font-size: 16px;
    }

    .navbar a:hover {
      text-decoration: underline;
    }

    .container {
      max-width: 1100px;
      margin: 40px auto;
      padding: 20px;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #2c3e50;
    }

    .card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      overflow: hidden;
      margin: 20px;
      width: 300px;
      display: inline-block;
      vertical-align: top;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .card-body {
      padding: 15px;
    }

    .card h3 {
      color: #2980b9;
      margin-bottom: 10px;
    }

    .card p {
      color: #333;
      font-size: 14px;
      margin: 5px 0;
    }

    .card button {
      margin-top: 10px;
      padding: 10px 18px;
      background-color: #27ae60;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .card button:hover {
      background-color: #219150;
    }

    @media (max-width: 768px) {
      .card {
        width: 90%;
        margin: 20px auto;
      }
    }
  </style>
</head>
<body>

<div class="navbar">
  <a href="packages.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
</div>

<div class="container">
  <h2>Available Tour Packages</h2>

  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="card">
      <img src="<?= $row['image'] ?>" alt="Tour Image">
      <div class="card-body">
        <h3><?= $row['title'] ?></h3>
        <p><strong>Location:</strong> <?= $row['location'] ?></p>
        <p><strong>Price:</strong> ₹<?= $row['price'] ?></p>
        <p><?= $row['description'] ?></p>
        <a href="book.php?package_id=<?= $row['id'] ?>">
          <button onclick="bookAlert()">Book Now</button>
        </a>
      </div>
    </div>
  <?php } ?>
</div>

<script>
function bookAlert() {
  alert("You are about to book a tour. Please ensure you are logged in.");
}
</script>

</body>
</html>
