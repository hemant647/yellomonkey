<?php
// router.php - Only used for local PHP built-in server (e.g. php -S localhost:8000 router.php)
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$ext = pathinfo($path, PATHINFO_EXTENSION);

if ($ext == 'php') {
    // They requested .php explicitly, allow it
    return false; 
}

// Serve static files as-is
if (file_exists($_SERVER["DOCUMENT_ROOT"] . $path) && is_file($_SERVER["DOCUMENT_ROOT"] . $path)) {
    return false;
}

// If it's a directory, try index.php
if (is_dir($_SERVER["DOCUMENT_ROOT"] . $path)) {
    $path = rtrim($path, '/') . '/index';
}

// Handle /blogs/[slug] custom route
if (preg_match('#^/blogs/([a-zA-Z0-9_-]+)$#', $path, $matches)) {
    $_GET['slug'] = $matches[1];
    $path = '/blog_single';
}

// Check if a .php file exists for the requested path without extension
if (file_exists($_SERVER["DOCUMENT_ROOT"] . $path . '.php')) {
    $script = $_SERVER["DOCUMENT_ROOT"] . $path . '.php';
    $_SERVER['SCRIPT_FILENAME'] = $script;
    $_SERVER['SCRIPT_NAME'] = $path . '.php';
    $_SERVER['PHP_SELF'] = $path . '.php';
    
    // Change directory to the requested script's directory so relative paths work
    chdir(dirname($script));
    
    require $script;
    return true;
}

// Fallback to default behavior (404 or index)
return false;
?>
