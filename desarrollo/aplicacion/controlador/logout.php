<?php
// aplicacion/controladores/logout.php
// Acción: cerrar sesión y redirigir al inicio

if (session_status() === PHP_SESSION_NONE) session_start();

// Limpiar sesión y cookies
$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// Redirigir
header('Location: ' . url(''));
exit;
