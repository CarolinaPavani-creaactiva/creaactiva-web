<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFS2MC.php") {
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
            <h2>CFS2MC</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2MC&modulo=Angl%C3%A9s%20t%C3%A8cnic%20II&docente=Alma%20Romero" target="_blank"><li>Anglés tècnic II</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2MC&modulo=EIE&docente=Irene%20Roig" target="_blank"><li>EIE</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2MC&modulo=IS&docente=Gabriel%20Monz%C3%B3" target="_blank"><li>IS</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2MC&modulo=CSM&docente=%C3%81lvaro%20Torres" target="_blank"><li>CSM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2MC&modulo=PGMQ&docente=Julia%20Morell" target="_blank"><li>PGMQ</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2MC&modulo=SSM&docente=Eric%20Roca" target="_blank"><li>SSM</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFS2MC&docente=Eric%20Roca%20Ventura" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>