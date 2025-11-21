<!-- CSS del Blog -->
<link rel="stylesheet" href="publico/recursos/css/mainStyles.css">

<main class="blog-principal">
    <?php
    $vistaActual = "El Blog";
    include __DIR__ . '/mantenimiento.php';
    ?>

    <!-- Botón para subir arriba -->
    <button id="btn-subir" title="Subir arriba">↑</button>
</main>

<!-- JS específico de la página -->
<script src="publico/recursos/js/botonArriba.js"></script>
