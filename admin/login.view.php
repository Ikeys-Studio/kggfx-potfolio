<?php if (isset($_GET['timeout']) && $_GET['timeout'] === 'true'): ?>
  <p style="color: red;">You have been logged out due to inactivity.</p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="../assets/styles/login.css">
</head>
<body>
  <div class="login-box">
    <h2>Admin Login</h2>

    <!-- Error message (for wrong password or recaptcha fail) -->
    <?php if (!empty($error)): ?>
      <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php">
      <input type="text" name="username" placeholder="Username" required autocomplete="off">
      <input type="password" name="password" placeholder="Password" required autocomplete="off">
      
      <!-- Google reCAPTCHA -->
      <div class="g-recaptcha" data-sitekey="6LeKTpYrAAAAAJ-rcbwhqnTcTQLSeQpCHQbg0c7U"></div>
      <br>

      <button type="submit" name="login">Login</button><br>
      <a href="auth/forgot_password.php">Forgot Password</a>
    </form>
  </div>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>