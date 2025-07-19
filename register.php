<?php
include 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM clients WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "⚠️ Email already registered!";
    } else {
        $sql = "INSERT INTO clients (name, email, password) VALUES ('$name', '$email', '$password')";
        mysqli_query($conn, $sql);
        header("Location: packages.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tour Booking - Register</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #74ebd5,#ACB6E5);
      height: 100vh;
      display: flex;
      flex-direction: column;
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
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    form {
      background-color: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
      width: 350px;
      text-align: center;
    }

    h2 {
      color: #2980b9;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
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
      background-color: #27ae60;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #219150;
    }

    .error {
      color: red;
      margin-top: 10px;
    }

    @media (max-width: 768px) {
      form {
        width: 90%;
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
    <form method="POST" onsubmit="return validateForm()">
      <h2>Register</h2>
      <input type="text" name="name" id="name" placeholder="Full Name" required><br>
      <input type="email" name="email" id="email" placeholder="Email Address" required><br>
      <input type="password" name="password" id="password" placeholder="Password" required><br>
      <button type="submit">Register</button>

      <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
    </form>
  </div>

  <script>
    function validateForm() {
      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value;

      if (name.length < 3) {
        alert("Name must be at least 3 characters long.");
        return false;
      }

      if (!email.includes("@") || !email.includes(".")) {
        alert("Enter a valid email.");
        return false;
      }

      if (password.length < 6) {
        alert("Password should be at least 6 characters.");
        return false;
      }

      return true;
    }
  </script>

</body>
</html>
