<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}

require_once '../db/config.php';
$error = "";
$success = "";

$username = $_SESSION['admin'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];

  // Handle profile image upload
  $imagePath = null;
  if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
    $imagePath = '../uploads/profile_' . time() . '.' . $ext;
    move_uploaded_file($_FILES['profile_image']['tmp_name'], $imagePath);
  }

  // Update query
  $query = "UPDATE admin_users SET full_name = ?, email = ?";
  if ($imagePath) {
    $query .= ", profile_image = ?";
  }
  $query .= " WHERE username = ?";

  $stmt = $conn->prepare($query);
  if ($imagePath) {
    $stmt->bind_param("ssss", $full_name, $email, $imagePath, $username);
  } else {
    $stmt->bind_param("sss", $full_name, $email, $username);
  }

  if ($stmt->execute()) {
    $success = "Profile updated successfully.";
  } else {
    $error = "Failed to update profile.";
  }
  $stmt->close();
}

// Fetch current data
$stmt = $conn->prepare("SELECT full_name, email, profile_image FROM admin_users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$stmt->close();

include('../partials/header.php');
?>

<h2>Edit Profile</h2>

<?php if ($error): ?><p style="color:red"><?= $error ?></p><?php endif; ?>
<?php if ($success): ?><p style="color:green"><?= $success ?></p><?php endif; ?>

<form method="POST" enctype="multipart/form-data">
  <label>Full Name:</label><br>
  <input type="text" name="full_name" value="<?= htmlspecialchars($admin['full_name']) ?>"><br><br>

  <label>Email:</label><br>
  <input type="email" name="email" value="<?= htmlspecialchars($admin['email']) ?>"><br><br>

  <label>Profile Image:</label><br>
  <input type="file" name="profile_image"><br>
  <?php if ($admin['profile_image']): ?>
    <img src="<?= $admin['profile_image'] ?>" width="80" style="margin-top:10px;">
  <?php endif; ?>
  <br><br>

  <button type="submit">Save Changes</button>
</form>

<?php include('../partials/footer.php'); ?>