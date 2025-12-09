<?php
require_once '../includes/funciones.php';
require_once '../includes/appheader.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>