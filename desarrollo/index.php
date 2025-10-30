<?php
//La idea es que este index.php cargue el header, el contenido principal y el footer
// Asi podremos modificar el body sin necesidad de tocar esto cada vez

include 'aplicacion/vistas/header.php';

// Determinar qué vista cargar
$page = $_GET['page'] ?? 'home'; // si no hay parámetro, carga home
$allowed_pages = ['home', 'equipo', 'servicios', 'blog', 'contacto'];

if (in_array($page, $allowed_pages)) {
    include "aplicacion/vistas/{$page}.php";
} else {
    echo "<p>Página no encontrada</p>";
}

include 'aplicacion/vistas/footer.php';
?>

