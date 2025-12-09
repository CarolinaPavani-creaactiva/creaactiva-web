<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFS1FM.php") {
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
            <h2>CFS1FM</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1FM&modulo=Angl%C3%A9s%20profess.%20GS&docente=Alma%20Romero" target="_blank"><li>Anglés profess. GS</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1FM&modulo=DPM&docente=Isaac%20Belda" target="_blank"><li>DPM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1FM&modulo=IGR&docente=Eric%20Roca" target="_blank"><li>IGR</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1FM&modulo=VPR&docente=Gabriel%20Monz%C3%B3" target="_blank"><li>VPR</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1FM&modulo=EPF&docente=Nil%20Bosch" target="_blank"><li>EPF</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1FM&modulo=PSAFM&docente=Dani%20Puig" target="_blank"><li>PSAFM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1FM&modulo=IPO%20I&docente=Irene%20Roig" target="_blank"><li>IPO I</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFS1FM&docente=Gabriel%20Monz%C3%B3%20Riera" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>