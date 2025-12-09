<?php
if (!isset($vistaActual)) {
    $vistaActual = "esta sección";
}
?>

<div class="mnto_wrapper">
    <div class="mnto_container">

        <h2 class="mnto_titulo">
            <span data-i18n="mantenimiento.estasEn">Estás en</span>
            <b><?= htmlspecialchars($vistaActual) ?></b><br>
            <span data-i18n="mantenimiento.enMantenimiento">Actualmente está en mantenimiento</span>
        </h2>

        <p class="mnto_subtitulo" data-i18n="mantenimiento.subtitulo">
            Estamos trabajando para mejorar tu experiencia
        </p>

        <p class="mnto_descripcion" data-i18n="mantenimiento.descripcion">
            Actualmente estamos realizando mejoras en nuestro sitio web. Volveremos pronto con nuevas funcionalidades y una mejor experiencia para ti.
        </p>

        <div class="mnto_update_section">
            <div class="mnto_update_icon">🔄</div>
            <p class="mnto_update_title" data-i18n="mantenimiento.ultimaActualizacion">Última actualización</p>
            <p class="mnto_update_time">20/11/2025</p>
        </div>

        <div class="mnto_image_box">
            <img class="mnto_imagen"
                 src="<?= url('publico/recursos/imagenes/mantenimientoP.jpg') ?>"
                 alt="Programación en pantalla"
                 data-i18n="mantenimiento.altImagen"
                 data-i18n-attr="alt">
        </div>

        <div class="mnto_contact_box">
            <span data-i18n="mantenimiento.necesitasAyuda">¿Necesitas ayuda urgente?</span>
            <br>
            <span data-i18n="mantenimiento.contactanos">Contáctanos en</span>
            <a href="mailto:creactiva@creactiva.es">creactiva@creactiva.es</a>
        </div>

        <p class="mnto_footer" data-i18n="mantenimiento.gracias">
            Gracias por tu paciencia y comprensión
        </p>

    </div>
</div>
