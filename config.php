<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'yellomonkey_db');

// SMTP Settings (for email notifications)
define('TITAN_SMTP_PASSWORD', ''); // Add your Hostinger Titan email password here
define('SMTP_EMAIL_FROM', 'smtp@yellomonkey.com');
define('ADMIN_NOTIFICATION_EMAIL', 'info@yellomonkey.com, albert@yellomonkey.com, hemant@yellomonkey.com'); // Addresses to receive notifications

// Global Security Headers
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");

// Secure Session Cookie Configuration
session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'domain' => '', // Empty string lets the browser infer the domain correctly without port issues
    'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
    'httponly' => true,
    'samesite' => 'Strict'
]);

// CSRF Token Helpers
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
        return true;
    }
    return false;
}

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
