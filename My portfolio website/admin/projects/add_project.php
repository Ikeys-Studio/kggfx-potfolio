<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit();
}
?>

<?php include('../partials/header.php'); ?>

<h2>Add New Project</h2>

<form action="save_project.php" method="POST" enctype="multipart/form-data">
  <label>Title:</label><br>
  <input type="text" name="title" required><br><br>

  <label>Description:</label><br>
  <textarea name="description" rows="5" required></textarea><br><br>

  <label>Demo Link (YouTube or other):</label><br>
  <input type="url" name="demo_link" required><br><br>

  <label>Project Image:</label><br>
  <input type="file" name="image" accept="image/*" required><br><br>

  <button type="submit" name="submit">Save Project</button>
</form>

<?php include('../partials/footer.php'); ?>
