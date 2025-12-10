<?php
// aplicacion/funciones/auth.php

// INICIO DE SESIÓN (configuración segura de la sesión)
if (session_status() === PHP_SESSION_NONE) {
    // Opciones de cookie de sesión
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    session_set_cookie_params([
        'lifetime' => 0,                
        'path'     => '/', 
        'domain'   => $_SERVER['HTTP_HOST'] ?? '', 
        'secure'   => $secure,          // true si HTTPS
        'httponly' => true,             // evita acceso por JS
        'samesite' => 'Lax',            
    ]);
    session_start();
}

// Helper url() fallback (si no existe en otro sitio)
if (!function_exists('url')) {
    function url($ruta = '') {
        return '/' . ltrim($ruta, '/');
    }
}

// Cargar modelo de login si existe
$modelLoginPath = __DIR__ . '/../modelos/Modelo_login.php';
if (file_exists($modelLoginPath)) {
    include_once $modelLoginPath;
} else {
    error_log("auth.php: no se encontró Modelo_login.php en {$modelLoginPath} (algunas funciones pueden no estar disponibles).");
}

// INICIAR SESIÓN
/**
 * @param string $correo
 * @param string $clave_plain
 * @return bool
 */
function intentar_iniciar_sesion(string $correo, string $clave_plain): bool {

    $correo = trim($correo);
    if ($correo === '' || $clave_plain === '') {
        error_log("intentar_iniciar_sesion: datos vacíos");
        return false;
    }

    if (function_exists('verificarCredencialesCorreo')) {
        $usuario = verificarCredencialesCorreo($correo, $clave_plain);
        if ($usuario !== null) {
            $_SESSION['usuario'] = [
                'id'    => $usuario['id'] ?? null,
                'email' => $usuario['email'] ?? $correo,
                'name'  => $usuario['nombre'] ?? ($usuario['NOMBRE'] ?? null),
                'rol'   => $usuario['rol'] ?? ($usuario['ROL'] ?? 'cliente'),
                'avatar'=> $usuario['avatar'] ?? null,
            ];
            error_log("intentar_iniciar_sesion: login OK para {$correo}");
            return true;
        } else {
            error_log("intentar_iniciar_sesion: credenciales inválidas para {$correo}");
            return false;
        }
    }

    if (function_exists('buscarUsuarioPorCorreo')) {
        $res = buscarUsuarioPorCorreo($correo);
        if ($res === false) {
            error_log("intentar_iniciar_sesion: error en buscarUsuarioPorCorreo");
            return false;
        }
        if ($res->num_rows === 1) {
            $u = $res->fetch_assoc();
            // Intentar detectar hash y verificar
            $campoHash = $u['password'] ?? $u['PASS'] ?? $u['PASSKEY'] ?? null;
            if ($campoHash) {
                $isModern = (strpos($campoHash, '$2y$') === 0 || strpos($campoHash, '$2b$') === 0 || strpos($campoHash, '$argon2') === 0);
                if ($isModern) {
                    $ok = password_verify($clave_plain, $campoHash);
                } else {
                    $ok = hash_equals(sha1($clave_plain), $campoHash);
                }
                if ($ok) {
                    $_SESSION['usuario'] = [
                        'id'    => $u['id'] ?? null,
                        'email' => $u['email'] ?? $correo,
                        'name'  => $u['nombre'] ?? null,
                        'rol'   => $u['rol'] ?? 'cliente',
                        'avatar'=> $u['avatar'] ?? null,
                    ];
                    error_log("intentar_iniciar_sesion: login OK (fallback) para {$correo}");
                    return true;
                } else {
                    error_log("intentar_iniciar_sesion: password mismatch (fallback) para {$correo}");
                    return false;
                }
            } else {
                error_log("intentar_iniciar_sesion: registro sin campo password para {$correo}");
                return false;
            }
        } else {
            error_log("intentar_iniciar_sesion: no existe usuario con correo {$correo}");
            return false;
        }
    }

    // Si no hay funciones del modelo disponibles, no podemos autenticar
    error_log("intentar_iniciar_sesion: no hay funciones de modelo disponibles para autenticar");
    return false;
}

// CERRAR SESIÓN (Es una función auxiliar. Usar Controlador_logout.php para el flujo completo de logout)
function cerrar_sesion_segura(): void {
    $usuario = $_SESSION['usuario']['email'] ?? $_SESSION['usuario']['id'] ?? 'anonimo';
    error_log("cerrar_sesion_segura: cerrando sesión para {$usuario}");

    // Vaciar $_SESSION
    $_SESSION = [];

    // Borrar cookie de sesión si procede
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
        );
    }

    // Destruir sesión en servidor
    session_destroy();
}

// REQUERIR LOGIN / REQUERIR ADMIN
function requiere_login(): void {
    if (empty($_SESSION['usuario'])) {
        header('Location: ' . url('login'));
        exit;
    }
}

 // Asegura que el usuario esté logueado y tenga rol 'admin', si no redirige a home.
function requiere_admin(): void {
    requiere_login();
    $rol = $_SESSION['usuario']['rol'] ?? '';
    if ($rol !== 'admin') {
        header('Location: ' . url('home'));
        exit;
    }
}

/**
 * Devuelve el array de usuario en sesión, o null si no existe.
 * @return array|null
 */
function usuario_actual(): ?array {
    return $_SESSION['usuario'] ?? null;
}

// CSRF: generación y validación simple
/**
 * Crea y devuelve un token CSRF en la sesión.
 * @return string
 */
function generar_token_csrf(): string {
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_csrf_token'];
}

/**
 * Valida un token CSRF recibido y devuelve booleano.
 * @param string $token_recibido
 * @return bool
 */
function validar_token_csrf(string $token_recibido): bool {
    if (empty($_SESSION['_csrf_token'])) return false;
    return hash_equals($_SESSION['_csrf_token'], $token_recibido);
}

// Helper: comprobar rol 
/**
 * Comprueba si el usuario en sesión tiene el rol indicado.
 * @param string $rol_buscado
 * @return bool
 */
function tiene_rol(string $rol_buscado): bool {
    $rol = $_SESSION['usuario']['rol'] ?? '';
    return strtolower($rol) === strtolower($rol_buscado);
}