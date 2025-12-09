<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFS1MC.php") {
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
            <h2>CFS1MC</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1MC&modulo=Angl%C3%A9s%20profess.%20GS&docente=Alma%20Romero" target="_blank"><li>Anglés profess. GS</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1MC&modulo=IPO%20I&docente=Noa%20Villegas" target="_blank"><li>IPO I</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1MC&modulo=PFA&docente=Dani%20Puig" target="_blank"><li>PFA</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1MC&modulo=SHN&docente=Mateo%20Soria" target="_blank"><li>SHN</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1MC&modulo=EM&docente=Gabriel%20Monz%C3%B3" target="_blank"><li>EM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1MC&modulo=RGSM&docente=Dani%20Puig" target="_blank"><li>RGSM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1MC&modulo=SME&docente=Dani%20Puig" target="_blank"><li>SME</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS1MC&modulo=SEE&docente=Pau%20Blanch" target="_blank"><li>SEE</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFS1MC&docente=Pau%20Blanch%20Valls" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>