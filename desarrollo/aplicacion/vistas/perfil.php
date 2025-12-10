<?php

if (!function_exists('url')) {
    function url($ruta = '') { return '/' . ltrim($ruta, '/'); }
}

$token_csrf = $token_csrf ?? '';
$datos_usuario = $datos_usuario ?? [];
$nombre = htmlspecialchars($datos_usuario['nombre'] ?? '');
$email  = htmlspecialchars($datos_usuario['email'] ?? '');
$webpage = htmlspecialchars($datos_usuario['webpage'] ?? '');
$avatar = $datos_usuario['avatar'] ?? null;

?>
<main class="contenedor perfil-contenido" role="main" aria-labelledby="titulo-perfil">
    <h1 id="titulo-perfil">Mi perfil</h1>

    <?php if (!empty($error)): ?>
        <div class="alerta alerta-error" aria-live="assertive">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($exito)): ?>
        <div class="alerta alerta-exito" aria-live="polite">
            <?= htmlspecialchars($exito) ?>
        </div>
    <?php endif; ?>

    <form id="formPerfil" class="form-perfil" action="<?= url('perfil') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($token_csrf) ?>">

        <fieldset class="bloque">
            <legend>Información personal</legend>

            <div class="campo">
                <label for="nombre">Nombre</label>
                <input
                    id="nombre"
                    name="nombre"
                    type="text"
                    required
                    value="<?= $nombre ?>"
                    placeholder="Tu nombre"
                    autocomplete="name"
                >
            </div>

            <div class="campo">
                <label for="email">Correo electrónico</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    value="<?= $email ?>"
                    placeholder="tu@correo.com"
                    autocomplete="email"
                >
            </div>

            <div class="campo">
                <label for="webpage">Página personal (opcional)</label>
                <input
                    id="webpage"
                    name="webpage"
                    type="url"
                    value="<?= $webpage ?>"
                    placeholder="https://tusitio.com"
                >
            </div>
        </fieldset>

        <fieldset class="bloque">
            <legend>Avatar</legend>

            <div class="avatar-actual">
                <p>Avatar actual:</p>
                <?php if (!empty($avatar)): ?>
                    <img src="<?= url($avatar) ?>" alt="Avatar actual" class="avatar-preview">
                <?php else: ?>
                    <img src="<?= url('publico/recursos/imagenes/iconos/user.v2.svg') ?>" alt="Sin avatar" class="avatar-preview">
                <?php endif; ?>
            </div>

            <div class="campo">
                <label for="avatar">Subir nuevo avatar</label>
                <input
                    type="file"
                    id="avatar"
                    name="avatar"
                    accept="image/png, image/jpeg, image/webp"
                >
                <small class="help">Tamaño máximo: 2MB. Formatos permitidos: PNG, JPG, WEBP.</small>
            </div>

            <div class="avatar-nueva-preview" id="previewAvatar" style="display:none;">
                <p>Vista previa:</p>
                <img src="" alt="Vista previa avatar" class="avatar-preview">
            </div>
        </fieldset>

        <fieldset class="bloque">
            <legend>Cambiar contraseña (opcional)</legend>

            <div class="campo">
                <label for="nuevo_password">Nueva contraseña</label>
                <input
                    id="nuevo_password"
                    name="nuevo_password"
                    type="password"
                    placeholder="Dejar vacío para no cambiar"
                    autocomplete="new-password"
                >
            </div>

            <div class="campo">
                <label for="confirm_password">Confirmar nueva contraseña</label>
                <input
                    id="confirm_password"
                    name="confirm_password"
                    type="password"
                    placeholder="Repite la nueva contraseña"
                    autocomplete="new-password"
                >
            </div>
        </fieldset>

        <div class="acciones">
            <button type="submit" class="boton-principal">Guardar cambios</button>
        </div>
    </form>
</main>

<!-- Llamada al script de vista previa del avatar -->
<script src="<?= url('publico/recursos/js/perfil.js') ?>"></script>
