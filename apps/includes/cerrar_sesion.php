<?php
session_start();

if (!isset($_SESSION['autenticado'])) {
    header('Location: ../');
    exit;
}

$_SESSION = array();

session_destroy();

header('Location: ../');
exit;
?>
