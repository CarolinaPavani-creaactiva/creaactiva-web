<!-- CSS de Contacto -->
<link rel="stylesheet" href="publico/recursos/css/mainStyles.css">

<main class="contacto-principal">

    <!-- Imagen de fondo -->
    <img src="publico/recursos/imagenes/interroganteForm3.jpg" alt="Fondo contacto" class="contacto-fondo-img">

    <section class="contacto-section">

        <div class="contacto-contenedor">

            <!-- FORMULARIO -->
            <div class="contacto-form">
                <iframe id="JotFormIFrame-253363021678861" 
                        title="Formulario de Contacto" 
                        allowtransparency="true"
                        allow="geolocation; microphone; camera; fullscreen; payment" 
                        frameborder="0"
                        style="width:100%; height:700px; border:none;" 
                        scrolling="no">
                </iframe>

                <!-- ============ AUTO-RESIZE + IDIOMA ============ -->
                <script>
                    document.addEventListener("DOMContentLoaded", () => {

                        const iframe = document.getElementById("JotFormIFrame-253363021678861");

                        // Idioma de tu web
                        let langWeb = localStorage.getItem("lang") || "es";

                        // Mapear valenciano (va) a catalán (ca) para JotForm
                        let langJotform = (langWeb === "va") ? "ca" : langWeb;

                        iframe.src = `https://creaactiva.jotform.com/253363021678861?language=${langJotform}`;
                    });

                    // AUTO-RESIZE OFICIAL DE JOTFORM
                    window.addEventListener("message", function (e) {
                        var iframe = document.getElementById("JotFormIFrame-253363021678861");

                        if (!iframe) return;

                        if (e.origin.indexOf("jotform.com") > -1) {
                            var args = e.data.split(":");
                            if (args[0] === "setHeight") {
                                iframe.style.height = args[1] + "px";
                            }
                        }
                    });
                </script>
            </div>

            <!-- CONTACTO DIRECTO -->
            <aside class="contacto-directo">
                <h3 data-i18n="contacto.titulo">Datos de Contacto</h3>

                <p class="subtitulo" data-i18n="contacto.oficina">Oficina</p>
                <p data-i18n="contacto.direccion.linea1">Carrer d'Alberola, 9</p>
                <p data-i18n="contacto.direccion.linea2">46013 Valencia, España</p>

                <a href="https://www.google.com/maps/dir/?api=1&destination=Carrer+d'Alberola+9+bajo+dcha+Quatre+Carreres+46013+Valencia"
                    target="_blank" data-i18n="contacto.comoLlegar">
                    Cómo llegar »
                </a>

                <p class="subtitulo" data-i18n="contacto.empresa">Empresa:</p>

                <p>
                    <a href="mailto:gestion@creactiva.com" class="correo-contacto" data-i18n="contacto.correo">
                        gestion@creactiva.com
                    </a>
                </p>

                <p data-i18n="contacto.telefono">+34 609 55 56 57</p>
            </aside>

        </div>
    </section>
</main>

<!-- Botón para subir arriba -->
<button id="btn-subir" title="Subir arriba" data-i18n="contacto.boton.subir">↑</button>

<!-- JS específico de la página -->
<script src="publico/recursos/js/botonArriba.js"></script>
