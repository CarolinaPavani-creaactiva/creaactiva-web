<?php
// aplicacion/funciones/auth.php
// Depende de $conn (mysqli) cargado por base_de_datos/base_de_datos.php

function auth_login($email, $password) {
    global $conn;
    $sql = "SELECT id, name, email, password, role FROM users WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();
    if (!$user) return false;

    // verificar password con password_verify()
    if (!password_verify($password, $user['password'])) {
        return false;
    }

    // limpiar password y guardar en sesión
    unset($user['password']);
    // regenerar id de sesión por seguridad
    session_regenerate_id(true);
    $_SESSION['user'] = $user;
    return true;
}

function auth_logout() {
    // limpiar sesión
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}

function auth_is_logged() {
    return !empty($_SESSION['user']);
}

function auth_user() {
    return $_SESSION['user'] ?? null;
}

function require_login() {
    if (!auth_is_logged()) {
        header('Location: index.php?page=login');
        exit;
    }
}

function require_admin() {
    if (!auth_is_logged() || (($_SESSION['user']['role'] ?? '') !== 'admin')) {
        header('Location: index.php?page=home');
        exit;
    }
}
