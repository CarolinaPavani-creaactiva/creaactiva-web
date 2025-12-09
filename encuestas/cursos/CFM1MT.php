<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFM1MT.php") {
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
            <h2>CFM1MT</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1MT&modulo=Angl%C3%A9s%20profess.%20GM&docente=Luc%C3%ADa%20Ferrer" target="_blank"><li>Anglés profess. GM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1MT&modulo=IPO%20I&docente=Valeria%20Alcina" target="_blank"><li>IPO I</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1MT&modulo=TUM&docente=Adri%C3%A1n%20Mateu" target="_blank"><li>TUM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1MT&modulo=APH&docente=F.%20Olmos%2FN.%20Gallego" target="_blank"><li>APH</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1MT&modulo=TFA&docente=Jordi%20Almenar" target="_blank"><li>TFA</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1MT&modulo=EAE&docente=%C3%81lex%20Medina" target="_blank"><li>EAE</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFM1MT&docente=Jordi%20Almenar%20Ribes" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>