<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'yellomonkey_db');

// SMTP Settings (for email notifications)
define('SMTP_EMAIL_FROM', 'smtp@yellomon.com');
define('ADMIN_NOTIFICATION_EMAIL', 'hello@yellomonkey.com'); // Address to receive notifications

// Function to get a PDO database connection
function getDB() {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        return new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (\PDOException $e) {
        // Log the error in a real app, but for now we can just kill execution
        die("Database connection failed: " . $e->getMessage());
    }
}
?>
