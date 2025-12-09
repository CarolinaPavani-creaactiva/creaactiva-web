<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFB2SA.php") {
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
            <h2>CFB2SA</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB2SA&modulo=ABO&docente=Diana%20Segarra" target="_blank"><li>ABO</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB2SA&modulo=ARCO&docente=Gala%20Montes" target="_blank"><li>ARCO</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB2SA&modulo=Angl%C3%A9s%20II&docente=Luc%C3%ADa%20Ferrer" target="_blank"><li>Anglés II</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB2SA&modulo=FOL%20II&docente=Irene%20Roig" target="_blank"><li>FOL II</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFB2SA&docente=Gala%20Montes%20Soler" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>