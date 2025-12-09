<?php
require_login();
$user = auth_user();

// Leer flashes (si existen) y limpiarlos
$flash_errors = $_SESSION['flash_errors'] ?? null;
$flash_success = $_SESSION['flash_success'] ?? null;
unset($_SESSION['flash_errors'], $_SESSION['flash_success']);
?>

<link rel="stylesheet" href="<?= url('publico/recursos/css/mainStyles.css') ?>">

<main class="profile-principal">
    <h2>Mi perfil</h2>

    <?php if ($flash_success): ?>
        <div class="notice success"><?= htmlspecialchars($flash_success) ?></div>
    <?php endif; ?>

    <?php if (!empty($flash_errors)): ?>
        <div class="notice error">
            <ul>
                <?php foreach ($flash_errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <section class="profile-info">
        <p><strong>Nombre:</strong> <?= htmlspecialchars($user['name'] ?? '') ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email'] ?? '') ?></p>
        <p><strong>Rol:</strong> <?= htmlspecialchars($user['role'] ?? '') ?></p>
    </section>

    <section class="profile-edit">
        <h3>Editar perfil</h3>
        <form method="post" action="<?= url('profile_edit') ?>">
            <label>Nombre</label><br>
            <input type="text" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required><br>
            <label>Email</label><br>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required><br>
            <label>Nueva contraseña (dejar en blanco para no cambiar)</label><br>
            <input type="password" name="password" placeholder="••••••••"><br>
            <button type="submit">Guardar cambios</button>
        </form>
    </section>
</main>