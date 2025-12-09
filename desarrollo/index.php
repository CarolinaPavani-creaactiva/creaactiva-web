<?php

//Cargar configuración, BASE_URL y helper url()
require_once __DIR__ . '/bootstrap.php';

//Incluir header
include 'aplicacion/vistas/header.php';

// Determinar qué vista / controlador cargar
$page = $_GET['page'] ?? 'home';
if ($page === '')
    $page = 'home';

// Paths
$ctrlPath = __DIR__ . "/aplicacion/controladores/{$page}.php";
$viewPath = __DIR__ . "/aplicacion/vistas/{$page}.php";

// Si existe un controlador, ejecutarlo y terminar
if (file_exists($ctrlPath)) {
    require_once $ctrlPath;
    exit;
}

// Si existe la vista, inclúyela 
$allowed_pages = ['home', 'equipo', 'servicios', 'blog', 'contacto', 'login', 'admin', 'admin_actions', 'profile', 'profile_edit', 'logout'];
if (in_array($page, $allowed_pages) && file_exists($viewPath)) {
    include $viewPath;
} else {
    include "404.php";
}

//Incluir footer
include 'aplicacion/vistas/footer.php';

?>