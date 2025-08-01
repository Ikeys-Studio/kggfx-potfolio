<?php
// forgot_password.php
session_start();
if (isset($_SESSION['admin'])) {
  header("Location: ../index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link rel="stylesheet" href="../../assets/styles/login.css">
</head>
<body>
  <div class="login-container">
    <h2>Forgot Password</h2>
    <?php if (isset($_SESSION['message'])): ?>
      <p class="message"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>
    <form method="POST" action="send_reset.php">
      <input type="email" name="email" placeholder="Enter your email" required>
      <button type="submit">Reset Password</button>
    </form>
    <p><a href="../login.php">Back to login</a></p>
  </div>
</body>
</html>