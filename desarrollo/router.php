<?php
// Obtiene la ruta solicitada
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$full = ($_SERVER['DOCUMENT_ROOT'] ?? __DIR__) . $path;

// Si el archivo solicitado existe (CSS, JS, imágenes...) lo servimos tal cual
if ($path !== '/' && file_exists($full)) {
    return false; 
}

$segment = trim($path, '/');

if ($segment === '' || $segment === 'index.php') {
    $_GET['page'] = 'home';
} else {
    // Por si algún día existen rutas como /blog/algo
    $parts = explode('/', $segment);
    $_GET['page'] = $parts[0];
}

// Ejecuta el index.php con la variable $_GET['page'] ya configurada
require_once __DIR__ . '/index.php';
