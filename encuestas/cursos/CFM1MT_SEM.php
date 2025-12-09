<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFM1MT_SEM.php") {
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
            <h2>CFM1MT_SEM</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1MT_SEM&modulo=Angl%C3%A9s%20profess.%20GM&docente=Luc%C3%ADa%20Ferrer" target="_blank"><li>Anglés profess. GM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1MT_SEM&modulo=IPO%20I&docente=Irene%20Roig" target="_blank"><li>IPO I</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1MT_SEM&modulo=TUM&docente=Adri%C3%A1n%20Mateu" target="_blank"><li>TUM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1MT_SEM&modulo=APH&docente=Leo%20Berenguer" target="_blank"><li>APH</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1MT_SEM&modulo=TFA&docente=Iker%20Lozano" target="_blank"><li>TFA</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1MT_SEM&modulo=EAE&docente=%C3%81lex%20Medina" target="_blank"><li>EAE</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFM1MT_SEM&docente=Iker%20Lozano%20Ortega" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>