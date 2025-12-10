<?php
// aplicacion/modelos/Modelo_login.php

$baseDbPath = __DIR__ . '/../../base_de_datos/base_de_datos.php';
if (!file_exists($baseDbPath)) {
   
    $baseDbPath = __DIR__ . '/../base_de_datos/base_de_datos.php';
}
if (file_exists($baseDbPath)) {
    include_once $baseDbPath;
} else {
    
    error_log("Modelo_login: no se ha encontrado base_de_datos.php en rutas esperadas");
}

global $conn;
if (empty($conn) && !empty($GLOBALS['conn'])) {
    $conn = $GLOBALS['conn'];
}

/**
 * Buscar usuario por CURSO y PASSKEY en tabla clavesCreaActivaEducacion.
 * @param string $curso
 * @param string $passkey_hash
 * @return mysqli_result|false|null
 */
function buscarUsuario($curso, $passkey_hash) {
    global $conn;
    if (empty($conn)) {
        error_log('buscarUsuario: no hay conexión a BD');
        return false;
    }

   
    $sql = "SELECT * FROM clavesCreaActivaEducacion WHERE CURSO = ? AND PASSKEY = ? LIMIT 1";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ss', $curso, $passkey_hash);
        if (!$stmt->execute()) {
            error_log('buscarUsuario execute error: ' . $stmt->error);
            $stmt->close();
            return false;
        }
        $res = $stmt->get_result();
        $stmt->close();
        return $res;
    } else {
        error_log('buscarUsuario prepare error: ' . $conn->error);
        return false;
    }
}

/**
 * Buscar usuario por correo (devuelve mysqli_result).
 * @param string $correo
 * @return mysqli_result|false|null
 */
function buscarUsuarioPorCorreo($correo) {
    global $conn;
    if (empty($conn)) {
        error_log('buscarUsuarioPorCorreo: no hay conexión a BD');
        return false;
    }

    
    $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $correo);
        if (!$stmt->execute()) {
            error_log('buscarUsuarioPorCorreo execute error: ' . $stmt->error);
            $stmt->close();
            return false;
        }
        $res = $stmt->get_result();
        $stmt->close();
        return $res;
    } else {
        error_log('buscarUsuarioPorCorreo prepare error: ' . $conn->error);
        return false;
    }
}

/**
 * Obtener usuario por correo (devuelve array asociativo o null).
 * @param string $correo
 * @return array|null
 */
function obtenerUsuarioPorCorreo($correo) {
    $res = buscarUsuarioPorCorreo($correo);
    if ($res === false || $res === null) return null;
    if ($res->num_rows === 0) return null;
    return $res->fetch_assoc();
}

/**
 * Verificar credenciales por correo + password en servidor.
 * - Obtiene el registro por correo
 * - Intenta password_verify($password, $hashEnBD)
 * - Si pasa, devuelve el usuario (assoc). Si no, devuelve null.
 * @param string $correo
 * @param string $passwordPlain
 * @return array|null
 */
function verificarCredencialesCorreo($correo, $passwordPlain) {
    global $conn;
    $usuario = obtenerUsuarioPorCorreo($correo);
    if (!$usuario) return null;

    $possibleFields = ['password', 'pass', 'PASS', 'PASSKEY', 'passwd'];
    $hashEnDB = null;
    foreach ($possibleFields as $f) {
        if (isset($usuario[$f]) && !empty($usuario[$f])) {
            $hashEnDB = $usuario[$f];
            break;
        }
    }

    if (!$hashEnDB) {
        error_log('verificarCredencialesCorreo: no se encontró campo password en registro usuario: ' . json_encode(array_keys($usuario)));
        return null;
    }

    // Como el hash en DB es un hash moderno (password_hash), usamos password_verify
    $isModernHash = (strpos($hashEnDB, '$2y$') === 0 || strpos($hashEnDB, '$2b$') === 0 || strpos($hashEnDB, '$argon2') === 0);

    if ($isModernHash) {
        if (password_verify($passwordPlain, $hashEnDB)) {
            return $usuario;
        } else {
            return null;
        }
    } else {
        if (hash_equals(sha1($passwordPlain), $hashEnDB)) {
            return $usuario;
        } else {
            return null;
        }
    }
}

/**
 * Función para actualizar el hash de un usuario (migración a password_hash).
 * @param int|string $userId
 * @param string $newHash  (resultado de password_hash)
 * @param string $idColumn (nombre de columna id, por defecto 'id')
 * @return bool
 */
function actualizarHashUsuario($userId, $newHash, $idColumn = 'id') {
    global $conn;
    if (empty($conn)) return false;

    $sql = "UPDATE usuarios SET password = ? WHERE {$idColumn} = ? LIMIT 1";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('si', $newHash, $userId);
        if (!$stmt->execute()) {
            error_log('actualizarHashUsuario execute error: ' . $stmt->error);
            $stmt->close();
            return false;
        }
        $affected = $stmt->affected_rows;
        $stmt->close();
        return ($affected >= 0);
    } else {
        error_log('actualizarHashUsuario prepare error: ' . $conn->error);
        return false;
    }
}

