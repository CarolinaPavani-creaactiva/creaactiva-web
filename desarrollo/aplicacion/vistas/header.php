<?php
// aplicacion/vistas/header.php
// Versión conservadora: mantiene estilo original del ZIP y añade idioma + accesibilidad + hamburguesa.
// Incluye auth si hace falta.
if (!function_exists('usuario_actual') || !function_exists('generar_token_csrf')) {
    $authPath = __DIR__ . '/../funciones/auth.php';
    if (file_exists($authPath)) include_once $authPath;
}
if (!function_exists('url')) {
    function url($ruta = '') { return '/' . ltrim($ruta, '/'); }
}

$usuario = function_exists('usuario_actual') ? usuario_actual() : null;
$token_csrf = function_exists('generar_token_csrf') ? generar_token_csrf() : '';
$idiomas = ['es'=>'ES 🇪🇸','en'=>'EN 🇬🇧','ca'=>'CAT 🇨🇦'];
?>
<!doctype html>
<html lang="<?= htmlspecialchars($_COOKIE['site_lang'] ?? 'es') ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'CreaActiva' ?></title>

  <!-- Link CSS del header -->
  <link rel="stylesheet" href="<?= url('publico/recursos/css/headerStyles.css') ?>">
  <link rel="stylesheet" href="<?= url('publico/recursos/css/responsive/respHeader.css') ?>">
  <link rel="icon" href="<?= url('publico/recursos/imagenes/favicon.ico') ?>" type="image/x-icon">
</head>
<body class="<?= (isset($_COOKIE['site_contrast']) && $_COOKIE['site_contrast']==='high') ? 'alto-contraste' : '' ?>">

<header class="cabecera" role="banner">
  <!-- usamos tu .contenedor para limitar ancho y preservar diseño -->
  <div class="contenedor cabecera-contenido">
    <div class="cabecera-izq">
      <a href="<?= url('home') ?>" class="cabecera-logo" aria-label="Ir a inicio">
        <img src="<?= url('publico/recursos/imagenes/logo_creaactiva.png') ?>" alt="CreaActiva" height="44">
      </a>
    </div>

    <!-- botón hamburguesa (visible solo en móvil/tablet) -->
    <button id="btn-hamburguesa" class="btn-hamburguesa" aria-label="Abrir menú" aria-expanded="false" aria-controls="nav-movil">
      <span class="hamb-line"></span><span class="hamb-line"></span><span class="hamb-line"></span>
    </button>

    <!-- Navegación principal (la estructura queda igual que en tu ZIP) -->
    <nav class="cabecera-nav" aria-label="Navegación principal">
      <ul class="nav-lista">
        <li class="nav-item"><a href="<?= url('home') ?>">Inicio</a></li>
        <li class="nav-item"><a href="<?= url('equipo') ?>">Equipo</a></li>
        <li class="nav-item"><a href="<?= url('servicios') ?>">Servicios</a></li>
        <li class="nav-item"><a href="<?= url('blog') ?>">Blog</a></li>
        <li class="nav-item"><a href="<?= url('contacto') ?>">Contacto</a></li>
        <?php if (!empty($usuario) && ($usuario['rol'] ?? '') === 'admin'): ?>
          <li class="nav-item"><a href="<?= url('panelAdmin') ?>">Panel Admin</a></li>
        <?php endif; ?>
      </ul>
    </nav>

    <!-- zona derecha: insertamos controles dentro del contenedor existente para no romper visual -->
    <div class="cabecera-der" role="region" aria-label="Controles de cabecera">
      <!-- CONTROL de idioma -->
      <div class="control idioma-control" aria-label="Selector de idioma">
        <label for="select-idioma" class="visually-hidden">Idioma</label>
        <select id="select-idioma" class="select-idioma" aria-label="Cambiar idioma">
          <?php foreach ($idiomas as $k => $v): ?>
            <option value="<?= htmlspecialchars($k) ?>" <?= (($_COOKIE['site_lang'] ?? 'es') === $k) ? 'selected' : '' ?>><?= htmlspecialchars($v) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- ACCESIBILIDAD (solo UN conjunto: contraste | A+ | A-) -->
      <div class="control accesibilidad-control" role="group" aria-label="Controles de accesibilidad">
        <button id="btn-contraste" class="btn-accesibilidad" title="Alternar alto contraste" aria-pressed="false">Contraste</button>
        <button id="btn-aumentar-texto" class="btn-accesibilidad" title="Aumentar tamaño de letra">A+</button>
        <button id="btn-disminuir-texto" class="btn-accesibilidad" title="Disminuir tamaño de letra">A-</button>
      </div>

      <!-- Estado de usuario: mantenemos markup original si existía -->
      <?php if (!empty($usuario)): ?>
        <div class="usuario-info" aria-live="polite">
          <?php if (!empty($usuario['avatar'])): ?>
            <img class="usuario-avatar" src="<?= url($usuario['avatar']) ?>" alt="Avatar de <?= htmlspecialchars($usuario['name'] ?? $usuario['email']) ?>" width="36" height="36">
          <?php else: ?>
            <img class="usuario-avatar" src="<?= url('publico/recursos/imagenes/iconos/user.v2.svg') ?>" alt="Avatar por defecto" width="36" height="36">
          <?php endif; ?>

          <span class="usuario-nombre"><?= htmlspecialchars($usuario['name'] ?? $usuario['email']) ?></span>
          <a class="boton-perfil" href="<?= url('perfil') ?>" title="Mi perfil">Mi perfil</a>

          <form id="formLogout" action="<?= url('logout') ?>" method="post" style="display:inline;">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($token_csrf) ?>">
            <button type="submit" class="boton-sencillo" title="Cerrar sesión">Cerrar sesión</button>
          </form>
        </div>
      <?php else: ?>
        <div class="cabecera-login">
          <a href="<?= url('login') ?>" class="btn-login" title="Iniciar sesión">
            <img src="<?= url('publico/recursos/imagenes/iconos/login.svg') ?>" alt="" aria-hidden="true" width="18" height="18">
            <span>Entrar</span>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- nav-movil: overlay que se abre en móvil (no cambia tu layout normal) -->
  <div id="nav-movil" class="nav-movil" aria-hidden="true">
    <div class="nav-movil-inner">
      <ul class="nav-movil-lista">
        <li><a href="<?= url('home') ?>">Inicio</a></li>
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
          <span><?= htmlspecialchars($usuario['name'] ?? $usuario['email']) ?></span>
          <a href="<?= url('perfil') ?>">Mi perfil</a>
          <form id="formLogoutMovil" action="<?= url('logout') ?>" method="post">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($token_csrf) ?>">
            <button type="submit" class="boton-sencillo">Cerrar sesión</button>
          </form>
        <?php else: ?>
          <a href="<?= url('login') ?>" class="btn-login">Entrar</a>
        <?php endif; ?>
      </div>
    </div>
  </div>

</header>

<?php if (!empty($_SESSION['flash'])): ?>
  <div class="flash-mensajes" role="status" aria-live="polite">
    <?php foreach ((array)$_SESSION['flash'] as $f): ?>
      <div class="flash"><?= htmlspecialchars($f) ?></div>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
  </div>
<?php endif; ?>

<!-- script header (toggle menu + accesibilidad + idioma) -->
<script src="<?= url('publico/recursos/js/header.js') ?>" defer></script>
