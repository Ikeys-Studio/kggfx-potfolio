<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../admin/login.php");
  exit();
}

include '../db/config.php';

// Fetch projects from database
$sql = "SELECT * FROM projects ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$projects = [];
if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $projects[] = $row;
  }
}

include 'projects.view.php';
?>