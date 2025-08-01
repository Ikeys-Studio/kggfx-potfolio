<?php
session_start();

// Set timeout duration (e.g. 600 seconds = 10 minutes)
$timeout_duration = 600;

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
  session_unset();
  session_destroy();
  header("Location: login.php?timeout=true");
  exit();
}

$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity time

// Continue with authentication
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

include('../partials/header.php');
include('index.view.php');
include('../partials/footer.php');
?>