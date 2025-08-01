<?php
require_once __DIR__ . '/db/config.php';

$ip = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];

$stmt = $conn->prepare("INSERT INTO visitors (ip_address, user_agent) VALUES (?, ?)");
$stmt->bind_param("ss", $ip, $userAgent);
$stmt->execute();
$stmt->close();

$project_query = "SELECT * FROM projects ORDER BY id DESC";
$project_result = mysqli_query($conn, $project_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kofi Grooves Agency | Portfolio</title>

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/style.css">
</head>

<body>
  <header id="main-header" data-aos="fade-down">
    <a href="index.php" class="logo">
      <img src="Image/logo.png" alt="My Logo" class="logo" />
    </a>
    <div class="page-link">
      <a href="about.html">About</a>
      <a href="#portfolio">Portfolio</a>
      <a href="contact.php">Contact</a>
    </div>
  </header>
  <section class="brand-banner" data-aos="fade-down">
    <h1>KGGFX <span>Solutions</span></h1>
    <p id="typed-text" class="typing-text"></p>
  </section>
  


  <section class="section" id="portfolio">
    <h2>Portfolio</h2>
    <p>Here’s a selection of my recent work. More coming soon!</p>
    <div class="project-grid">
      <?php while($project = mysqli_fetch_assoc($project_result)): ?>
    <div class="project">
      <img src="<?= htmlspecialchars($project['image']) ?>" alt="Project">
      <h3><?= htmlspecialchars($project['title']) ?></h3>
      <p><?= htmlspecialchars($project['description']) ?></p>
      <button class="btn" onclick="openModal(
        '<?= addslashes($project['title']) ?>',
        '<?= addslashes($project['description']) ?>'
          )">View Demo</button>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>



  <div class="social-icons">
    <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
    <a href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin"></i></a>
    <a href="https://github.com/" target="_blank"><i class="fab fa-github"></i></a>
  </div>
  </section>

  <footer>
    &copy; 2025 KGGFX Solutions. All rights reserved.
  </footer>

  <!-- Modal Template -->
  <div id="projectModal" class="modal" style="display: none;">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h3 id="modal-title">Project Title</h3>
      <p id="modal-description">This is a more detailed description of the project.</p>
      <div id="modal-video-container"></div>
    </div>
  </div>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="Js/main.js"></script>
</body>

</html>