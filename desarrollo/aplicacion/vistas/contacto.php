<!-- CSS de Contacto -->
<link rel="stylesheet" href="publico/recursos/css/mainStyles.css">

<main class="contacto-principal">
    <?php
    $vistaActual = "contacto";
    include __DIR__ . '/mantenimiento.php';
    ?>

    <!-- Botón para subir arriba -->
    <button id="btn-subir" title="Subir arriba" data-i18n="contacto.boton.subir">↑</button>
</main>

<!-- JS específico de la página -->
<script src="publico/recursos/js/botonArriba.js"></script>
