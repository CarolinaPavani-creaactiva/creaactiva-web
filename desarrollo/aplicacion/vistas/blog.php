<!-- CSS del Blog -->
<link rel="stylesheet" href="<?= url('publico/recursos/css/mainStyles.css') ?>">

<main class="blog-principal">
    <?php
    $vistaActual = "blog";
    include __DIR__ . '/mantenimiento.php';
    ?>

    <!-- Botón para subir arriba -->
    <button id="btn-subir" title="Subir arriba" data-i18n="blog.boton.subir">↑</button>
</main>

<!-- JS específico de la página -->
<script src="<?= url('publico/recursos/js/botonArriba.js') ?>"></script>