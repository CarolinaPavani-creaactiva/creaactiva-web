<!-- CSS de servicios -->
<link rel="stylesheet" href="<?= url('publico/recursos/css/mainStyles.css') ?>">

<div class="home-fondo"></div>

<main class="servicios-principal">

    <!-- 1. CABECERA -->
    <section class="serviciosCabecera">
        <div class="serviciosCabecera-contenido">
            <div class="bloque-izquierda">
                <img src="<?= url('publico/recursos/imagenes/serviciosHead.jpg') ?>" alt="Servicios educativos"
                    data-i18n-alt="cabecera.alt">
            </div>
            <div class="bloque-derecha">
                <h1 data-i18n="cabecera.titulo">Nuestros servicios diseñados para tu éxito</h1>
                <p data-i18n="cabecera.descripcion">Ofrecemos soluciones integrales para la formación, gestión y
                    digitalización educativa.</p>
                <button class="btn-principal" data-i18n="cabecera.boton">
                    <!-- Si quieres que haga algo, poner <a href="<?= url('contacto') ?>">Consultar tarifas</a> -->
                    Consultar tarifas
                </button>
            </div>
        </div>
    </section>

    <div class="divisor-decorado"></div>

    <!-- 2. SECCIÓN COMPARATIVA -->
    <section class="seccion-comparativa">
        <h2 data-i18n="comparativa.titulo">¿Por qué elegir Crea Activa?</h2>
        <p data-i18n="comparativa.descripcion">Combinamos experiencia e innovación para ofrecer resultados que marcan la
            diferencia.</p>

        <div class="comparativa-grupo">
            <table class="tabla-comparativa">
                <thead>
                    <tr>
                        <th data-i18n="comparativa.tabla.servicio">Servicio</th>
                        <th data-i18n="comparativa.tabla.creaActiva">Crea Activa</th>
                        <th data-i18n="comparativa.tabla.otros">Otros proveedores</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-i18n="comparativa.items.consultoria">Consultoría educativa</td>
                        <td><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>" alt="Sí"
                                data-i18n-alt="comparativa.si"></td>
                        <td><img src="<?= url('publico/recursos/imagenes/iconos/cross.svg') ?>" alt="No"
                                data-i18n-alt="comparativa.no"></td>
                    </tr>
                    <tr>
                        <td data-i18n="comparativa.items.formacion">Formación profesional</td>
                        <td><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>" alt="Sí"
                                data-i18n-alt="comparativa.si"></td>
                        <td><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>" alt="Sí"
                                data-i18n-alt="comparativa.si"></td>
                    </tr>
                    <tr>
                        <td data-i18n="comparativa.items.digitalizacion">Digitalización de centros</td>
                        <td><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>" alt="Sí"
                                data-i18n-alt="comparativa.si"></td>
                        <td><img src="<?= url('publico/recursos/imagenes/iconos/cross.svg') ?>" alt="No"
                                data-i18n-alt="comparativa.no"></td>
                    </tr>
                    <tr>
                        <td data-i18n="comparativa.items.gestion">Gestión de proyectos</td>
                        <td><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>" alt="Sí"
                                data-i18n-alt="comparativa.si"></td>
                        <td><img src="<?= url('publico/recursos/imagenes/iconos/cross.svg') ?>" alt="No"
                                data-i18n-alt="comparativa.no"></td>
                    </tr>
                    <tr>
                        <td data-i18n="comparativa.items.soporte">Soporte continuo</td>
                        <td><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>" alt="Sí"
                                data-i18n-alt="comparativa.si"></td>
                        <td><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>" alt="Sí"
                                data-i18n-alt="comparativa.si"></td>
                    </tr>
                    <tr>
                        <td data-i18n="comparativa.items.asesoria">Asesoría personalizada</td>
                        <td><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>" alt="Sí"
                                data-i18n-alt="comparativa.si"></td>
                        <td><img src="<?= url('publico/recursos/imagenes/iconos/cross.svg') ?>" alt="No"
                                data-i18n-alt="comparativa.no"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <div class="divisor-decorado"></div>

    <!-- 3. SERVICIOS OFRECIDOS -->
    <section class="serviciosOfrecidos">
        <h2 data-i18n="ofrecidos.titulo">Servicios destacados</h2>
        <p data-i18n="ofrecidos.descripcion">Consulta los servicios más populares adaptados a tus necesidades.</p>

        <div class="tarjetas-servicios">

            <div class="tarjeta">
                <h4 data-i18n="ofrecidos.inicio.subtitulo">Inicio Educativo</h4>
                <h3 data-i18n="ofrecidos.inicio.titulo">Apoyo para nuevos centros</h3>
                <ul>
                    <li><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>"> <span
                            data-i18n="ofrecidos.inicio.item1">Evaluación inicial</span></li>
                    <li><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>"> <span
                            data-i18n="ofrecidos.inicio.item2">Herramientas de gestión</span></li>
                    <li><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>"> <span
                            data-i18n="ofrecidos.inicio.item3">Definición de misión y visión</span></li>
                </ul>
            </div>

            <div class="tarjeta">
                <h4 data-i18n="ofrecidos.impulso.subtitulo">Impulso Académico</h4>
                <h3 data-i18n="ofrecidos.impulso.titulo">Mejora del rendimiento</h3>
                <ul>
                    <li><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>"> <span
                            data-i18n="ofrecidos.impulso.item1">Plan de estudios optimizado</span></li>
                    <li><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>"> <span
                            data-i18n="ofrecidos.impulso.item2">Capacitación docente</span></li>
                    <li><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>"> <span
                            data-i18n="ofrecidos.impulso.item3">Estrategias de evaluación</span></li>
                </ul>
            </div>

            <div class="tarjeta">
                <h4 data-i18n="ofrecidos.digital.subtitulo">Transformación Digital</h4>
                <h3 data-i18n="ofrecidos.digital.titulo">Innovación tecnológica</h3>
                <ul>
                    <li><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>"> <span
                            data-i18n="ofrecidos.digital.item1">Integración de plataformas</span></li>
                    <li><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>"> <span
                            data-i18n="ofrecidos.digital.item2">Automatización de procesos</span></li>
                    <li><img src="<?= url('publico/recursos/imagenes/iconos/tick.svg') ?>"> <span
                            data-i18n="ofrecidos.digital.item3">Formación digital</span></li>
                </ul>
            </div>

        </div>

        <button class="btn-principal" data-i18n="ofrecidos.boton">Consultar disponibilidad</button>
    </section>

    <div class="divisor-decorado"></div>

    <!-- 4. TESTIMONIOS -->
    <section class="seccion-testimonios">
        <h2 data-i18n="testimonios.titulo">Testimonios</h2>
        <p data-i18n="testimonios.subtitulo">Lo que opinan nuestros clientes</p>

        <div class="carrusel-testimonios" id="carruselTestimonios">

            <div class="tarjeta-testimonio">
                <p data-i18n="testimonios.t1.txt">“Gracias a la consultoría de Crea Activa hemos digitalizado todo el
                    proceso académico sin estrés.”</p>
                <div class="datos">
                    <h4 data-i18n="testimonios.t1.nombre">María López</h4>
                    <p data-i18n="testimonios.t1.rol">Directora de Centro Educativo</p>
                </div>
            </div>

            <div class="tarjeta-testimonio">
                <p data-i18n="testimonios.t2.txt">“Las sesiones nos ayudaron a reorganizar la estructura interna y
                    optimizar la comunicación.”</p>
                <div class="datos">
                    <h4 data-i18n="testimonios.t2.nombre">Luis Serrano</h4>
                    <p data-i18n="testimonios.t2.rol">Coordinador Pedagógico</p>
                </div>
            </div>

            <div class="tarjeta-testimonio">
                <p data-i18n="testimonios.t3.txt">“Servicio impecable y muy humano.”</p>
                <div class="datos">
                    <h4 data-i18n="testimonios.t3.nombre">Clara Ruiz</h4>
                    <p data-i18n="testimonios.t3.rol">Formadora</p>
                </div>
            </div>

            <div class="tarjeta-testimonio">
                <p data-i18n="testimonios.t4.txt">“Nos acompañaron en cada paso.”</p>
                <div class="datos">
                    <h4 data-i18n="testimonios.t4.nombre">Andrés Pardo</h4>
                    <p data-i18n="testimonios.t4.rol">Gestor Educativo</p>
                </div>
            </div>

            <div class="tarjeta-testimonio">
                <p data-i18n="testimonios.t5.txt">“Totalmente recomendados.”</p>
                <div class="datos">
                    <h4 data-i18n="testimonios.t5.nombre">Elena Martín</h4>
                    <p data-i18n="testimonios.t5.rol">Responsable TIC</p>
                </div>
            </div>

            <div class="tarjeta-testimonio">
                <p data-i18n="testimonios.t6.txt">“Resultados desde el primer mes.”</p>
                <div class="datos">
                    <h4 data-i18n="testimonios.t6.nombre">David Ramos</h4>
                    <p data-i18n="testimonios.t6.rol">Consultor académico</p>
                </div>
            </div>

        </div>
    </section>

    <div class="divisor-decorado"></div>

    <!-- 5. CONTACTO -->
    <section class="seccion-contacto">
        <div class="contenedor-contacto">
            <h2 data-i18n="contacto.titulo">Contáctanos</h2>
            <p data-i18n="contacto.descripcion">
                ¿Tienes alguna pregunta o deseas más información? Completa el siguiente
                formulario y te responderemos pronto.
            </p>
        </div>

        <!-- FORMULARIO JOTFORM -->
        <div class="contenedor-formulario">
            <iframe id="JotFormIFrame-253241594028860" title="Contacto Web Crea Activa"
                onload="window.parent.scrollTo(0,0)" allowtransparency="true"
                allow="geolocation; microphone; camera; fullscreen; payment"
                src="https://creaactiva.jotform.com/253241594028860" frameborder="0"
                style="min-width:100%;max-width:100%;height:539px;border:none;" scrolling="no"></iframe>

            <script src="https://creaactiva.jotform.com/s/umd/latest/for-form-embed-handler.js"></script>
            <script>
                window.jotformEmbedHandler(
                    "iframe[id='JotFormIFrame-253241594028860']",
                    "https://creaactiva.jotform.com/"
                );
            </script>
        </div>
    </section>

    <!-- 6. COLABORADORES -->
    <section class="seccion-colaboradores">
        <h3 data-i18n="colaboradores.titulo">Nuestras licencias y colaboradores</h3>
    </section>

</main>

<button id="btn-subir" title="Subir arriba" data-i18n="boton.subir">↑</button>
<script src="publico/recursos/js/botonArriba.js"></script>