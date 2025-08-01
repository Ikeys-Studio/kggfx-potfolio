<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit();
}

include '../../db/config.php';

if (isset($_POST['submit'])) {
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $demo_link = mysqli_real_escape_string($conn, $_POST['demo_link']);

  // Handle image upload
  $targetDir = "../../uploads/";
  $fileName = basename($_FILES["image"]["name"]);
  $targetFilePath = $targetDir . $fileName;

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
    $relativePath = "uploads/" . $fileName;

    $sql = "INSERT INTO projects (title, description, image, demo_link) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $description, $relativePath, $demo_link);
    $stmt->execute();

    header("Location: projects.php?success=1");
    exit();
  } else {
    echo "Image upload failed.";
  }
}
?>
