<?php
include 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM clients WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        header("Location: packages.php");
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title> Login</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #74ebd5, #ACB6E5);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background-color: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      width: 350px;
      text-align: center;
    }

    h2 {
      color: #333;
      margin-bottom: 25px;
    }

    input {
      width: 90%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
    }

    button {
      width: 95%;
      padding: 12px;
      background: #2980b9;
      color: white;
      border: none;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease-in-out;
    }

    button:hover {
      background: #1c5d8b;
    }

    .error {
      color: red;
      margin-top: 10px;
    }

    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      background: #34495e;
      padding: 10px;
      text-align: center;
    }

    .navbar a {
      margin: 0 10px;
      color: white;
      text-decoration: none;
      font-weight: bold;
    }

    .navbar a:hover {
      text-decoration: underline;
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
  <form method="POST" onsubmit="return validateForm()">
    <h2>Client Login</h2>
    <input type="email" id="email" name="email" placeholder="Email" required><br>
    <input type="password" id="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>

    <?php if ($error): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
  </form>
</div>

<script>
  function validateForm() {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    if (!email || !password) {
      alert("Please fill all fields!");
      return false;
    }

    if (!email.includes("@")) {
      alert("Enter a valid email address.");
      return false;
    }

    return true;
  }
</script>

</body>
</html>
