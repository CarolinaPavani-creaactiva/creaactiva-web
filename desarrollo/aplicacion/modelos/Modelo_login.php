<?php
// aplicacion/modelos/Modelo_login.php

$bdPathCandidates = [
    __DIR__ . '/../../base_de_datos/base_de_datos.php',
    __DIR__ . '/../base_de_datos/base_de_datos.php',
    __DIR__ . '/base_de_datos.php'
];

$incluido = false;
foreach ($bdPathCandidates as $p) {
    if (file_exists($p)) {
        include_once $p;
        $incluido = true;
        break;
    }
}
if (!$incluido) {
    error_log("Modelo_login: no se encontró base_de_datos.php en rutas esperadas. Asegúrate de definir \$conn.");
}

global $conn;
if (empty($conn) && !empty($GLOBALS['conn'])) {
    $conn = $GLOBALS['conn'];
}


//Buscar Usuario por CURSO y PASSKEY
function buscarUsuarioLegacy(string $curso, string $passkey_hash) {
    global $conn;
    if (empty($conn)) {
        error_log('buscarUsuarioLegacy: no hay conexión a BD');
        return false;
    }

    $sql = "SELECT * FROM clavesCreaActivaEducacion WHERE CURSO = ? AND PASSKEY = ? LIMIT 1";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ss', $curso, $passkey_hash);
        if (!$stmt->execute()) {
            error_log('buscarUsuarioLegacy execute error: ' . $stmt->error);
            $stmt->close();
            return false;
        }
        $res = $stmt->get_result();
        $stmt->close();
        return $res;
    } else {
        error_log('buscarUsuarioLegacy prepare error: ' . $conn->error);
        return false;
    }
}

//Buscar Usuario por correo
function buscarUsuarioPorCorreo(string $correo) {
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

// Obtener usuario por correo (devuelve array asociativo o null)
function obtenerUsuarioPorCorreo(string $correo) {
    $res = buscarUsuarioPorCorreo($correo);
    if ($res === false || $res === null) return null;
    if ($res->num_rows === 0) return null;
    return $res->fetch_assoc();
}

// Verificar credenciales por correo
function verificarCredencialesCorreo(string $correo, string $passwordPlain) {
    $usuario = obtenerUsuarioPorCorreo($correo);
    if (!$usuario) return null;

    $camposPosibles = ['password', 'pass', 'PASS', 'PASSKEY', 'passwd'];
    $hashEnDB = null;
    foreach ($camposPosibles as $c) {
        if (!empty($usuario[$c])) {
            $hashEnDB = $usuario[$c];
            break;
        }
    }
    if (!$hashEnDB) {
        error_log('verificarCredencialesCorreo: no se encontró campo password para usuario ' . $correo);
        return null;
    }

    $esModernHash = (strpos($hashEnDB, '$2y$') === 0 || strpos($hashEnDB, '$2b$') === 0 || strpos($hashEnDB, '$argon2') === 0);

    if ($esModernHash) {
        if (password_verify($passwordPlain, $hashEnDB)) {
            return $usuario;
        } else {
            return null;
        }
    } else {
        // Compatibilidad legacy: SHA1
        if (hash_equals(sha1($passwordPlain), $hashEnDB)) {
            // Re-hashear con password_hash y actualizar BD
            $nuevoHash = password_hash($passwordPlain, PASSWORD_DEFAULT);
            $userId = $usuario['id'] ?? null;
            if ($userId !== null) {
                $actualizado = actualizarHashUsuario($userId, $nuevoHash, 'id');
                if ($actualizado) {
                    error_log("verificarCredencialesCorreo: migrado hash a password_hash para user id={$userId}");
                    $usuario['password'] = $nuevoHash;
                } else {
                    error_log("verificarCredencialesCorreo: fallo al actualizar hash para user id={$userId}");
                }
            }
            return $usuario;
        } else {
            return null;
        }
    }
}

// Función para actualizar el hash de un usuario
function actualizarHashUsuario($userId, string $newHash, string $idColumn = 'id') {
    global $conn;
    if (empty($conn)) {
        error_log('actualizarHashUsuario: no hay conexion a BD');
        return false;
    }

    $sql = "UPDATE usuarios SET password = ? WHERE {$idColumn} = ? LIMIT 1";
    if ($stmt = $conn->prepare($sql)) {
        if (is_int($userId) || ctype_digit((string)$userId)) {
            $stmt->bind_param('si', $newHash, $userId);
        } else {
            $stmt->bind_param('ss', $newHash, $userId);
        }
        if (!$stmt->execute()) {
            error_log('actualizarHashUsuario execute error: ' . $stmt->error);
            $stmt->close();
            return false;
        }
        $stmt->close();
        return true;
    } else {
        error_log('actualizarHashUsuario prepare error: ' . $conn->error);
        return false;
    }
}
