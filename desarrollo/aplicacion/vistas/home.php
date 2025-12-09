<!-- enlace al CSS  -->
<link rel="stylesheet" href="<?= url('publico/recursos/css/mainStyles.css') ?>">

<div class="home-fondo"></div>

<main class="home-principal">

    <!-- ===== SECCIÓN CABECERA ===== -->
    <section class="cabecera">
        <div class="cabecera-contenido">
            <div class="caja-azul-claro">
                <div class="caja-azul-oscuro">
                    <img src="<?= url('publico/recursos/imagenes/cabecera_inicio.jpg') ?>" alt="Servicios educativos">
                    <div class="texto-hero">
                        <h1 data-i18n="home.hero.title">Nuestros servicios diseñados para tu éxito</h1>
                        <p data-i18n="home.hero.subtitle">Soluciones creativas adaptadas a tus necesidades.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SECCIÓN PRESENTACIÓN ===== -->
    <section class="seccion-presentacion">
        <div class="contenedor-presentacion">

            <small class="titulo-seccion" data-i18n="home.presentation.section_title">Nosotros</small>

            <div class="bloque-texto">
                <div class="titulo-bloque">
                    <h2 data-i18n="home.presentation.title">Nuestro compromiso con la innovación educativa</h2>
                    <p data-i18n="home.presentation.text">
                        Ofrecemos soluciones personalizadas que impulsan la transformación digital y pedagógica.
                    </p>
                    <button class="btn-principal">
                        <a data-i18n="home.presentation.button" href="<?= url('equipo') ?>"
                            class="btn-principal">Conócenos</a>
                    </button>
                </div>

                <!-- TARJETAS -->
                <div class="bloque-tarjetas">
                    <div class="tarjeta">
                        <img src="<?= url('publico/recursos/imagenes/iconos/consultoria.svg') ?>"
                            alt="Consultoría educativa">
                        <h3 data-i18n="home.cards.1.title">Consultoría educativa</h3>
                        <p data-i18n="home.cards.1.text">
                            Ayudamos a centros y organizaciones a adaptarse a nuevas exigencias tecnológicas.
                        </p>
                    </div>

                    <div class="tarjeta">
                        <img src="<?= url('publico/recursos/imagenes/iconos/formacion.svg') ?>"
                            alt="Formación profesional">
                        <h3 data-i18n="home.cards.2.title">Formación profesional</h3>
                        <p data-i18n="home.cards.2.text">
                            Ofrecemos cursos y talleres prácticos orientados a docentes y directivos.
                        </p>
                    </div>

                    <div class="tarjeta">
                        <img src="<?= url('publico/recursos/imagenes/iconos/tecnologia.svg') ?>"
                            alt="Digitalización y tecnología">
                        <h3 data-i18n="home.cards.3.title">Digitalización y tecnología</h3>
                        <p data-i18n="home.cards.3.text">
                            Implementamos herramientas digitales para impulsar la innovación educativa.
                        </p>
                    </div>

                    <div class="tarjeta">
                        <img src="<?= url('publico/recursos/imagenes/iconos/idea.svg') ?>"
                            alt="Proyectos personalizados">
                        <h3 data-i18n="home.cards.4.title">Proyectos personalizados</h3>
                        <p data-i18n="home.cards.4.text">
                            Diseñamos estrategias y proyectos alineados con tus objetivos.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bloque-imagen-final">
                <img src="<?= url('publico/recursos/imagenes/clase_Inicio.jpg') ?>" alt="Equipo educativo">
            </div>
        </div>
    </section>

    <div class="divisor-decorado"></div>

    <!-- ===== BLOG ===== -->
    <section class="seccion-blog">
        <div class="blog-contenido">
            <div class="blog-texto">
                <h2 data-i18n="home.blog.title">Impulsa tu centro o empresa educativa</h2>
                <p data-i18n="home.blog.text">
                    En Crea Activa unimos experiencia, innovación y soluciones personalizadas.
                </p>
            </div>

            <div class="blog-lista">
                <div class="blog-item">
                    <span class="numero">01</span>
                    <span data-i18n="home.blog.item1">
                        Transformamos tus procesos educativos y formativos.
                    </span>
                </div>

                <div class="blog-item">
                    <span class="numero">02</span>
                    <span data-i18n="home.blog.item2">
                        Cursos y talleres prácticos que puedes aplicar de inmediato.
                    </span>
                </div>

                <div class="blog-item">
                    <span class="numero">03</span>
                    <span data-i18n="home.blog.item3">
                        Herramientas digitales que mejoran la gestión y comunicación.
                    </span>
                </div>

                <div class="blog-item">
                    <span class="numero">04</span>
                    <span data-i18n="home.blog.item4">
                        Acompañamiento constante y resultados medibles.
                    </span>
                </div>
            </div>

            <a href="<?= url('blog') ?>" class="blog-btn" data-i18n="home.blog.button">Consulta nuestro blog</a>
        </div>
    </section>

    <div class="divisor-decorado"></div>

    <!-- ===== ESENCIA ===== -->
    <section class="seccion-esencia">
        <div class="esencia-texto">
            <h2 data-i18n="home.essence.title">Nuestra Esencia</h2>
            <p data-i18n="home.essence.text">
                Un compromiso constante con la mejora de la calidad educativa.
            </p>
        </div>

        <div class="esencia-tarjetas">

            <div class="fila-superior">

                <div class="esencia-tarjeta">
                    <h3 class="titulo-fondo" data-i18n="home.mission.title">Misión</h3>
                    <img src="<?= url('publico/recursos/imagenes/iconos/mision.png') ?>" alt="Misión">
                    <h4 data-i18n="home.mission.question">¿Cuál es nuestro propósito?</h4>
                    <p data-i18n="home.mission.text">
                        Contribuimos a la mejora de la calidad educativa y el desarrollo eficiente.
                    </p>
                </div>

                <div class="esencia-tarjeta">
                    <h3 class="titulo-fondo" data-i18n="home.values.title">Valores</h3>
                    <img src="<?= url('publico/recursos/imagenes/iconos/valores.png') ?>" alt="Valores">
                    <h4 data-i18n="home.values.question">¿Qué nos guía?</h4>
                    <p data-i18n="home.values.text">
                        Compromiso, transparencia, confianza y mejora continua.
                    </p>
                </div>

            </div>

            <div class="fila-inferior">
                <div class="esencia-tarjeta grande tarjeta-vision">
                    <h3 class="titulo-fondo" data-i18n="home.vision.title">Visión</h3>
                    <img src="<?= url('publico/recursos/imagenes/iconos/vision.png') ?>" alt="Visión">
                    <h4 data-i18n="home.vision.question">
                        ¿Qué principios orientan nuestras aspiraciones?
                    </h4>

                    <div class="vision-columnas">

                        <div class="columna">
                            <span class="numero">01</span>
                            <p data-i18n="home.vision.item1">
                                Convertirnos en un elemento esencial para nuestros clientes.
                            </p>
                        </div>

                        <div class="columna">
                            <span class="numero">02</span>
                            <p data-i18n="home.vision.item2">
                                Facilitar el día a día simplificando procesos y mejorando la calidad.
                            </p>
                        </div>

                        <div class="columna">
                            <span class="numero">03</span>
                            <p data-i18n="home.vision.item3">
                                Ser un excelente lugar para trabajar, donde las personas se inspiren.
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="divisor-decorado"></div>

    <!-- ===== MAPA ===== -->
    <section class="seccion-mapa">
        <div class="mapa-contenedor">

            <div class="mapa-info">
                <h2 data-i18n="home.map.title">¿Dónde encontrarnos?</h2>
                <p class="direccion" data-i18n="home.map.address">Calle Alberola Nº9, Valencia, España</p>
                <p class="horario" data-i18n="home.map.schedule">Horario de atención: Lunes a Viernes 09:00–13:00</p>
                <p class="soporte" data-i18n="home.map.support">Nuestro soporte online estará disponible 24/7</p>
                <button class="btn-contacto">
                    <a href="<?= url('equipo') ?>" class="btn-principal" data-i18n="home.map.button">Contáctanos</a>
                </button>
            </div>

            <div class="mapa-google">
                <iframe src="https://www.google.com/maps/embed?pb=..." width="100%" height="100%" style="border:0;"
                    allowfullscreen loading="lazy"></iframe>
            </div>

        </div>
    </section>

    <div class="divisor-decorado"></div>

    <!-- COLABORADORES -->
    <section class="seccion-colaboradores">
        <h3 data-i18n="home.partners.title">Asociaciones y entidades colaboradoras</h3>

        <div class="logos-scroll">
            <div class="logos-colaboradores">
                <img src="<?= url('publico/recursos/imagenes/entidades/EntidadPrueba1.png') ?>" alt="Colaborador 1">
                <img src="<?= url('publico/recursos/imagenes/entidades/EntidadPrueba2.png') ?>" alt="Colaborador 2">
                <img src="<?= url('publico/recursos/imagenes/entidades/EntidadPrueba3.png') ?>" alt="Colaborador 3">
                <img src="<?= url('publico/recursos/imagenes/entidades/EntidadPrueba1.png') ?>" alt="Colaborador 4">
                <img src="<?= url('publico/recursos/imagenes/entidades/EntidadPrueba2.png') ?>" alt="Colaborador 5">
            </div>
        </div>
    </section>

    <!-- SUBIR -->
    <button id="btn-subir" title="Subir arriba" data-i18n="home.button.up">↑</button>

</main>

<script src="<?= url('publico/recursos/js/botonArriba.js') ?>"></script>