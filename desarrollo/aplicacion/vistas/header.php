<!-- header.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Activa</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico">

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
                        <li><a href="index.php?page=home" data-i18n="header.inicio">Inicio</a></li>
                        <li><a href="index.php?page=equipo" data-i18n="header.equipo">Equipo</a></li>
                        <li><a href="index.php?page=servicios" data-i18n="header.servicios">Servicios</a></li>
                        <li><a href="index.php?page=blog" data-i18n="header.blog">Blog</a></li>
                        <li><a href="index.php?page=contacto" data-i18n="header.contacto">Contacto</a></li>
                    </ul>
                </nav>

                <!-- BOTONES ACCESIBILIDAD E IDIOMA -->
                <div class="h_acciones-header">

                    <button class="h_btn-accesibilidad">
                        <img src="publico/recursos/imagenes/iconos/oido.png" 
                             alt="Accesibilidad"
                             style="height: 24px; width: 24px;">
                    </button>

                    <!-- BOTÓN IDIOMA -->
                    <button id="lang-btn" class="h_btn-idioma">ES</button>

                    <!-- MENÚ IDIOMAS (oculto) -->
                    <div id="lang-menu" class="lang-menu">
                        <span data-lang="es" data-i18n="header.espanol">Español</span>
                        <span data-lang="en" data-i18n="header.english">English</span>
                        <span data-lang="val" data-i18n="header.valenciano">Valencià</span>
                    </div>

                </div>

            </div>
        </div>
    </header>

    <!-- script menu hamburguesa -->
    <script src="publico/recursos/js/botonHamburguesaHeader.js" defer></script>

    <!-- script traduccion -->
    <script src="publico/recursos/js/i18n.js" defer></script>

    <!-- fin header.php -->
