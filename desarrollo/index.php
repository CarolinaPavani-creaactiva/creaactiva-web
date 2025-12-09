<?php
include 'aplicacion/vistas/header.php';

// Determinar qué vista cargar
$page = $_GET['page'] ?? 'home';

// Si viene vacío, cargar home
if ($page === '') $page = 'home';

// Agregar aquí todas las vistas permitidas
$allowed_pages = ['home', 'equipo', 'servicios', 'blog', 'contacto', 'login'];

if (in_array($page, $allowed_pages)) {
    include "aplicacion/vistas/{$page}.php";
} else {
     include "404.php";
}

include 'aplicacion/vistas/footer.php';
?>
