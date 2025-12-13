<?php
// index.php - Front controller mejorado
session_start();

// Cargar configuración, BASE_URL y helper url()
require_once __DIR__ . '/bootstrap.php';

// Determinar qué vista / controlador cargar
$page = $_GET['page'] ?? 'home';
if ($page === '')
    $page = 'home';

// Paths habituales
$ctrlPath = __DIR__ . "/aplicacion/controladores/{$page}.php";
$ctrlPrefixPath = __DIR__ . "/aplicacion/controladores/Controlador_{$page}.php";
$viewPath = __DIR__ . "/aplicacion/vistas/{$page}.php";

// Intentar cargar controlador (primero el simple, si no existe el prefijado)
$controllerLoaded = false;
$handled = false;
$renderView = false;

if (file_exists($ctrlPath)) {
    require_once $ctrlPath;
    $controllerLoaded = true;
} elseif (file_exists($ctrlPrefixPath)) {
    require_once $ctrlPrefixPath;
    $controllerLoaded = true;
}

if ($controllerLoaded) {
    // Si el controlador indica que ya ha manejado la respuesta, salimos.
    if (isset($handled) && $handled === true) {
        exit;
    }
    // NOTA: no hacemos exit aquí. Dejar que el flujo normal renderice
    // header -> vista -> footer a menos que $handled sea true.
}

// Incluir header
include __DIR__ . '/aplicacion/vistas/header.php';

// Lista blanca de vistas permitidas
$allowed_pages = ['home', 'equipo', 'servicios', 'blog', 'contacto', 'login', 'admin', 'admin_actions', 'perfil', 'panelAdmin', 'logout'];

if (in_array($page, $allowed_pages) && file_exists($viewPath)) {
    include $viewPath;
} else {
    include __DIR__ . '/404.php';
}

// Incluir footer
include __DIR__ . '/aplicacion/vistas/footer.php';
?>