<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFB2MV.php") {
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
            <h2>CFB2MV</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB2MV&modulo=Angl%C3%A9s%20II&docente=Luc%C3%ADa%20Ferrer" target="_blank"><li>Anglés II</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB2MV&modulo=FOL%20II&docente=Irene%20Roig" target="_blank"><li>FOL II</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB2MV&modulo=MBIEV&docente=H%C3%A9ctor%20Briones" target="_blank"><li>MBIEV</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB2MV&modulo=XE&docente=Clara%20Fuster" target="_blank"><li>XE</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFB2MV&docente=Clara%20Fuster%20Navarro" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>