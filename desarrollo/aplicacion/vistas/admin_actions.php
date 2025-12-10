<?php
// aplicacion/vistas/admin_actions.php
require_admin();
require_once __DIR__ . '/../modelos/Modelo_usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'delete') {
        $id = intval($_POST['id'] ?? 0);
        if ($id > 0) {
            usuario_eliminar($id);
        }
    }
}

header('Location: index.php?page=admin');
exit;
