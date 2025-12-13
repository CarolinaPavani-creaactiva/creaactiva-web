<?php
// Modelo_login.php
// Funciones simples para gestionar usuarios

function crear_usuario(PDO $pdo, string $email, string $password, string $nombre = '', string $rol = 'usuario') {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO usuarios (email, password_hash, nombre, rol) VALUES (:email, :hash, :nombre, :rol)');
    return $stmt->execute(['email'=>$email,'hash'=>$hash,'nombre'=>$nombre,'rol'=>$rol]);
}

function obtener_usuario_por_email(PDO $pdo, string $email) {
    $stmt = $pdo->prepare('SELECT id, email, password_hash, nombre, rol FROM usuarios WHERE email = :email LIMIT 1');
    $stmt->execute(['email'=>$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
