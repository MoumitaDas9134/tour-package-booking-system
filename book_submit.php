<?php
include 'db.php';

$message = '';
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $package_id = intval($_POST['package_id']);
    $booking_date = $_POST['booking_date'];

    $sql = "INSERT INTO bookings (name, email, package_id, booking_date)
            VALUES ('$name', '$email', '$package_id', '$booking_date')";

    if (mysqli_query($conn, $sql)) {
        $message = "🎉 Booking confirmed successfully!";
        $success = true;
    } else {
        $message = "⚠️ Error: " . mysqli_error($conn);
    }
} else {
    $message = "Invalid request!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Booking Confirmation</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #43cea2, #185a9d);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      color: white;
    }
    .confirmation-box {
      background: rgba(0, 0, 0, 0.7);
      padding: 40px 50px;
      border-radius: 20px;
      text-align: center;
      max-width: 400px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.4);
      animation: fadeIn 0.6s ease forwards;
    }
    h1 {
      margin-bottom: 20px;
      font-size: 2rem;
      color: <?= $success ? '#2ecc71' : '#e74c3c' ?>;
    }
    p {
      font-size: 1.2rem;
      margin-bottom: 30px;
    }
    a {
      display: inline-block;
      background: #3498db;
      color: white;
      padding: 12px 25px;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }
    a:hover {
      background: #2980b9;
    }
    .countdown {
      margin-top: 15px;
      font-size: 1rem;
      color: #ccc;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(-20px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
  <?php if ($success): ?>
  <script>
    let seconds = 5;
    function countdown() {
      if (seconds <= 0) {
        window.location.href = 'packages.php';
      } else {
        document.getElementById('countdown').innerText = seconds + " seconds";
        seconds--;
        setTimeout(countdown, 1000);
      }
    }
    window.onload = countdown;
  </script>
  <?php endif; ?>
</head>
<body>

  <div class="confirmation-box">
    <h1><?= $success ? "Success!" : "Oops!" ?></h1>
    <p><?= $message ?></p>
    <?php if ($success): ?>
      <p class="countdown">Redirecting in <span id="countdown">5 seconds</span>...</p>
      <a href="packages.php">Go to Packages Now</a>
    <?php else: ?>
      <a href="javascript:history.back()">Try Again</a>
    <?php endif; ?>
  </div>

</body>
</html>
