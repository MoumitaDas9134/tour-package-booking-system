<?php
include 'db.php';

if (isset($_GET['package_id'])) {
    $package_id = intval($_GET['package_id']);
    $sql = "SELECT * FROM packages WHERE id = $package_id";
    $result = mysqli_query($conn, $sql);
    $package = mysqli_fetch_assoc($result);
} else {
    echo "No package selected.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Book Package: <?= htmlspecialchars($package['title']); ?></title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #74ebd5, #ACB6E5);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .booking-container {
      background: white;
      padding: 35px 40px;
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
      width: 400px;
      animation: fadeIn 0.6s ease forwards;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #34495e;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"] {
      width: 100%;
      padding: 12px 15px;
      margin: 12px 0 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      outline: none;
      transition: 0.3s;
    }

    input:focus {
      border-color: #2980b9;
      box-shadow: 0 0 7px rgba(41, 128, 185, 0.5);
    }

    button {
      width: 100%;
      padding: 14px;
      background-color: #27ae60;
      border: none;
      border-radius: 10px;
      color: white;
      font-size: 18px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #219150;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-15px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>

  <div class="booking-container">
    <h2>Book Package: <?= htmlspecialchars($package['title']); ?></h2>
    <form id="bookingForm" action="book_submit.php" method="POST" onsubmit="return validateBooking()">
      <input type="hidden" name="package_id" value="<?= htmlspecialchars($package['id']); ?>">

      <input type="text" name="name" id="name" placeholder="Your Name" required>
      <input type="email" name="email" id="email" placeholder="Your Email" required>
      <input type="date" name="booking_date" id="booking_date" required min="<?= date('Y-m-d'); ?>">

      <button type="submit">Confirm Booking</button>
    </form>
  </div>

  <script>
    function validateBooking() {
      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const bookingDate = document.getElementById('booking_date').value;

      // Basic name validation
      if (name.length < 3) {
        alert("Please enter a valid name (at least 3 characters).");
        return false;
      }

      // Email regex validation
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
      }

      // Booking date validation (not in the past)
      const today = new Date();
      const selectedDate = new Date(bookingDate);
      today.setHours(0,0,0,0);

      if (selectedDate < today) {
        alert("Booking date cannot be in the past.");
        return false;
      }

      return true; // allow form submission
    }
  </script>

</body>
</html>
