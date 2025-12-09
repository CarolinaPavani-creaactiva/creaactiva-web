<!-- aplicacion/vistas/login.php -->
<link rel="stylesheet" href="<?= url('publico/recursos/css/mainStyles.css') ?>">

<div class="login-container">

    <div class="login-card">

        <h2 class="login-title">Iniciar sesión</h2>

        <?php if (!empty($error)): ?>
            <div class="login-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= url('login') ?>" class="login-form">

            <div class="login-field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="Introduce tu email">
            </div>

            <div class="login-field">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" required placeholder="Introduce tu contraseña">
            </div>

            <button type="submit" class="login-btn">Entrar</button>

        </form>

    </div>

</div>
