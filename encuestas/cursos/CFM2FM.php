<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFM2FM.php") {
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
            <h2>CFM2FM</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2FM&modulo=Angl%C3%A9s%20t%C3%A8cnic%20II&docente=Javier%20Sol%C3%ADs" target="_blank"><li>Anglés tècnic II</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2FM&modulo=CEO&docente=%C3%93scar%20Requena" target="_blank"><li>CEO</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2FM&modulo=MEN&docente=Nerea%20Gallego" target="_blank"><li>MEN</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2FM&modulo=CET&docente=Adri%C3%A1n%20Mateu" target="_blank"><li>CET</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2FM&modulo=EIE&docente=Noa%20Villegas" target="_blank"><li>EIE</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFM2FM&docente=Nerea%20Gallego%20Mu%C3%B1oz" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>