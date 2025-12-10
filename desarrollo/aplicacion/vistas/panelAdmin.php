<?php
require_admin();
?>
<main style="padding:24px;">
    <h1>Panel de administración</h1>
    <p>Bienvenido, <?= htmlspecialchars($_SESSION["usuario"]["nombre"]) ?>.</p>
    <p><a href="<?= url('home') ?>">Volver al inicio</a></p>
</main>
