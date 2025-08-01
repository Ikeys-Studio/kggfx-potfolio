<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../admin/login.php");
  exit();
}

include '../db/config.php';

// Fetch messages
$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

$messages = [];
if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
  }
}

include 'messages.view.php';
?>