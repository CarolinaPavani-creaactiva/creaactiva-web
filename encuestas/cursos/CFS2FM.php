<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFS2FM.php") {
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
            <h2>CFS2FM</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2FM&modulo=Angl%C3%A9s%20t%C3%A8cnic%20II&docente=Alma%20Romero" target="_blank"><li>Anglés tècnic II</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2FM&modulo=GQPRL&docente=Isaac%20Belda" target="_blank"><li>GQPRL</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2FM&modulo=MCN&docente=Nil%20Bosch" target="_blank"><li>MCN</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2FM&modulo=FPO&docente=Sergio%20Beltr%C3%A1n" target="_blank"><li>FPO</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2FM&modulo=PPR&docente=Tom%C3%A1s%20Aranda" target="_blank"><li>PPR</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2FM&modulo=EIE&docente=Irene%20Roig" target="_blank"><li>EIE</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFS2FM&docente=Sergio%20Beltr%C3%A1n" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>