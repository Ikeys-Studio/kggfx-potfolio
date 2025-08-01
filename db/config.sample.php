<?php
// config.sample.php

$host = 'localhost';
$dbname = 'your_db_name';
$username = 'your_db_user';
$password = 'your_db_password';

// Create the connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>