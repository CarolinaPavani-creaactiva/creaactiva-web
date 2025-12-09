<?php
include_once __DIR__ . '/../../base_de_datos/base_de_datos.php';

function buscarUsuario($curso, $passkey_hash) {
    global $conn;

    $sql = "SELECT * FROM clavesCreaActivaEducacion WHERE CURSO = ? AND PASSKEY = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $curso, $passkey_hash);
    $stmt->execute();

    return $stmt->get_result();
}
