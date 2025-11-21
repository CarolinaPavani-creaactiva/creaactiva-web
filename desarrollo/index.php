<?php
include 'aplicacion/vistas/header.php';

// Determinar qué vista cargar
$page = $_GET['page'] ?? 'home';

// ⬇️ Añadir esta línea aquí
if ($page === '') $page = 'home';

$allowed_pages = ['home', 'equipo', 'servicios', 'blog', 'contacto'];

if (in_array($page, $allowed_pages)) {
    include "aplicacion/vistas/{$page}.php";
} else {
     include "404.php";
}

include 'aplicacion/vistas/footer.php';
?>
