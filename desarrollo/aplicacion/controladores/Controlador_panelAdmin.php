<?php
// aplicacion/controladores/Controlador_panelAdmin.php
// Controlador para panelAdmin: listar, crear, editar y borrar usuarios.
// Protegido: solo accesible para usuarios con rol 'admin'.

$renderView = false;
$handled = false;

$errors = [];
$messages = [];
$old = [];
$userToEdit = null;
$users = [];
$token_csrf = null;

// Cargar config y auth
$configPath = __DIR__ . '/../config.php';
if (!file_exists($configPath)) {
    $errors[] = 'Falta config.php en aplicacion/';
    $renderView = true;
    return;
}
$config = include $configPath;

// auth.php para tiene_rol() y sesión segura
require_once __DIR__ . '/../funciones/auth.php';
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

// Comprobar rol admin
if (empty($_SESSION['usuario']) || !tiene_rol('admin')) {
    // No autorizado
    http_response_code(403);
    echo '<h1>403 — Acceso denegado</h1><p>No tienes permisos para ver esta página.</p>';
    exit;
}

// CSRF token
if (empty($_SESSION['_csrf_token'])) {
    try {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(16));
    } catch (Exception $e) {
        $_SESSION['_csrf_token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
}
$token_csrf = $_SESSION['_csrf_token'];

// Conectar BD por PDO
try {
    $db = $config['db'];
    $dsn = "mysql:host={$db['host']};port={$db['port']};dbname={$db['name']};charset=utf8mb4";
    $pdo = new PDO($dsn, $db['user'], $db['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    $errors[] = 'Error de conexión a la base de datos.';
    if (!empty($config['env']) && $config['env'] === 'development') {
        $errors[] = 'Detalle: ' . $e->getMessage();
    }
    $renderView = true;
    return;
}

// Acción (list | create | edit | delete)
$action = $_GET['action'] ?? 'list';

// Procesar POST (create / edit / delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postAction = $_POST['action'] ?? '';
    $postedToken = $_POST['_csrf'] ?? '';
    if (empty($postedToken) || !hash_equals($_SESSION['_csrf_token'] ?? '', $postedToken)) {
        $errors[] = 'Token CSRF inválido.';
    } else {
        if ($postAction === 'create') {
            // Crear usuario
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'usuario';

            $old['name'] = $name;
            $old['email'] = $email;
            $old['role'] = $role;

            if ($name === '')
                $errors[] = 'El nombre es obligatorio.';
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL))
                $errors[] = 'Email inválido.';
            if (strlen($password) < 6)
                $errors[] = 'La contraseña debe tener al menos 6 caracteres.';

            if (empty($errors)) {
                // Comprobar duplicados por email o name
                $s = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email OR name = :name');
                $s->execute(['email' => $email, 'name' => $name]);
                if ($s->fetchColumn() > 0) {
                    $errors[] = 'Ya existe un usuario con ese email o nombre.';
                } else {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $ins = $pdo->prepare('INSERT INTO users (name, email, password, role) VALUES (:name,:email,:pw,:role)');
                    $ins->execute(['name' => $name, 'email' => $email, 'pw' => $hash, 'role' => $role]);
                    $messages[] = 'Usuario creado correctamente.';
                    // limpiar campos old
                    $old = [];
                    // redirect para evitar reenvío
                    header('Location: ?page=panelAdmin&action=list');
                    exit;
                }
            }
            $action = 'create';
        } elseif ($postAction === 'edit') {
            // Editar usuario
            $id = intval($_POST['id'] ?? 0);
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? ''; 
            $role = $_POST['role'] ?? 'usuario';

            if ($id <= 0)
                $errors[] = 'ID inválido.';
            if ($name === '')
                $errors[] = 'El nombre es obligatorio.';
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL))
                $errors[] = 'Email inválido.';

            if (empty($errors)) {
                // Comprobar duplicado email/name en otros usuarios
                $s = $pdo->prepare('SELECT COUNT(*) FROM users WHERE (email = :email OR name = :name) AND id != :id');
                $s->execute(['email' => $email, 'name' => $name, 'id' => $id]);
                if ($s->fetchColumn() > 0) {
                    $errors[] = 'Otro usuario ya usa ese email o nombre.';
                } else {
                    if (strlen($password) >= 6) {
                        $hash = password_hash($password, PASSWORD_DEFAULT);
                        $upd = $pdo->prepare('UPDATE users SET name = :name, email = :email, password = :pw, role = :role WHERE id = :id');
                        $upd->execute(['name' => $name, 'email' => $email, 'pw' => $hash, 'role' => $role, 'id' => $id]);
                    } else {
                        // No cambiar password
                        $upd = $pdo->prepare('UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id');
                        $upd->execute(['name' => $name, 'email' => $email, 'role' => $role, 'id' => $id]);
                    }
                    $messages[] = 'Usuario actualizado.';
                    header('Location: ?page=panelAdmin&action=list');
                    exit;
                }
            }
            $action = 'edit';
            $userToEdit = ['id' => $id, 'name' => $name, 'email' => $email, 'role' => $role];
        } elseif ($postAction === 'delete') {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0)
                $errors[] = 'ID inválido.';
            else {
                // evitar borrarse a sí mismo si eres admin logueado
                $currentId = $_SESSION['usuario']['id'] ?? null;
                if ($currentId == $id) {
                    $errors[] = 'No puedes borrarte a ti mismo.';
                } else {
                    $del = $pdo->prepare('DELETE FROM users WHERE id = :id');
                    $del->execute(['id' => $id]);
                    $messages[] = 'Usuario eliminado.';
                    header('Location: ?page=panelAdmin&action=list');
                    exit;
                }
            }
            $action = 'list';
        } else {
            $errors[] = 'Acción no reconocida.';
        }
    }
}

// Preparar datos para la vista
if ($action === 'list' || $action === '') {
    // listar usuarios (paginación simple no incluida)
    $stmt = $pdo->query('SELECT id, name, email, role, created_at FROM users ORDER BY id DESC');
    $users = $stmt->fetchAll();
} elseif ($action === 'edit' && empty($userToEdit)) {
    $id = intval($_GET['id'] ?? 0);
    if ($id > 0) {
        $s = $pdo->prepare('SELECT id, name, email, role FROM users WHERE id = :id LIMIT 1');
        $s->execute(['id' => $id]);
        $userToEdit = $s->fetch();
        if (!$userToEdit) {
            $errors[] = 'Usuario no encontrado.';
            $action = 'list';
            $stmt = $pdo->query('SELECT id, name, email, role, created_at FROM users ORDER BY id DESC');
            $users = $stmt->fetchAll();
        }
    } else {
        $errors[] = 'ID inválido.';
        $action = 'list';
        $stmt = $pdo->query('SELECT id, name, email, role, created_at FROM users ORDER BY id DESC');
        $users = $stmt->fetchAll();
    }
}

// Exponer variables a la vista
$renderView = true;
return;
