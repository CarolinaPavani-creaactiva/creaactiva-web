<?php
session_start();
include_once "../modelo/login_modelo.php";

$curso = $_POST['curso'];
$passkey = $_POST['passkey'];

// Hash SHA1 igual que en tu BD
$passkey_hash = sha1($passkey);

// Llamar al modelo
$resultado = buscarUsuario($curso, $passkey_hash);

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    $_SESSION['curso'] = $usuario['CURSO'];

    // redirección a la ruta guardada en la BD
    header("Location: ../../" . $usuario['WEBPAGE']);
    exit;

} else {
    echo "❌ Curso o clave incorrectos";
}
