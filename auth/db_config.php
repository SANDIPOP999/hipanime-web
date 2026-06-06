<?php
// Database Configuration
define('DB_HOST', 'sql110.infinityfree.com');
define('DB_USER', 'if0_36531636');
define('DB_PASS', 'Hipanime123');
define('DB_NAME', 'if0_36531636_auth');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
