<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFS1AF.php") {
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
            <h2>CFS1AF</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1AF&modulo=PIAC&docente=Bruno%20Navarro" target="_blank"><li>PIAC</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1AF&modulo=GDJE&docente=Bruno%20Navarro" target="_blank"><li>GDJE</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1AF&modulo=RHRSC&docente=Elsa%20Tormo" target="_blank"><li>RHRSC</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1AF&modulo=CAC&docente=Nina%20Ortega" target="_blank"><li>CAC</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1AF&modulo=OPI&docente=Nina%20Ortega" target="_blank"><li>OPI</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1AF&modulo=Angl%C3%A9s%20profess.%20GS&docente=Alma%20Romero" target="_blank"><li>Anglés profess. GS</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1AF&modulo=IPO%20I&docente=Noa%20Villegas" target="_blank"><li>IPO I</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFS1AF&docente=Bruno%20Navarro" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>