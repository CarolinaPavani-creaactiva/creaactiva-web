<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFM2MT.php") {
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
            <h2>CFM2MT</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2MT&modulo=Angl%C3%A9s%20t%C3%A8cnic%20II&docente=Javier%20Sol%C3%ADs" target="_blank"><li>Anglés tècnic II</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2MT&modulo=EIE&docente=Valeria%20Alcina" target="_blank"><li>EIE</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2MT&modulo=MMLA&docente=Leo%20Berenguer" target="_blank"><li>MMLA</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2MT&modulo=MMM&docente=Mateo%20Soria" target="_blank"><li>MMM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2MT&modulo=MME&docente=Pau%20Blanch" target="_blank"><li>MME</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFM2MT&docente=Mateo%20Soria%20Vidal" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>