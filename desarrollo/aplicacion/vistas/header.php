<?php
// Asegurar sesión por si acaso
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Activa</title>

    <base href="<?php echo BASE_URL; ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= url('favicon.ico') ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= url('publico/recursos/css/headerStyles.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

    <header class="h_header-principal">
        <div class="h_header-contenido">

            <!-- HAMBURGUESA -->
            <button class="h_btn-menu" id="h_btn-menu" aria-label="Menú principal">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- LOGO -->
            <div class="h_logo">
                <a href="<?= url('') ?>">
                    <img src="<?= url('publico/recursos/imagenes/logo_creaactiva.png') ?>" alt="Logo CreaActiva">
                </a>
            </div>

            <!-- DERECHA -->
            <div class="h_nav-acciones">

                <!-- MENÚ -->
                <nav class="h_navegacion" id="h_navegacion">
                    <ul>
                        <li><a href="<?= url('home') ?>" data-i18n="header.inicio">Inicio</a></li>
                        <li><a href="<?= url('equipo') ?>" data-i18n="header.equipo">Equipo</a></li>
                        <li><a href="<?= url('servicios') ?>" data-i18n="header.servicios">Servicios</a></li>
                        <li><a href="<?= url('blog') ?>" data-i18n="header.blog">Blog</a></li>
                        <li><a href="<?= url('contacto') ?>" data-i18n="header.contacto">Contacto</a></li>
                        <!-- 🔥 Login quitado para evitar duplicados -->
                    </ul>
                </nav>

                <!-- ACCESIBILIDAD + IDIOMA + LOGIN -->
                <div class="h_acciones-header">

                    <button class="h_btn-accesibilidad">
                        <img src="<?= url('publico/recursos/imagenes/iconos/oido.png') ?>" alt="Accesibilidad"
                            style="height: 24px; width: 24px;">
                    </button>

                    <!-- Selector idioma -->
                    <button id="lang-btn" class="h_btn-idioma">ES</button>

                    <div id="lang-menu" class="lang-menu">
                        <span data-lang="es" data-i18n="header.espanol">Español</span>
                        <span data-lang="en" data-i18n="header.english">English</span>
                        <span data-lang="va" data-i18n="header.valenciano">Valencià</span>
                    </div>

                    <!-- LOGIN / LOGOUT -->
                    <div class="h_login-logout">
                        <?php if (!empty($_SESSION['user'])): ?>
                            <a href="<?= url('logout') ?>" class="btn-login" title="Cerrar sesión">
                                <img src="<?= url('publico/recursos/imagenes/iconos/logout.svg') ?>" alt="logout">
                                Cerrar sesión
                            </a>
                        <?php else: ?>
                            <a href="<?= url('login') ?>" class="btn-login" title="Iniciar sesión">
                                <img src="<?= url('publico/recursos/imagenes/iconos/login.svg') ?>" alt="login">
                                Iniciar sesión
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Scripts -->
    <script src="<?= url('publico/recursos/js/botonHamburguesaHeader.js') ?>" defer></script>
    <script src="<?= url('publico/recursos/js/i18n.js') ?>" defer></script>