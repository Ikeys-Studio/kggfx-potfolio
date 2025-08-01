<?php
session_start();
require_once '../../db/config.php'; // Adjust path if needed

$token = $_GET['token'] ?? '';

if (empty($token)) {
    die("Invalid or missing token.");
}

// Check if token is valid and not expired
$stmt = $conn->prepare("SELECT id FROM admins WHERE reset_token = ? AND token_expires > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("This reset link is invalid or expired.");
}

$admin = $result->fetch_assoc();
$admin_id = $admin['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="../../assets/styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Reset Your Password</h2>
        <form action="save_new_password.php" method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <input type="password" name="new_password" placeholder="New Password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
            <button type="submit">Save New Password</button>
        </form>
    </div>
</body>
</html>