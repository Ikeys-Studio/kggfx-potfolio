<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../../db/config.php'; // Make sure this file exists and connects correctly

// Get the email from the form
$email = $_POST['email'] ?? '';

if (empty($email)) {
    $_SESSION['message'] = "Email is required.";
    header("Location: forgot_password.php");
    exit();
}

// Check if email exists in database
$query = $conn->prepare("SELECT id FROM admins WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    $_SESSION['message'] = "No admin account with that email.";
    header("Location: forgot_password.php");
    exit();
}

$admin = $result->fetch_assoc();
$token = bin2hex(random_bytes(32));
$expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

// Save the token in the database
$stmt = $conn->prepare("UPDATE admins SET reset_token = ?, token_expires = ? WHERE id = ?");
$stmt->bind_param("ssi", $token, $expires, $admin['id']);
$stmt->execute();

// Prepare Brevo API email
$resetLink = "https://kg-gfx.42web.io/admin/auth/reset_password.php?token=$token";

$data = [
    'sender' => [
        'name' => 'KG GFX Admin',
        'email' => 'ikeysstudio@gmail.com' // Use a verified sender email from Brevo
    ],
    'to' => [
        ['email' => $email]
    ],
    'subject' => 'Password Reset Request',
    'htmlContent' => "Click the link below to reset your password:<br><a href='$resetLink'>$resetLink</a>",
    'textContent' => "Reset your password here: $resetLink"
];

// Send email using Brevo API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.brevo.com/v3/smtp/email');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'api-key: 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',
    'Content-Type: application/json',
    'Accept: application/json'
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    $_SESSION['message'] = "cURL Error: " . curl_error($ch);
} else {
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($status_code === 201) {
        $_SESSION['message'] = "Password reset email sent successfully.";
    } else {
        $_SESSION['message'] = "Error sending email. Brevo responded with status $status_code: $response";
    }
}

curl_close($ch);
header("Location: forgot_password.php");
exit();