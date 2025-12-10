<?php
// aplicacion/vistas/admin.php
require_admin();
require_once __DIR__ . '/../modelso/Modelo_usuario.php';
$users = usuarios_obtener_todos();
?>
<h2>Panel admin - Usuarios</h2>
<p><a href="index.php?page=home">Volver</a></p>
<table border="1" cellpadding="6">
  <thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Creado</th><th>Acciones</th></tr></thead>
  <tbody>
    <?php foreach($users as $u): ?>
      <tr>
        <td><?= $u['id'] ?></td>
        <td><?= htmlspecialchars($u['name']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td><?= htmlspecialchars($u['role']) ?></td>
        <td><?= htmlspecialchars($u['created_at']) ?></td>
        <td>
          <?php if ($u['role'] !== 'admin'): ?>
            <form method="post" action="index.php?page=admin_actions" style="display:inline">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= $u['id'] ?>">
              <button onclick="return confirm('Borrar usuario #<?= $u['id'] ?>?')">Borrar</button>
            </form>
          <?php else: echo '--'; endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
