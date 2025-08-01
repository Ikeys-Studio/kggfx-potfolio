<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../admin/login.php");
  exit();
}

require_once '../db/config.php';

$result = $conn->query("SELECT * FROM visitors");
$visitors = $result->fetch_all(MYSQLI_ASSOC);

require 'visitors.view.php';
?>