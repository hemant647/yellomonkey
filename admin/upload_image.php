<?php
session_start();
require_once '../config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Check if a file was uploaded
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    
    // Validate file type
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $fileMimeType = mime_content_type($_FILES['file']['tmp_name']);
    
    if (!in_array($fileMimeType, $allowedMimeTypes)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid file type. Only JPG, PNG, GIF, and WEBP are allowed.']);
        exit;
    }

    // Set upload directory
    $uploadDir = '../assets/images/blog/';
    
    // Create directory if it doesn't exist (just in case)
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Generate unique filename
    $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9.\-_]/', '', basename($_FILES['file']['name']));
    $targetPath = $uploadDir . $fileName;

    // Move file
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
        // Return JSON with the image location relative to the frontend root
        // Since this script is in /admin/ and images are in /assets/, the URL from the root is /assets/images/blog/...
        // To be safe for relative paths from the blog post, we can use the absolute path from the domain root.
        $location = '/assets/images/blog/' . $fileName;
        echo json_encode(['location' => $location]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to save uploaded file.']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'No file uploaded or upload error occurred.']);
}
?>
