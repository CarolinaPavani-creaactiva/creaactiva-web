<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFM2GA.php") {
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
            <h2>CFM2GA</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2GA&modulo=OARH&docente=Celia%20Mena" target="_blank"><li>OARH</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2GA&modulo=EAU&docente=Valeria%20Serra" target="_blank"><li>EAU</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2GA&modulo=TDC&docente=Hugo%20Mar%C3%ADn" target="_blank"><li>TDC</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2GA&modulo=OAGT&docente=Lola%20Berm%C3%BAdez" target="_blank"><li>OAGT</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM2GA&modulo=Angl%C3%A9s%20t%C3%A8cnic%20II&docente=Luc%C3%ADa%20Ferrer" target="_blank"><li>Anglés tècnic II</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFM2GA&docente=Valeria%20Serra%20Molina" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>