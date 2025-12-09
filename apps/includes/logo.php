<?php
$centro = isset($_SESSION['centro']) ? htmlspecialchars(basename(mb_convert_encoding($_SESSION['centro'], 'UTF-8', 'auto'))) : 'default';

$centroDepurado = sustituyeEspacios($centro);
$logo = "../../logos/default.png";
if ($centro != "") $logo = "../../logos/".sustituyeEspacios($centro).".png";
?>