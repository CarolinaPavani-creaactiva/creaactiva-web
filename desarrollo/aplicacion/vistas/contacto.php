<!-- CSS de Contacto -->
<link rel="stylesheet" href="publico/recursos/css/mainStyles.css">

<main class="contacto-principal">

    <!-- Imagen de fondo desde HTML como pediste -->
    <img src="publico/recursos/imagenes/interroganteForm3.jpg" alt="Fondo contacto" class="contacto-fondo-img">

    <section class="contacto-section">

        <!-- Contenedor principal del formulario -->
        <div class="contacto-contenedor">

            <!-- FORMULARIO (PRINCIPAL) -->
            <div class="contacto-form">
                <iframe id="JotFormIFrame-253363021678861" title="Formulario de Contacto" allowtransparency="true"
                    allow="geolocation; microphone; camera; fullscreen; payment"
                    src="https://creaactiva.jotform.com/253363021678861" frameborder="0"
                    style="width:100%; height:700px; border:none;" scrolling="no"></iframe>

                <script src="https://creaactiva.jotform.com/s/umd/latest/for-form-embed-handler.js"></script>
                <script>
                    window.jotformEmbedHandler(
                        "iframe[id='JotFormIFrame-253363021678861']",
                        "https://creaactiva.jotform.com/"
                    );
                </script>
            </div>

            <!-- CONTACTO DIRECTO (arriba a la derecha) -->
            <aside class="contacto-directo">
                <h3>Datos de Contacto</h3>

                <p class="subtitulo">Oficina</p>
                <p>Carrer d'Alberola, 9</p>
                <p> 46013 Valencia, España</p>

                <a href="https://www.google.com/maps/dir/?api=1&destination=Carrer+d'Alberola+9+bajo+dcha+Quatre+Carreres+46013+Valencia"
                    target="_blank">
                    Cómo llegar »
                </a>

                <p class="subtitulo">Empresa:</p>
                <p>
                    <a href="mailto:gestion@creactiva.com" class="correo-contacto">
                        gestion@creactiva.com
                    </a>
                </p>

                <p>+34 609 55 56 57</p>
            </aside>


</main>

<!-- Botón para subir arriba -->
<button id="btn-subir" title="Subir arriba" data-i18n="contacto.boton.subir">↑</button>

<!-- JS específico de la página -->
<script src="publico/recursos/js/botonArriba.js"></script>