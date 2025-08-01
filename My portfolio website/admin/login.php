<?php
session_start();
require_once '../db/config.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $recaptchaSecret = '6LeKTpYrAAAAACedYf2Wiy9E0BlaI-SbsmOB9Yv9';
    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'secret' => $recaptchaSecret,
    'response' => $recaptchaResponse
]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $captchaSuccess = json_decode($response);

    if (!$captchaSuccess->success) {
    $error = "Please complete the reCAPTCHA verification.";
    include 'login.view.php';
    exit();
}
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin'] = $user['username'];
            $_SESSION['admin_id'] = $user['id']; // Add this line
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid username.";
    }

    $stmt->close();
    $conn->close();
}

include 'login.view.php';
?>