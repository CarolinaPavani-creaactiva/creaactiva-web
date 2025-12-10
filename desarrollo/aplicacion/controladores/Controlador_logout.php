<?php
// aplicacion/controladores/Controlador_logout.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('url')) {
    function url($ruta = '') {
        return '/' . ltrim($ruta, '/');
    }
}

// Por defecto redirigir a home después del logout
$pagina_destino = url('home');

// Forzar que el logout sólo se pueda hacer por POST

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Método no permitido";
    exit;
}


// Debug: registrar intento de logout
error_log("DEBUG_Controlador_logout: inicio logout. Método: " . $_SERVER['REQUEST_METHOD']);

// Si existe un usuario en sesión, lo guardamos para el log
$usuario_actual = $_SESSION['usuario']['email'] ?? $_SESSION['usuario']['id'] ?? null;

// 1) Vaciar variables de sesión
$_SESSION = [];

// 2) Si la cookie de sesión existe, eliminarla en cliente
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    // Poner la cookie con fecha pasada para eliminarla
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3) Destruir la sesión en servidor
session_destroy();

// 4) Regenerar id de sesión como medida adicional de higiene (no siempre disponible tras destroy)
// Intentamos iniciar nueva sesión mínima para regenerar ID y cerrarla de nuevo
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_regenerate_id(true);
session_unset();
session_destroy();

error_log("DEBUG_Controlador_logout: sesión cerrada para usuario: " . ($usuario_actual ?? 'anonimo'));

// 5) Redirigir al usuario a la página deseada (por defecto 'home')
header('Location: ' . $pagina_destino);
exit;
