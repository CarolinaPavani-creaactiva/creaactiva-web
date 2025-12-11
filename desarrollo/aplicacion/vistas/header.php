<?php
// aplicacion/vistas/header.php
// Header compacto: logo | nav centrado | idioma + accesibilidad + login/usuario

if (!function_exists('usuario_actual') || !function_exists('generar_token_csrf')) {
    $authPath = __DIR__ . '/../funciones/auth.php';
    if (file_exists($authPath))
        include_once $authPath;
}

// Helper url() (si no existe)
if (!function_exists('url')) {
    function url($ruta = '')
    {
        return '/' . ltrim($ruta, '/');
    }
}

// Página actual (útil para evitar mostrar link de login cuando ya estás en la página de login)
$current_page = $_GET['page'] ?? (isset($page) ? $page : null);

$usuario = function_exists('usuario_actual') ? usuario_actual() : null;
$token_csrf = function_exists('generar_token_csrf') ? generar_token_csrf() : '';

$idiomas = [
    'es' => 'ES',
    'en' => 'EN',
    'ca' => 'CAT'
];
?>
<!doctype html>
<html lang="<?= htmlspecialchars($_COOKIE['site_lang'] ?? 'es') ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'CreaActiva' ?></title>

    <!-- ----------------------
         Orden recomendado de CSS:
         1) variables / layout (base)
         2) estilos generales (main)
         3) estilos del header / responsive (para que puedan sobreescribir main cuando sea necesario)
         ---------------------- -->

    <!-- Variables / utilidades CSS -->
    <link rel="stylesheet" href="<?= url('publico/recursos/css/base/_variables.css') ?>">
    <link rel="stylesheet" href="<?= url('publico/recursos/css/base/_layout.css') ?>">

    <!-- Estilos generales del sitio -->
    <link rel="stylesheet" href="<?= url('publico/recursos/css/mainStyles.css') ?>">

    <!-- Estilos específicos del header (cargados después para tener prioridad si hace falta) -->
    <link rel="stylesheet" href="<?= url('publico/recursos/css/headerStyles.css') ?>">
    <link rel="stylesheet" href="<?= url('publico/recursos/css/vistas/responsive/respHeader.css') ?>">

    <!-- Pequeño override temporal para evitar que reglas accidentales de main oculten el header.
         Quita estas líneas cuando confirmes que ya no son necesarias. -->
    <style>
      /* temporal: asegurar visibilidad del header */
      header.cabecera, #site-header {
        display: block !important;
        position: relative !important;
        visibility: visible !important;
        height: auto !important;
      }
    </style>

    <?php echo "\n<!-- HEADER_SERVIDO: " . realpath(__FILE__) . " -->\n"; ?>
</head>

<body>
    <header class="cabecera" role="banner" id="site-header">
        <div class="cabecera-contenido">
            <div class="cabecera-izq">
                <a href="<?= url('') ?>" class="cabecera-logo" aria-label="Ir a inicio">
                    <img src="<?= url('publico/recursos/imagenes/logo_creaactiva.png') ?>" alt="CreaActiva" height="44">
                </a>
            </div>

            <!-- botón hamburguesa (visible en móvil/tablet según respHeader.css) -->
            <button id="btn-hamburguesa" class="btn-hamburguesa" aria-label="Abrir menú" aria-expanded="false"
                aria-controls="nav-movil">
                <span class="hamb-line" aria-hidden="true"></span>
                <span class="hamb-line" aria-hidden="true"></span>
                <span class="hamb-line" aria-hidden="true"></span>
            </button>

            <!-- Navegación principal -->
            <nav class="cabecera-nav" aria-label="Navegación principal">
                <ul class="nav-lista">
                    <li class="nav-item"><a href="<?= url('') ?>">Inicio</a></li>
                    <li class="nav-item"><a href="<?= url('equipo') ?>">Equipo</a></li>
                    <li class="nav-item"><a href="<?= url('servicios') ?>">Servicios</a></li>
                    <li class="nav-item"><a href="<?= url('blog') ?>">Blog</a></li>
                    <li class="nav-item"><a href="<?= url('contacto') ?>">Contacto</a></li>
                    <?php if (!empty($usuario) && ($usuario['rol'] ?? '') === 'admin'): ?>
                        <li class="nav-item"><a href="<?= url('panelAdmin') ?>">Panel Admin</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <!-- Zona derecha: language box + accesibilidad + login/usuario -->
            <div class="cabecera-der" role="region" aria-label="Controles de cabecera">

                <!-- Language box -->
                <div class="language-wrapper" id="language-wrapper">
                    <button id="languageBtn" class="language-btn" aria-haspopup="true" aria-expanded="false">
                        <?= htmlspecialchars(strtoupper($_COOKIE['site_lang'] ?? 'es')) ?>
                        <span class="caret" aria-hidden="true">&#9662;</span>
                    </button>
                    <ul id="languageMenu" class="language-menu" aria-label="Cambiar idioma" hidden>
                        <?php foreach ($idiomas as $k => $v): ?>
                            <li><button class="language-option"
                                    data-lang="<?= htmlspecialchars($k) ?>"><?= htmlspecialchars($v) ?></button></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Accesibilidad -->
                <div class="accesibilidad-wrapper" id="accesibilidad-wrapper">
                    <button id="accesibilidadBtn" class="language-btn accesibilidad-btn" aria-haspopup="true"
                        aria-expanded="false" title="Accesibilidad">
                        <img src="<?= url('publico/recursos/imagenes/iconos/oido.png') ?>" alt="Accesibilidad"
                            width="18" height="18">
                    </button>
                    <ul id="accesibilidadMenu" class="accesibilidad-menu" hidden>
                        <li><button class="acc-option" data-action="increase">A+</button></li>
                        <li><button class="acc-option" data-action="decrease">A-</button></li>
                    </ul>
                </div>

                <!-- Login / usuario (solo 1 botón en el header) -->
                <?php if (empty($usuario)): ?>
                    <?php if ($current_page !== 'login'): ?>
                        <div class="cabecera-login">
                            <a href="<?= url('index.php?page=login') ?>" class="btn-login" title="Iniciar sesión">
                                <img src="<?= url('publico/recursos/imagenes/iconos/login.svg') ?>" alt="" aria-hidden="true"
                                    width="18" height="18">
                                <span>Entrar</span>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="usuario-info" aria-label="Usuario">
                        <?php if (!empty($usuario['avatar'])): ?>
                            <img class="usuario-avatar" src="<?= url($usuario['avatar']) ?>" alt="Avatar" width="36"
                                height="36">
                        <?php else: ?>
                            <img class="usuario-avatar" src="<?= url('publico/recursos/imagenes/iconos/user.v2.svg') ?>"
                                alt="Avatar" width="36" height="36">
                        <?php endif; ?>
                        <span class="usuario-nombre"><?= htmlspecialchars($usuario['name'] ?? $usuario['email']) ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Nav móvil (overlay) -->
        <div id="nav-movil" class="nav-movil" aria-hidden="true" role="dialog" aria-label="Menú móvil">
            <div class="nav-movil-inner">
                <ul class="nav-movil-lista">
                    <li><a href="<?= url('') ?>">Inicio</a></li>
                    <li><a href="<?= url('equipo') ?>">Equipo</a></li>
                    <li><a href="<?= url('servicios') ?>">Servicios</a></li>
                    <li><a href="<?= url('blog') ?>">Blog</a></li>
                    <li><a href="<?= url('contacto') ?>">Contacto</a></li>
                    <?php if (!empty($usuario) && ($usuario['rol'] ?? '') === 'admin'): ?>
                        <li><a href="<?= url('panelAdmin') ?>">Panel Admin</a></li>
                    <?php endif; ?>
                </ul>

                <div class="nav-movil-footer">
                    <?php if (!empty($usuario)): ?>
                        <div class="nav-movil-user">
                            <span><?= htmlspecialchars($usuario['name'] ?? $usuario['email']) ?></span>
                            <a href="<?= url('perfil') ?>">Mi perfil</a>
                            <form id="formLogoutMovil" action="<?= url('index.php?page=logout') ?>" method="post">
                                <input type="hidden" name="_csrf" value="<?= htmlspecialchars($token_csrf) ?>">
                                <button type="submit" class="boton-sencillo">Cerrar sesión</button>
                            </form>
                        </div>
                    <?php else: ?>
                        <a href="<?= url('index.php?page=login') ?>" class="btn-login">Entrar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="flash-mensajes" role="status" aria-live="polite">
            <?php foreach ((array) $_SESSION['flash'] as $f): ?>
                <div class="flash"><?= htmlspecialchars($f) ?></div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>
        </div>
    <?php endif; ?>

    <!-- JS del header: idioma, accesibilidad, hamburguesa -->
    <script src="<?= url('publico/recursos/js/header.js') ?>" defer></script>
