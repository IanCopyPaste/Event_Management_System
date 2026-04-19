<?php
/* ========================================
   CONFIG.PHP - Database Connection
   ======================================== */

// Database credentials for XAMPP
define('DB_HOST', 'localhost');
define('DB_USER', 'root');              // ← XAMPP default
define('DB_PASS', '');                  // ← Usually empty for XAMPP
define('DB_NAME', 'forms');         // ← The database you just created

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die(json_encode([
        'success' => false,
        'error' => 'Database connection failed: ' . $conn->connect_error
    ]));
}

// Set charset
$conn->set_charset("utf8mb4");

// Error reporting - logs to file instead of displaying
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
?>