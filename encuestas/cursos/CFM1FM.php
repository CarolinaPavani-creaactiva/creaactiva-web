<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFM1FM.php") {
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
            <h2>CFM1FM</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1FM&modulo=Angl%C3%A9s%20profess.%20GM&docente=Alma%20Romero" target="_blank"><li>Anglés profess. GM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1FM&modulo=IGR&docente=Tom%C3%A1s%20Aranda" target="_blank"><li>IGR</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1FM&modulo=EMM&docente=Samuel%20Luj%C3%A1n" target="_blank"><li>EMM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1FM&modulo=PMI&docente=Samuel%20Luj%C3%A1n" target="_blank"><li>PMI</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1FM&modulo=PMP&docente=Tom%C3%A1s%20Aranda" target="_blank"><li>PMP</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1FM&modulo=IPO%20I&docente=Valeria%20Alcina" target="_blank"><li>IPO I</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFM1FM&docente=Samuel%20Luj%C3%A1n%20Peris" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>