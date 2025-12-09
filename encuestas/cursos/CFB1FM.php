<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFB1FM.php") {
    header('Location: ../index.php');
    exit;
}
?>
        <!DOCTYPE html>
    <html lang="es">
    <head>
        <?php include 'header.php'; ?>
    </head>
    <body>
        <div class="container">
            <img src="../logo.png" width="80%"></img>
            <br />
            <h1></h1>
            <h2>CFB1FM</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB1FM&modulo=Llengua%20extranjera&docente=Luc%C3%ADa%20Ferrer" target="_blank"><li>Llengua extranjera</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB1FM&modulo=IPO%20I&docente=Noa%20Villegas" target="_blank"><li>IPO I</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB1FM&modulo=CAPVC&docente=H%C3%A9ctor%20Briones" target="_blank"><li>CAPVC</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB1FM&modulo=SCM&docente=Clara%20Fuster" target="_blank"><li>SCM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB1FM&modulo=OBF&docente=Iker%20Lozano" target="_blank"><li>OBF</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFB1FM&docente=H%C3%A9ctor%20Briones%20Molina" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>