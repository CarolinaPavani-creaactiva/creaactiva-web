<?php
// header.php - abre documento, coloca <head> y abre <body>
// No se ejecuta session_start() aquí (index.php ya lo hace)
?>
<!doctype html>
<html lang="ca">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= htmlspecialchars($pageTitle ?? 'CreaActiva') ?></title>

    <!-- CSS base -->
    <link rel="stylesheet" href="<?= url('publico/recursos/css/base/_variables.css') ?>">
    <link rel="stylesheet" href="<?= url('publico/recursos/css/base/_layout.css') ?>">

    <!-- Estilos generales -->
    <link rel="stylesheet" href="<?= url('publico/recursos/css/mainStyles.css') ?>">

    <!-- Estilos del header -->
    <link rel="stylesheet" href="<?= url('publico/recursos/css/headerStyles.css') ?>">
    <link rel="stylesheet" href="<?= url('publico/recursos/css/vistas/responsive/respHeader.css') ?>">

    <!-- Estilos del footer -->
    <link rel="stylesheet" href="<?= url('publico/recursos/css/footerStyles.css') ?>">

    <?= $pageStyles ?? '' ?>
</head>

<body>
    <header class="cabecera" role="banner" id="site-header">
        <div class="cabecera-contenido">
            <div class="cabecera-izq">
                <a href="<?= url('') ?>" class="cabecera-logo" aria-label="Ir a inicio">
                    <img src="<?= url('publico/recursos/imagenes/logo_creaactiva.png') ?>" alt="CreaActiva" height="44">
                </a>
            </div>

            <button id="btn-hamburguesa" class="btn-hamburguesa" aria-label="Abrir menú" aria-expanded="false"
                aria-controls="nav-movil">
                <span class="hamb-line"></span>
                <span class="hamb-line"></span>
                <span class="hamb-line"></span>
            </button>

            <nav class="cabecera-nav">
                <ul class="nav-lista">
                    <li><a href="<?= url('') ?>">Inicio</a></li>
                    <li><a href="<?= url('equipo') ?>">Equipo</a></li>
                    <li><a href="<?= url('servicios') ?>">Servicios</a></li>
                    <li><a href="<?= url('blog') ?>">Blog</a></li>
                    <li><a href="<?= url('contacto') ?>">Contacto</a></li>
                </ul>
            </nav>

            <!-- Header (fragmento) - sustituir sección de idioma / accesibilidad / hamburguesa -->
            <div class="cabecera-der">

                <!-- Idioma -->
                <div class="language-wrapper" id="language-wrapper">
                    <button id="languageBtn" class="language-btn" aria-haspopup="true" aria-expanded="false">
                        CA <span class="caret">&#9662;</span>
                    </button>

                    <ul id="languageMenu" class="language-menu" hidden>
                        <li><button class="language-option" data-lang="ca">CA</button></li>
                        <li><button class="language-option" data-lang="es">ES</button></li>
                        <li><button class="language-option" data-lang="en">EN</button></li>
                    </ul>
                </div>

                <!-- Accesibilidad -->
                <div class="accesibilidad-wrapper" id="accesibilidad-wrapper">
                    <button id="accesibilidadBtn" class="language-btn accesibilidad-btn" aria-haspopup="true"
                        aria-expanded="false">
                        <img src="<?= url('publico/recursos/imagenes/iconos/oido.png') ?>" alt="Accesibilidad"
                            width="18">
                    </button>

                    <ul id="accesibilidadMenu" class="accesibilidad-menu" hidden>
                        <li><button class="acc-option" data-action="increase" aria-label="Aumentar tamaño">A+</button>
                        </li>
                        <li><button class="acc-option" data-action="decrease" aria-label="Disminuir tamaño">A-</button>
                        </li>
                    </ul>
                </div>

                <?php
                $usuario = $_SESSION['usuario'] ?? null;
                ?>
                <div class="user-wrapper">
                    <?php if ($usuario): ?>
                        <div class="user-menu" id="userMenu">
                            <button id="userBtn" class="btn-login user-btn" aria-haspopup="true"
                                aria-controls="userDropdown" aria-expanded="false" type="button">
                                <?= htmlspecialchars($usuario['nombre'] ?? $usuario['username'] ?? 'Usuario') ?>
                                <span class="caret">&#9662;</span>
                            </button>

                            <ul id="userDropdown" class="user-dropdown" role="menu" hidden>
                                <li role="none"><a role="menuitem" href="<?= url('perfil') ?>">Perfil</a></li>
                                <!-- Solo mostrar "Administración" si el rol del usuario es 'admin' -->
                                <?php if ($usuario['role'] === 'admin'): ?>
                                    <li role="none"><a role="menuitem" href="<?= url('panelAdmin') ?>">Administración</a></li>
                                <?php endif; ?>
                                <form action="<?= url('logout') ?>" method="POST">
                                    <button type="submit" class="btn-salir">Salir</button>
                                </form>


                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="<?= url('login') ?>" class="btn-login" id="loginBtn">Entrar</a>
                    <?php endif; ?>
                </div>



            </div>

            <!-- Menú móvil (overlay + panel) -->
            <div id="nav-movil" class="nav-movil" aria-hidden="true">
                <div class="nav-movil-overlay" aria-hidden="true"></div>

                <div class="nav-movil-inner" role="dialog" aria-modal="true" aria-label="Menú móvil">
                    <button class="nav-movil-close" aria-label="Cerrar menú">✕</button>
                    <ul class="nav-movil-lista">
                        <li><a href="<?= url('') ?>">Inicio</a></li>
                        <li><a href="<?= url('equipo') ?>">Equipo</a></li>
                        <li><a href="<?= url('servicios') ?>">Servicios</a></li>
                        <li><a href="<?= url('blog') ?>">Blog</a></li>
                        <li><a href="<?= url('contacto') ?>">Contacto</a></li>
                    </ul>
                </div>
            </div>

    </header>