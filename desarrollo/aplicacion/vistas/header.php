<!-- header.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Activa</title>

    <link rel="stylesheet" href="publico/recursos/css/headerStyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

<header class="h_header-principal">
    <div class="h_header-contenido">

        <!-- LOGO -->
        <div class="h_logo">
            <a href="index.php">
                <img src="publico/recursos/imagenes/logo_creaactiva.png" alt="Logo CreaActiva">
            </a>
        </div>

        <!-- NAV + BOTONES -->
        <div class="h_nav-acciones">

            <!-- HAMBURGUESA -->
            <button class="h_btn-menu" id="h_btn-menu" aria-label="Menú principal">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- MENÚ -->
            <nav class="h_navegacion" id="h_navegacion">
                <ul>
                    <li><a href="index.php?page=home">Inicio</a></li>
                    <li><a href="index.php?page=equipo">Equipo</a></li>
                    <li><a href="index.php?page=servicios">Servicios</a></li>
                    <li><a href="index.php?page=blog">Blog</a></li>
                    <li><a href="index.php?page=contacto">Contacto</a></li>
                </ul>
            </nav>

            <!-- BOTONES ACCESIBILIDAD E IDIOMA -->
            <div class="h_acciones-header">
                <button class="h_btn-accesibilidad">
                    <img src="publico/recursos/imagenes/iconos/oido.png" alt="Accesibilidad" style="height: 24px; width: 24px;">
                </button>
                <button class="h_btn-idioma">ES</button>
            </div>
        </div>
    </div>
</header>

<script src="publico/recursos/js/botonHamburguesaHeader.js"></script>
<!-- fin header.php -->