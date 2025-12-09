<?php
// aplicacion/controladores/profile_edit.php
// Procesa POST para editar perfil y luego redirige a profile (GET)

require_once __DIR__ . '/../funciones/auth.php'; // opcional si necesitas helpers
require_login(); // fuerza login si no hay sesión

$user = auth_user();
if (!$user || !is_array($user)) {
    header('Location: ' . url('login'));
    exit;
}

$conn = $GLOBALS['conn'] ?? null;
$errors = [];

// Solo aceptamos POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . url('profile'));
    exit;
}

// Recoger y sanitizar
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($name === '') $errors[] = "El nombre no puede estar vacío.";
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Introduce un email válido.";

// Comprobar duplicado email
if (empty($errors) && $conn) {
    $sql = "SELECT id FROM users WHERE email = ? AND id <> ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("si", $email, $user['id']);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res && $res->num_rows > 0) {
            $errors[] = "El email ya está en uso por otro usuario.";
        }
        $stmt->close();
    } else {
        $errors[] = "Error interno (BD).";
    }
}

// Si hay errores -> guardar en sesión para mostrarlos en profile y redirigir
if (!empty($errors)) {
    $_SESSION['flash_errors'] = $errors;
    header('Location: ' . url('profile'));
    exit;
}

// Ejecutar update
if ($conn) {
    if ($password !== '') {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $email, $password_hash, $user['id']);
    } else {
        $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $user['id']);
    }

    if ($stmt && $stmt->execute()) {
        // actualizar sesión si usas $_SESSION['user']
        if (isset($_SESSION['user'])) {
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['email'] = $email;
        }
        $_SESSION['flash_success'] = "Perfil actualizado correctamente.";
    } else {
        $_SESSION['flash_errors'] = ["No se pudieron guardar los cambios."];
    }
    if ($stmt) $stmt->close();
} else {
    $_SESSION['flash_errors'] = ["No hay conexión con la base de datos."];
}

// Redirigir a profile (GET) para mostrar mensajes
header('Location: ' . url('profile'));
exit;
