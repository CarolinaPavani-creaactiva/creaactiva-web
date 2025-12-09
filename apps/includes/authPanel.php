<?php
if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "panelGeneral") {
    header('Location: ../');
    exit;
}
$lang = $_SESSION['lang'] ?? 'es';
$texts = include("../includes/$lang.php");
?>