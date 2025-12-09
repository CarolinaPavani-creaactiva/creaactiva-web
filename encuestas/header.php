<?php
echo '<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">';
echo '<link href="styles.css" rel="stylesheet">';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Crea Activa</title>';
if (isset($_GET['error']) && $_GET['error'] === 'clave_incorrecta') {
    echo "<script>alert('Clau incorrecta. Per favor, intenta-ho de nou.');</script>";
}
?>