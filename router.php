<?php

/**
 * Local dev router for PHP's built-in server.
 * Emulates the production .htaccess routing.
 *
 *   php -S localhost:8000 router.php
 *
 * NOT used in production (cPanel uses .htaccess).
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve existing static files directly (css, js, images, etc.)
$filePath = __DIR__ . $uri;
if ($uri !== '/' && is_file($filePath)) {
    return false;
}

// Admin front controller (physical /admin/ folder)
if (preg_match('#^/admin(/.*)?$#', $uri)) {
    require __DIR__ . '/admin/index.php';
    return true;
}

// Public front controller
$_GET['route'] = ltrim($uri, '/');
require __DIR__ . '/index.php';
return true;
