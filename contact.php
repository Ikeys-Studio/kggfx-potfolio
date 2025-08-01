<?php
require_once __DIR__ . '/db/config.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = htmlspecialchars(trim($_POST["name"]));
  $email = htmlspecialchars(trim($_POST["_replyto"]));
  $message = htmlspecialchars(trim($_POST["message"]));

  // Save to database
  $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $email, $message);
  if ($stmt->execute()) {
    $success = "Message saved successfully.";

    // Forward to Formspree
    $formspreeEndpoint = "https://formspree.io/f/xyzpwvpd"; // replace with your ID
    $data = http_build_query([
      'name' => $name,
      '_replyto' => $email,
      'message' => $message
    ]);

    $options = [
      'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => $data,
      ],
    ];
    $context = stream_context_create($options);
    file_get_contents($formspreeEndpoint, false, $context);

  } else {
    $error = "Failed to send message.";
  }

  $stmt->close();
}

include 'contact.view.php';