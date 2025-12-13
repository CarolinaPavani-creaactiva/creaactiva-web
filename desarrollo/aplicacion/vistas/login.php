<!-- CSS de equipo -->
<link rel="stylesheet" href="<?= url('publico/recursos/css/mainStyles.css') ?>"><div class="login-container">

    <h1>Iniciar sesión</h1>

    <?php if (!empty($errors) && is_array($errors)): ?>
        <div class="login-error" role="alert" aria-live="assertive">
            <?= htmlspecialchars(implode(' ', $errors)) ?>
        </div>
    <?php elseif (!empty($error)): ?>
        <div class="login-error" role="alert" aria-live="assertive">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <!-- CSRF -->
        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($token_csrf ?? $_SESSION['_csrf'] ?? '') ?>">

        <div class="login-campo">
            <label for="correo">Correo electrónico</label>
            <input id="correo" name="email" type="email" required placeholder="tucorreo@ejemplo.com"
                value="<?= htmlspecialchars($old['email'] ?? '') ?>" autocomplete="username"
                aria-describedby="correoHelp">
            <small id="correoHelp" class="help">Introduce el correo con el que te registraste.</small>
        </div>

        <div class="login-campo">
            <label for="clave">Contraseña</label>
            <input id="clave" name="password" type="password" required placeholder="••••••••"
                autocomplete="current-password" aria-describedby="claveHelp">
            <small id="claveHelp" class="help">Tu contraseña debe ser segura.</small>
        </div>

        <button type="submit" class="btn-login">Entrar</button>
    </form>


</div>