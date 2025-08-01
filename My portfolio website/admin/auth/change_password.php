<?php
session_start();
require_once '../../db/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminId = $_SESSION['admin_id'];
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if ($new !== $confirm) {
        $message = "<span style='color:red;'>New passwords do not match.</span>";
    } else {
        // Get current hashed password
        $stmt = $conn->prepare("SELECT password FROM admin_users WHERE id = ?");
        $stmt->bind_param("i", $adminId);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        $stmt->close();

        if (!password_verify($current, $hashedPassword)) {
            $message = "<span style='color:red;'>Incorrect current password.</span>";
        } else {
            $newHashed = password_hash($new, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE admin_users SET password = ? WHERE id = ?");
            $update->bind_param("si", $newHashed, $adminId);
            if ($update->execute()) {
                $message = "<span style='color:green;'>Password changed successfully.</span>";
            } else {
                $message = "<span style='color:red;'>Error updating password.</span>";
            }
            $update->close();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Change Password</title>
  <style>
    body {
      font-family: Arial;
      padding: 2rem;
      background: #f0f0f0;
    }
    .form-container {
      background: #fff;
      padding: 2rem;
      border-radius: 8px;
      max-width: 400px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input[type="password"], button {
      width: 100%;
      padding: 10px;
      margin-top: 8px;
    }
    button {
      background-color: #333;
      color: white;
      border: none;
      margin-top: 16px;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Change Password</h2>

  <?= $message ?>

  <form method="POST">
    <label>Current Password</label><br>
    <input type="password" name="current_password" required><br><br>

    <label>New Password</label><br>
    <input type="password" name="new_password" required><br><br>

    <label>Confirm New Password</label><br>
    <input type="password" name="confirm_password" required><br><br>

    <button type="submit">Update Password</button>
  </form>
</div>

</body>
</html>