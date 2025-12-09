<!-- CSS de equipo -->
<link rel="stylesheet" href="publico/recursos/css/mainStyles.css">

<main class="equipo-principal">
    <?php
    $vistaActual = "equipo";
    include __DIR__ . '/mantenimiento.php';
    ?>

    <!-- Botón para subir arriba -->
    <button id="btn-subir" title="Subir arriba" data-i18n="equipo.boton.subir">↑</button>
</main>

<!-- JS específico de la página -->
<script src="publico/recursos/js/botonArriba.js"></script>
