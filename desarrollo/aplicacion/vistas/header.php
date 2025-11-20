<!-- header.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Activa</title>

    <!-- enlace al CSS -->
    <link rel="stylesheet" href="/creaactiva-web/desarrollo/publico/recursos/css/headerStyles.css">

    <!-- Fuente -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header-principal">
        <div class="container header-contenido">

            <!-- LOGO -->
            <div class="logo">
                <a href="/creaactiva-web/desarrollo/index.php">
                    <img src="/creaactiva-web/desarrollo/publico/recursos/imagenes/logo_creaactiva.png"
                        alt="Logo CreaActiva">
                </a>
            </div>

            <!-- NAV + BOTONES -->
            <div class="nav-acciones">

                <!-- BOTÓN HAMBURGUESA (solo visible en móvil) -->
                <button class="btn-menu" id="btn-menu" aria-label="Menú principal">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>


                <!-- MENÚ DE NAVEGACIÓN -->
                <nav class="navegacion" id="navegacion">
                    <ul>
                        <li><a href="/creaactiva-web/desarrollo/index.php?page=home">Inicio</a></li>
                        <li><a href="/creaactiva-web/desarrollo/index.php?page=equipo">Equipo</a></li>
                        <li><a href="/creaactiva-web/desarrollo/index.php?page=servicios">Servicios</a></li>
                        <li><a href="/creaactiva-web/desarrollo/index.php?page=blog">Blog</a></li>
                        <li><a href="/creaactiva-web/desarrollo/index.php?page=contacto">Contacto</a></li>
                    </ul>
                </nav>

                <!-- BOTONES ACCESIBILIDAD E IDIOMA -->
                <div class="acciones-header">
                    <button class="btn-accesibilidad" title="Accesibilidad (modo lectura)">
                        <img src="/creaactiva-web/desarrollo/publico/recursos/imagenes/iconos/oido.png"
                            alt="Accesibilidad" style="height: 24px; width: 24px;">
                    </button>
                    <button class="btn-idioma" title="Cambiar idioma">ES</button>
                </div>
            </div>
        </div>
    </header>
    <!-- Script para el menú móvil -->
  <script src="/creaactiva-web/desarrollo/publico/recursos/js/botonHamburguesaHeader.js"></script>