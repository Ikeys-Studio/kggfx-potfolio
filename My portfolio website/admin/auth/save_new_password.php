<?php
session_start();
require_once '../../db/config.php';

$token = $_POST['token'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if (empty($token) || empty($new_password) || empty($confirm_password)) {
    die("All fields are required.");
}

if ($new_password !== $confirm_password) {
    die("Passwords do not match.");
}

// Find the admin with that token
$stmt = $conn->prepare("SELECT id FROM admins WHERE reset_token = ? AND token_expires > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Invalid or expired token.");
}

$admin = $result->fetch_assoc();
$admin_id = $admin['id'];

// Hash and save new password
$hashed = password_hash($new_password, PASSWORD_DEFAULT);
$update = $conn->prepare("UPDATE admins SET password = ?, reset_token = NULL, token_expires = NULL WHERE id = ?");
$update->bind_param("si", $hashed, $admin_id);
$update->execute();

echo "Password has been updated. <a href='login.php'>Login now</a>";