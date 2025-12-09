<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFB1SA.php") {
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
            <h2>CFB1SA</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB1SA&modulo=TID&docente=C.%20Mena%2FR.%20Ortega" target="_blank"><li>TID</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB1SA&modulo=TAB&docente=C.%20Mena%2FV.%20Cebri%C3%A1n" target="_blank"><li>TAB</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB1SA&modulo=AC&docente=Vera%20Cebri%C3%A1n" target="_blank"><li>AC</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB1SA&modulo=PPVP&docente=Nerea%20Vidal" target="_blank"><li>PPVP</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB1SA&modulo=Llengua%20extranjera&docente=Luc%C3%ADa%20Ferrer" target="_blank"><li>Llengua extranjera</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFB1SA&modulo=IPO%20I&docente=Noa%20Villegas" target="_blank"><li>IPO I</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFB1SA&docente=Celia%20Mena%20Torres" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>