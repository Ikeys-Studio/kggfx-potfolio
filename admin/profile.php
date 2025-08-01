<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

require_once '../db/config.php';
include('../partials/header.php');

// Get current admin data
$username = $_SESSION['admin'];
$stmt = $conn->prepare("SELECT username, email, full_name, profile_image, updated_at FROM admin_users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$stmt->close();
?>

<h2>My Profile</h2>

<div style="max-width: 500px;">
  <?php if ($admin['profile_image']): ?>
    <img src="/uploads/<?=($admin['profile_image']) ?>" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
  <?php else: ?>
    <p>No profile image uploaded.</p>
  <?php endif; ?>

  <p><strong>Full Name:</strong> <?= htmlspecialchars($admin['full_name']) ?: 'Not set' ?></p>
  <p><strong>Username:</strong> <?= htmlspecialchars($admin['username']) ?></p>
  <p><strong>Email:</strong> <?= htmlspecialchars($admin['email']) ?: 'Not set' ?></p>
  <p><strong>Last Updated:</strong> <?= htmlspecialchars($admin['updated_at']) ?></p>

  <a href="edit_profile.php" class="btn">Edit Profile</a>
</div>

<?php include('../partials/footer.php'); ?>