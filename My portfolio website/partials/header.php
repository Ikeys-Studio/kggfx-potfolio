<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="/assets/styles/style.css">
  <link rel="stylesheet" href="../assets/styles/style.css"> <!-- keep this if needed -->
  <script src="/assets/js/dashboard.js" defer></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: #f8f9fa;
    }

    .admin-container {
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      width: 220px;
      background-color: #2c2c3f;
      color: #fff;
      padding: 20px;
    }

    .sidebar h2 {
      font-size: 1.5rem;
      margin-bottom: 2rem;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar ul li {
      margin-bottom: 1rem;
    }

    .sidebar ul li a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 8px 0;
    }
    
    .sidebar ul li a i {
      margin-right: 8px;
    }

    .sidebar ul li a:hover {
      text-decoration: underline;
    }

    main {
      flex-grow: 1;
      padding: 2rem;
      background-color: #fff;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: left;
    }
  </style>
</head>
<body>
  <div class="admin-container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>KGGFX Admin</h2>
      <ul>
        <li><a href="/admin/index.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="../pages/visitors.php"><i class="fas fa-chart-bar"></i> View Insight</a></li>
        <li><a href="../pages/projects.php"><i class="fas fa-briefcase"></i> Projects</a></li>
        <li><a href="../pages/messages.php"><i class="fas fa-envelope"></i> Messages</a></li>
        <li><a href="/admin/auth/change_password.php">Change Password</a></li>
        <li><a href="/admin/profile.php"><i class="fas fa-user"></i> Profile</a></li>
        <li><a href="/admin/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main>