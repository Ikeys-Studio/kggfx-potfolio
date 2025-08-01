<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KGGFX Solutions | Contact</title>
  <link rel="stylesheet" href="styles/style.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
</head>
<body>
  <header>
    <a href="index.php" class="logo">
      <img src="Image/logo.png" alt="My Logo" class="logo" />
    </a>
    <div class="page-link">
      <a href="index.php">Home</a>
      <a href="about.html">About</a>
      <a href="contact.php" class="active">Contact</a>
    </div>
  </header>

  <section class="brand-banner">
    <h1>Contact KGGFX Solutions</h1>
    <p>Let's connect and create something amazing together.</p>
  </section>

  <section class="section" id="contact">
    <h2>Contact Me</h2>

    <?php if (!empty($success)): ?>
      <p style="color: green;"><?= $success ?></p>
    <?php elseif (!empty($error)): ?>
      <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="contact.php">
      <label for="name">Name</label><br>
      <input type="text" name="name" id="name" required><br><br>

      <label for="email">Email</label><br>
      <input type="email" name="_replyto" id="email" required><br><br>

      <label for="message">Message</label><br>
      <textarea name="message" id="message" rows="5" required></textarea><br><br>

      <button type="submit">Send Message</button>
    </form>
  </section>

  <div class="social-icons">
    <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
    <a href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin"></i></a>
    <a href="https://github.com/" target="_blank"><i class="fab fa-github"></i></a>
  </div>

  <footer>
    &copy; <?= date('Y') ?> KGGFX Solutions. All rights reserved.
  </footer>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>
</html>