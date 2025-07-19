<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #c3ecb2, #7ddaff);
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .login-box {
      background: #ffffff;
      padding: 40px 30px;
      border-radius: 15px;
      box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
      width: 350px;
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 25px;
    }

    input {
      width: 100%;
      padding: 12px 15px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      outline: none;
      transition: 0.3s;
    }

    input:focus {
      border-color: #2980b9;
      box-shadow: 0 0 5px rgba(41, 128, 185, 0.5);
    }

    .toggle-password {
      text-align: right;
      margin-top: -8px;
      font-size: 12px;
      cursor: pointer;
      color: #2980b9;
    }

    button {
      width: 100%;
      padding: 12px;
      background: #27ae60;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #219150;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h2>🔐 Admin Login</h2>

    <form id="loginForm" action="auth.php" method="POST" onsubmit="return validateForm()">
      <input type="text" name="username" id="username" placeholder="Username" required>
      <input type="password" name="password" id="password" placeholder="Password" required>
      <div class="toggle-password" onclick="togglePassword()">👁 Show Password</div>
      <input type ="radio" include
      <button type="submit">Login</button>

    </form>

    <?php
      if (isset($_GET['error'])) {
        echo "<p class='error'>" . htmlspecialchars($_GET['error']) . "</p>";
      }
    ?>
  </div>

  <script>
    function togglePassword() {
      const pwd = document.getElementById("password");
      const toggle = document.querySelector(".toggle-password");

      if (pwd.type === "password") {
        pwd.type = "text";
        toggle.textContent = "🙈 Hide Password";
      } else {
        pwd.type = "password";
        toggle.textContent = "👁 Show Password";
      }
    }

    function validateForm() {
      const username = document.getElementById("username").value.trim();
      const password = document.getElementById("password").value.trim();

      if (username === "" || password === "") {
        alert("⚠️ Please fill in both fields.");
        return false;
      }
      return true;
    }
  </script>

</body>
</html>
