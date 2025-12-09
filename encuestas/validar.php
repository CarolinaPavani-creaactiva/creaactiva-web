<?php
session_start();
$claveIngresada = sha1($_POST['clave']) ?? '';

$mysqli = new mysqli('qzv741.creaactiva.es', 'qalc676', 'CreaActiva12102008', 'qzv741');
if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
}

$stmt = $mysqli->prepare('SELECT WEBPAGE FROM clavesCreaActivaEducacion WHERE PASSKEY = ?');
$stmt->bind_param('s', $claveIngresada);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $fila = $result->fetch_assoc();
    $paginaRedirigir = $fila['WEBPAGE'];

    $_SESSION['autenticado'] = true;
    $_SESSION['pagina'] = $paginaRedirigir; // OPCIONAL guardar la página en sesión

    header("Location: $paginaRedirigir");
    exit;
} else {
    header("Location: index.php?error=clave_incorrecta");
    exit;
}
?>