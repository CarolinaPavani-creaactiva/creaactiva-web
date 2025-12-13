<!-- Estilos principales de tu proyecto -->
<link rel="stylesheet" href="<?php echo $mainStyles; ?>">

<!-- Estilos específicos del panel admin -->
<link rel="stylesheet" href="aplicacion/css/mainStyles.css">

<div class="panel-wrap">

    <!-- Sidebar -->
    <aside class="panel-sidebar">
        <h3>Panel Admin</h3>
        <a href="?page=panelAdmin&action=list" class="<?= ($action === 'list' ? 'active' : '') ?>">Usuarios</a>
        <a href="?page=panelAdmin&action=create" class="<?= ($action === 'create' ? 'active' : '') ?>">Registrar
            usuario</a>
        <a href="?page=perfil">Editar mi perfil</a>
    </aside>

    <!-- Área principal -->
    <main class="panel-main">
        <h2>
            <?php
            if ($action === 'create')
                echo 'Registrar nuevo usuario';
            elseif ($action === 'edit')
                echo 'Editar usuario';
            else
                echo 'Usuarios';
            ?>
        </h2>

        <!-- Mensajes -->
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $m): ?>
                <div class="msg"><?php echo htmlspecialchars($m); ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Errores -->
        <?php if (!empty($errors)): ?>
            <div class="err">
                <ul style="margin:0;padding-left:18px">
                    <?php foreach ($errors as $e): ?>
                        <li><?php echo htmlspecialchars($e); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>


        <!-- LISTA DE USUARIOS -->
        <?php if ($action === 'list'): ?>

            <p class="small">Aquí puedes ver, editar o borrar usuarios.</p>

            <table class="table" role="grid" aria-live="polite">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($u['id']); ?></td>
                                <td><?php echo htmlspecialchars($u['name']); ?></td>
                                <td><?php echo htmlspecialchars($u['email']); ?></td>
                                <td><?php echo htmlspecialchars($u['role'] ?? $u['rol'] ?? 'usuario'); ?></td>

                                <td>
                                    <a class="btn" href="?page=panelAdmin&action=edit&id=<?php echo $u['id']; ?>">Editar</a>

                                    <form class="actions-form" method="post" action="?page=panelAdmin&action=list"
                                        onsubmit="return confirm('¿Borrar usuario?');">
                                        <input type="hidden" name="_csrf" value="<?php echo htmlspecialchars($token_csrf); ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                                        <button type="submit" class="btn secondary">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No hay usuarios.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>


            <!-- FORMULARIO CREAR USUARIO -->
        <?php elseif ($action === 'create'): ?>

            <form method="post" action="?page=panelAdmin&action=create" novalidate>
                <input type="hidden" name="_csrf" value="<?php echo htmlspecialchars($token_csrf); ?>">
                <input type="hidden" name="action" value="create">

                <div class="form-row">
                    <label class="small">Nombre</label>
                    <input name="name" class="input-field" value="<?php echo htmlspecialchars($old['name'] ?? ''); ?>"
                        required>
                </div>

                <div class="form-row">
                    <label class="small">Email</label>
                    <input name="email" type="email" class="input-field"
                        value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>" required>
                </div>

                <div class="form-row">
                    <label class="small">Contraseña</label>
                    <input name="password" type="password" class="input-field" required>
                </div>

                <div class="form-row">
                    <label class="small">Rol</label>
                    <select name="role" class="input-field">
                        <option value="usuario" <?= (!empty($old['role']) && $old['role'] === 'usuario') ? 'selected' : '' ?>>
                            Usuario</option>
                        <option value="admin" <?= (!empty($old['role']) && $old['role'] === 'admin') ? 'selected' : '' ?>>Admin
                        </option>
                    </select>
                </div>

                <button class="btn" type="submit">Crear usuario</button>
            </form>


            <!-- FORMULARIO EDITAR USUARIO -->
        <?php elseif ($action === 'edit' && !empty($userToEdit)): ?>

            <form method="post" action="?page=panelAdmin&action=edit" novalidate>
                <input type="hidden" name="_csrf" value="<?php echo htmlspecialchars($token_csrf); ?>">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?php echo (int) $userToEdit['id']; ?>">

                <div class="form-row">
                    <label class="small">Nombre</label>
                    <input name="name" class="input-field" value="<?php echo htmlspecialchars($userToEdit['name']); ?>"
                        required>
                </div>

                <div class="form-row">
                    <label class="small">Email</label>
                    <input name="email" type="email" class="input-field"
                        value="<?php echo htmlspecialchars($userToEdit['email']); ?>" required>
                </div>

                <div class="form-row">
                    <label class="small">Nueva contraseña (opcional)</label>
                    <input name="password" type="password" class="input-field" placeholder="Déjala vacía para no cambiarla">
                </div>

                <div class="form-row">
                    <label class="small">Rol</label>
                    <select name="role" class="input-field">
                        <option value="usuario" <?= ($userToEdit['role'] === 'usuario') ? 'selected' : '' ?>>Usuario</option>
                        <option value="admin" <?= ($userToEdit['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>

                <button class="btn" type="submit">Guardar cambios</button>
                <a class="btn secondary" href="?page=panelAdmin&action=list">Cancelar</a>
            </form>

        <?php else: ?>

            <p>Acción no válida.</p>

        <?php endif; ?>
    </main>
</div>