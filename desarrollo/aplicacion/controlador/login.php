<?php
// Controlador del login: aplicacion/controladores/login.php

require_once __DIR__ . '/../funciones/auth.php';

if (!empty($_SESSION['user'])) {
    header('Location: ' . url('profile'));
    exit;
}

// Si el formulario se envió - procesamos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        if (auth_login($email, $password)) {

            $role = $_SESSION['user']['role'] ?? 'client';

            if ($role === 'admin') {
                header('Location: ' . url('admin'));
            } else {
                header('Location: ' . url('profile'));
            }
            exit;
        } else {
            $error = "Credenciales incorrectas.";
        }
    } else {
        $error = "Rellena todos los campos.";
    }
}
