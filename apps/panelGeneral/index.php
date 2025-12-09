<?php
require_once '../includes/config.php';
require_once '../includes/logo.php';
require_once '../includes/authPanel.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="modal.js"></script>
</head>
<body>
    <div class="menu">
        <span class="nombre"><h3><?php echo $centro?></h3></span>
        <span class="banner"><img src="<?php echo $logo?>" width="100%" /></span>
        <div class="list">
            <a href="javascript:void(0);" onclick="cargarContenido('aulaPrimaria.php')"><?= $texts["app1"] ?></a>
            <a href="javascript:void(0);" onclick="cargarContenido('seguimiento.php')"><?= $texts["app2"] ?></a>
            <a href="javascript:void(0);" onclick="cargarContenido('otro.php')">. . .</a>
        </div>
        <div class="settings">
            <form action="../includes/cerrar_sesion.php" method="POST">
                <button type="button" id="openModal"><img src="../img/informacion.png" /></button>
                    <div id="appModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <p>Este es un modal</p>
                        </div>
                    </div>
                <button type="button" onclick="cambiarIdioma()"><img src="../img/idioma.png" /></button>
                <button type="submit"><img src="../img/cerrar_sesion.png" /></button>
            </form>
        </div>
    </div>

    <div id="contenido">
        <h2><?= $texts["welcome"] ?></h2>
        <p><?= $texts["choose"] ?></p>
    </div>
    
<script>
function cargarContenido(pagina) {
    $.ajax({
        url: pagina,
        type: 'GET',
        success: function(response) {
            $('#contenido').html(response);
        },
        error: function() {
            $('#contenido').html('<p><?= $texts["unimplemented"] ?></p>');
        }
    });
}

$(document).ready(function() {
    $("#menuToggle").click(function() {
        $(".menu .list").toggleClass("active");
    });
});

function cambiarIdioma() {
    let currentLang = new URLSearchParams(window.location.search).get("lang") || "es";
    let newLang = currentLang === "val" ? "es" : "val"; 
    window.location.href = "?lang=" + newLang;
}
</script>
</body>

</html>