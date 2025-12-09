<?php
// bootstrap.php (añade session_start y carga DB + auth)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cargar configuración
$configPathLocal = __DIR__ . '/aplicacion/config.php';
$configPathExample = __DIR__ . '/aplicacion/config.example.php';

if (file_exists($configPathLocal)) {
    $config = include $configPathLocal;
} else {
    $config = include $configPathExample;
}

define('APP_ENV', $config['env'] ?? 'production');
define('BASE_URL', $config['base_url'] ?? '/');

// Helper de rutas absolutas
function url($path = '') {
    $base = rtrim(BASE_URL, '/');
    $path = ltrim($path, '/');
    return $base . '/' . $path;
}

// Cargar conexión a la base de datos
require_once __DIR__ . '/base_de_datos/base_de_datos.php';

// Cargar ficheros de autenticación / usuarios
require_once __DIR__ . '/aplicacion/funciones/auth.php';
