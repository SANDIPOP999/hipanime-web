<?php
// Database Configuration
define('DB_HOST', 'dpg-d8hv44u47okc738t7mng-a'); 
define('DB_PORT', '5432'); // Default PostgreSQL port is 5432
define('DB_USER', 'hipanime_kun');
define('DB_PASS', 'km7yiayLLa3KvQJJCrBJ31qvefCHVku9');
define('DB_NAME', 'user_ktgy');

try {
    // Create connection using PDO for PostgreSQL
    $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
    
    // Vercel's PHP runtime supports PDO out of the box
    $conn = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Turn on errors
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Fetch data as arrays
    ]);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
