<!-- enlace al CSS -->
<link rel="stylesheet" href="<?= url('publico/recursos/css/footerStyles.css?v=2') ?>">

<footer class="f_footer">
    <div class="f_contenedor">

        <!-- COLUMNA 1: LOGO + INFO -->
        <div class="f_col">
            <h3 class="f_titulo" data-i18n="footer.col1.titulo">Crea Activa</h3>
            <p class="f_descripcion" data-i18n="footer.col1.descripcion">Consultoría educativa y formación digital</p>

            <ul class="f_enlaces f_enlaces-azules">
                <li><a href="#" data-i18n="footer.col1.avisoLegal">Aviso Legal</a></li>
                <li><a href="#" data-i18n="footer.col1.cookies">Política de cookies</a></li>
                <li><a href="#" data-i18n="footer.col1.gestiones">Sistema de gestiones</a></li>
            </ul>

            <div class="f_social">
                <a href="#">
                    <img src="<?= url('publico/recursos/imagenes/iconos/instagram.svg') ?>" alt="Instagram">
                </a>
                <a href="#">
                    <img src="<?= url('publico/recursos/imagenes/iconos/linkedin.svg') ?>" alt="LinkedIn">
                </a>
            </div>
        </div>

        <!-- COLUMNA 2 -->
        <div class="f_col">
            <h4 class="f_subtitulo" data-i18n="footer.col2.titulo">Departamentos</h4>
            <ul class="f_lista">
                <li><a href="<?= url('equipo') ?>" data-i18n="footer.col2.trabaja">Trabaja con nosotros</a></li>
                <li><a href="<?= url('blog') ?>" data-i18n="footer.col2.blog">Blog</a></li>
                <li><a href="<?= url('equipo') ?>" data-i18n="footer.col2.equipo">Equipo</a></li>
            </ul>
        </div>

        <!-- COLUMNA 3 -->
        <div class="f_col">
            <h4 class="f_subtitulo" data-i18n="footer.col3.titulo">Leer sobre</h4>
            <ul class="f_lista">
                <li><a href="<?= url('blog') ?>" data-i18n="footer.col3.tecnologia">Tecnología educativa</a></li>
                <li><a href="<?= url('blog') ?>" data-i18n="footer.col3.metodologia">Metodología e Innovación</a></li>
                <li><a href="<?= url('blog') ?>" data-i18n="footer.col3.gestion">Gestión y Liderazgo Educativo</a></li>
                <li><a href="<?= url('blog') ?>" data-i18n="footer.col3.formacion">Formación y Recursos</a></li>
            </ul>
        </div>

        <!-- COLUMNA 4 -->
        <div class="f_col">
            <h4 class="f_subtitulo" data-i18n="footer.col4.titulo">Soporte</h4>
            <ul class="f_lista">
                <li><a href="<?= url('contacto') ?>" data-i18n="footer.col4.contacto">Contacto</a></li>
                <li><a href="<?= url('contacto') ?>" data-i18n="footer.col4.soporte">Soporte</a></li>
            </ul>
        </div>

    </div>

    <!-- BARRA INFERIOR -->
    <div class="f_bottom">
        <p data-i18n="footer.bottom">© 2026 · Crea Activa Desarrollo y Gestión S.L.</p>
    </div>
</footer>

</html>