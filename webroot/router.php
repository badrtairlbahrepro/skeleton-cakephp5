<?php
// This file is used by PHP's built-in server to serve static files
// before passing requests to index.php for CakePHP routing

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// If the requested file or directory exists, serve it directly
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Otherwise, route through index.php
require_once __DIR__ . '/index.php';
