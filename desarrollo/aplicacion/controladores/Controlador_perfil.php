<?php
// aplicacion/controladores/Controlador_perfil.php
// NOTA: La vista correspondiente será aplicacion/vistas/perfil.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Helpers necesarios del proyecto
if (!function_exists('url')) {
    function url($ruta = '') {
        return '/' . ltrim($ruta, '/');
    }
}

if (!function_exists('requiere_login')) {
    function requiere_login() {
        if (empty($_SESSION['usuario'])) {
            header('Location: ' . url('login'));
            exit;
        }
    }
}

// Requerimos login para acceder aquí
requiere_login();

$id_usuario = $_SESSION['usuario']['id'] ?? null;
$correo_sesion = $_SESSION['usuario']['email'] ?? null;

// Cargar modelo de usuarios
$pathModelo = __DIR__ . '/../modelos/Modelo_usuario.php';
if (file_exists($pathModelo)) {
    include_once $pathModelo;
} else {
    error_log("Controlador_perfil: No se encuentra Modelo_usuario.php en {$pathModelo}");
}

// Asegurar conexión DB
global $conn;
if (empty($conn) && !empty($GLOBALS['conn'])) {
    $conn = $GLOBALS['conn'];
}

// CSRF Token
if (empty($_SESSION['_csrf_token'])) {
    $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
}
$token_csrf = $_SESSION['_csrf_token'];

// Obtener datos actuales del usuario
$datos_usuario = null;
if ($id_usuario) {
    if (function_exists('usuario_obtener_por_id')) {
        $datos_usuario = usuario_obtener_por_id($id_usuario);
    } else {
        if (!empty($conn)) {
            $sql = "SELECT id, nombre, email, rol, webpage, avatar FROM usuarios WHERE id = ? LIMIT 1";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param('i', $id_usuario);
                if ($stmt->execute()) {
                    $res = $stmt->get_result();
                    if ($res && $res->num_rows === 1) {
                        $datos_usuario = $res->fetch_assoc();
                    }
                }
                $stmt->close();
            }
        }
    }
}

// Si no hay datos por alguna razón:
if (!$datos_usuario) {
    $datos_usuario = [
        'id'      => $id_usuario,
        'nombre'  => $_SESSION['usuario']['name'] ?? '',
        'email'   => $_SESSION['usuario']['email'] ?? '',
        'rol'     => $_SESSION['usuario']['rol'] ?? 'cliente',
        'webpage' => '',
        'avatar'  => $_SESSION['usuario']['avatar'] ?? null
    ];
}

// Variables de vista
$error = null;
$exito = null;

// PROCESAR ENVÍO DEL FORMULARIO (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validar CSRF
    $token_recibido = $_POST['_csrf'] ?? '';
    if (!hash_equals($token_csrf, $token_recibido)) {
        http_response_code(400);
        $error = "Token CSRF inválido. Recarga la página.";
    } else {

        // Recoger datos enviados
        $nombre            = trim($_POST['nombre'] ?? '');
        $email             = trim($_POST['email'] ?? '');
        $pagina_personal   = trim($_POST['webpage'] ?? '');
        $nuevo_password    = $_POST['nuevo_password'] ?? '';
        $confirmacion_pass = $_POST['confirm_password'] ?? '';

        // Validaciones
        if ($nombre === '' || $email === '') {
            $error = "El nombre y el correo son obligatorios.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "El formato del correo no es válido.";
        } elseif (!empty($nuevo_password) && $nuevo_password !== $confirmacion_pass) {
            $error = "Las nuevas contraseñas no coinciden.";
        }

        // Procesar actualización si no hay errores
        if (!$error) {

            // Datos para actualizar
            $campos = [
                'nombre'  => $nombre,
                'email'   => $email,
                'webpage' => $pagina_personal,
            ];

            // --- Manejo del avatar ---
            if (!empty($_FILES['avatar']) && $_FILES['avatar']['error'] !== UPLOAD_ERR_NO_FILE) {
                $avatar = $_FILES['avatar'];
                $mime = mime_content_type($avatar['tmp_name'] ?? '');
                $validos = ['image/png', 'image/jpeg', 'image/webp'];

                if ($avatar['error'] !== UPLOAD_ERR_OK) {
                    $error = "Error al subir la imagen.";
                } elseif ($avatar['size'] > 2 * 1024 * 1024) {
                    $error = "El avatar no puede superar los 2MB.";
                } elseif (!in_array($mime, $validos)) {
                    $error = "Formato de imagen no permitido.";
                } else {
                    // Guardar
                    $ext = pathinfo($avatar['name'], PATHINFO_EXTENSION);
                    $nuevoNombre = "avatar_{$id_usuario}_" . time() . "." . $ext;
                    $ruta_destino = __DIR__ . "/../../publico/recursos/imagenes/avatares/{$nuevoNombre}";

                    if (!is_dir(dirname($ruta_destino))) {
                        @mkdir(dirname($ruta_destino), 0755, true);
                    }

                    if (move_uploaded_file($avatar['tmp_name'], $ruta_destino)) {
                        $campos['avatar'] = "publico/recursos/imagenes/avatares/{$nuevoNombre}";
                    } else {
                        $error = "No se pudo guardar el avatar.";
                    }
                }
            }

            // --- Cambio de contraseña ---
            if (!$error && !empty($nuevo_password)) {
                $campos['password'] = password_hash($nuevo_password, PASSWORD_DEFAULT);
            }

            // Guardar cambios
            $ok = false;
            if (function_exists('usuario_actualizar')) {
                try {
                    $ok = usuario_actualizar($id_usuario, $campos);
                } catch (Throwable $t) {
                    $ok = false;
                    error_log("Controlador_perfil: Error en usuario_actualizar(): " . $t->getMessage());
                }
            } elseif (!empty($conn)) {
                $partes = [];
                $tipos = "";
                $valores = [];

                foreach ($campos as $col => $val) {
                    $partes[] = "`$col` = ?";
                    $tipos   .= "s";
                    $valores[] = $val;
                }

                $sql = "UPDATE usuarios SET " . implode(", ", $partes) . " WHERE id = ? LIMIT 1";
                $tipos .= "i";
                $valores[] = $id_usuario;

                if ($stmt = $conn->prepare($sql)) {
                    $bind = [];
                    $bind[] = $tipos;
                    foreach ($valores as $i => $v) {
                        $bindVal = "param{$i}";
                        $$bindVal = $v;
                        $bind[] = &$$bindVal;
                    }
                    call_user_func_array([$stmt, 'bind_param'], $bind);
                    $ok = $stmt->execute();
                    $stmt->close();
                }
            }

            if ($ok) {
                // Actualizar datos de sesión
                foreach ($campos as $k => $v) {
                    if ($k === 'password') continue;
                    $_SESSION['usuario'][$k] = $v;
                }

                $exito = "Tu perfil ha sido actualizado correctamente.";
            } else {
                $error = "No se pudieron guardar los cambios.";
            }
        }
    }
}
