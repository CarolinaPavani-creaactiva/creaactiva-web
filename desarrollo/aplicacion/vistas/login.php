<?php

// Asegurarse de que la función para generar el token CSRF esté disponible
if (!function_exists('generar_token_csrf')) {
    $p = __DIR__ . '/../funciones/auth.php';
    if (file_exists($p)) include_once $p;
}

$token_csrf = function_exists('generar_token_csrf') ? generar_token_csrf() : '';
$valor_correo = $valor_correo ?? '';
?>

<main class="contenedor contenido-login" role="main" aria-labelledby="titulo-login">
    <h1 id="titulo-login"><?= htmlspecialchars($pageTitle ?? 'Iniciar sesión') ?></h1>

    <?php if (!empty($error)): ?>
        <div class="alerta alerta-error" role="alert" aria-live="assertive">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form id="formLogin" class="form-login" action="<?= url('login') ?>" method="post" novalidate>
        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($token_csrf) ?>">

        <div class="campo">
            <label for="correo">Correo electrónico</label>
            <input
                id="correo"
                name="correo"
                type="email"
                required
                placeholder="tucorreo@ejemplo.com"
                value="<?= htmlspecialchars($valor_correo) ?>"
                autocomplete="username"
                aria-describedby="correoHelp"
            >
            <small id="correoHelp" class="help">Introduce el correo con el que te registraste.</small>
        </div>

        <div class="campo">
            <label for="clave">Contraseña</label>
            <input
                id="clave"
                name="clave"
                type="password"
                required
                placeholder="••••••••"
                autocomplete="current-password"
                aria-describedby="claveHelp"
            >
            <small id="claveHelp" class="help">Tu contraseña debe ser segura.</small>
        </div>

        <div class="campo acciones">
            <button type="submit" class="boton-principal">Entrar</button>
            <a href="<?= url('recuperar_clave') ?>" class="enlace-pequeno">¿Has olvidado la contraseña?</a>
        </div>
    </form>

    <section class="registro-aux">
        <p>¿Aún no tienes cuenta? <a href="<?= url('registro') ?>">Regístrate aquí</a>.</p>
    </section>
</main>

<!-- Pequeño script opcional para mejorar UX: no doble submit -->
<script src="<?= url('publico/recursos/js/formLogin.js') ?>"></script>

