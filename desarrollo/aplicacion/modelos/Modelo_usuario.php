<?php
// aplicacion/modelos/Modelo_usuario.php

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
    error_log("Modelo_usuario: no se encontró base_de_datos.php en rutas esperadas.");
}

global $conn;
if (empty($conn) && !empty($GLOBALS['conn'])) {
    $conn = $GLOBALS['conn'];
}

// Obtener usuario por ID
function usuario_obtener_por_id($id) {
    global $conn;
    if (empty($conn)) {
        error_log('usuario_obtener_por_id: no hay conexión a BD');
        return null;
    }
    $sql = "SELECT * FROM usuarios WHERE id = ? LIMIT 1";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            error_log('usuario_obtener_por_id execute error: ' . $stmt->error);
            $stmt->close();
            return null;
        }
        $res = $stmt->get_result();
        $stmt->close();
        if ($res->num_rows === 1) return $res->fetch_assoc();
        return null;
    } else {
        error_log('usuario_obtener_por_id prepare error: ' . $conn->error);
        return null;
    }
}

// Buscar usuario por email
function usuario_buscar_por_email(string $email) {
    global $conn;
    if (empty($conn)) {
        error_log('usuario_buscar_por_email: no hay conexión a BD');
        return null;
    }
    $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $email);
        if (!$stmt->execute()) {
            error_log('usuario_buscar_por_email execute error: ' . $stmt->error);
            $stmt->close();
            return null;
        }
        $res = $stmt->get_result();
        $stmt->close();
        if ($res->num_rows === 1) return $res->fetch_assoc();
        return null;
    } else {
        error_log('usuario_buscar_por_email prepare error: ' . $conn->error);
        return null;
    }
}

// Actualizar datos de usuario
function usuario_actualizar($id, array $datos): bool {
    global $conn;
    if (empty($conn)) {
        error_log('usuario_actualizar: no hay conexión a BD');
        return false;
    }
    if (empty($datos)) return true;

    $cols = [];
    $vals = [];
    $types = '';
    foreach ($datos as $col => $val) {
        if (in_array(strtolower($col), ['id'])) continue;
        $cols[] = "`$col` = ?";
        $vals[] = $val;
        $types .= 's';
    }
    $sql = "UPDATE usuarios SET " . implode(', ', $cols) . " WHERE id = ? LIMIT 1";
    $types .= 'i';
    $vals[] = $id;

    if ($stmt = $conn->prepare($sql)) {
        $bind_names[] = $types;
        for ($i = 0; $i < count($vals); $i++) {
            $bind_name = 'bind' . $i;
            $$bind_name = $vals[$i];
            $bind_names[] = &$$bind_name;
        }
        call_user_func_array([$stmt, 'bind_param'], $bind_names);
        if (!$stmt->execute()) {
            error_log('usuario_actualizar execute error: ' . $stmt->error);
            $stmt->close();
            return false;
        }
        $stmt->close();
        return true;
    } else {
        error_log('usuario_actualizar prepare error: ' . $conn->error);
        return false;
    }
}

// Obtener todos los usuarios
function usuario_obtener_todos(): array {
    global $conn;
    $lista = [];
    if (empty($conn)) {
        error_log('usuario_obtener_todos: no hay conexión a BD');
        return $lista;
    }
    $sql = "SELECT id, nombre, email, rol, created_at FROM usuarios ORDER BY id DESC";
    if ($res = $conn->query($sql)) {
        while ($row = $res->fetch_assoc()) {
            $lista[] = $row;
        }
        $res->free();
    } else {
        error_log('usuario_obtener_todos query error: ' . $conn->error);
    }
    return $lista;
}

// Eliminar usuario por ID
function usuario_eliminar($id): bool {
    global $conn;
    if (empty($conn)) {
        error_log('usuario_eliminar: no hay conexión a BD');
        return false;
    }
    $sql = "DELETE FROM usuarios WHERE id = ? LIMIT 1";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            error_log('usuario_eliminar execute error: ' . $stmt->error);
            $stmt->close();
            return false;
        }
        $stmt->close();
        return true;
    } else {
        error_log('usuario_eliminar prepare error: ' . $conn->error);
        return false;
    }
}

// Crear nuevo usuario
function usuario_crear(array $datos) {
    global $conn;
    if (empty($conn)) {
        error_log('usuario_crear: no hay conexión a BD');
        return false;
    }
    $permitidos = ['nombre', 'email', 'password', 'rol', 'avatar', 'webpage'];
    $cols = [];
    $vals = [];
    $types = '';
    foreach ($permitidos as $c) {
        if (isset($datos[$c])) {
            $cols[] = "`$c`";
            $vals[] = $datos[$c];
            $types .= 's';
        }
    }
    if (empty($cols)) {
        error_log('usuario_crear: no hay campos para insertar');
        return false;
    }

    $placeholders = implode(', ', array_fill(0, count($cols), '?'));
    $sql = "INSERT INTO usuarios (" . implode(', ', $cols) . ") VALUES ({$placeholders})";
    if ($stmt = $conn->prepare($sql)) {
        $bind = [];
        $bind[] = $types;
        for ($i = 0; $i < count($vals); $i++) {
            $name = "p{$i}";
            $$name = $vals[$i];
            $bind[] = &$$name;
        }
        call_user_func_array([$stmt, 'bind_param'], $bind);
        if (!$stmt->execute()) {
            error_log('usuario_crear execute error: ' . $stmt->error);
            $stmt->close();
            return false;
        }
        $newId = $stmt->insert_id;
        $stmt->close();
        return $newId;
    } else {
        error_log('usuario_crear prepare error: ' . $conn->error);
        return false;
    }
}
