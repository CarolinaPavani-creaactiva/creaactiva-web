<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pasar de PDF a Excel</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <img src="logo.png" width="100%"></img>
        <h2>Listado de alumnos [Ítaca] - VALENCIÀ</h2>
        <br />
        <form action="app1.php" method="post" enctype="multipart/form-data">
            <input type="file" name="pdf_file" accept="application/pdf" required>
            <button type="submit">Convertir a Excel</button>
        </form>
        <br /><hr />
        <h2>Horario Semanal (Prof-Materia) [Peñalara Software]</h2>
        <br />
        <form action="app2.php" method="post" enctype="multipart/form-data">
            <input type="file" name="pdf_file" accept="application/pdf" required>
            <button type="submit">Convertir a Excel</button>
        </form>
    </div>
</body>
</html>
