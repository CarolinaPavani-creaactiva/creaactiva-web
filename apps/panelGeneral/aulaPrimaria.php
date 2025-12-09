<?php
require_once '../includes/config.php';
require_once '../includes/authPanel.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
</head>
<body>
    <div class="container">
        <h1>Generar Seguimiento de Aula Primaria</h1>
        <hr />
        <form class="app" action="aulaPrimariaRun.php" method="post" enctype="multipart/form-data">
            Área<input type="text" name="area" required>
            Maestro/a<input type="text" name="maestro" required>
            Curso escolar<input type="text" name="curso" required>
            <br /><br />
            <button type="submit">Generar Programación Aula Primaria</button>
        </form>
    </div>
</body>
</html>