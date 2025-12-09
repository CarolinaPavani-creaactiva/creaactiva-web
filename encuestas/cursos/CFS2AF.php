<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFS2AF.php") {
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
            <h2>CFS2AF</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2AF&modulo=GLC&docente=Nina%20Ortega" target="_blank"><li>GLC</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2AF&modulo=CFI&docente=Bruno%20Navarro" target="_blank"><li>CFI</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2AF&modulo=GRH&docente=Elsa%20Tormo" target="_blank"><li>GRH</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2AF&modulo=GFI&docente=Elsa%20Tormo" target="_blank"><li>GFI</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2AF&modulo=SEM&docente=Hugo%20Mar%C3%ADn" target="_blank"><li>SEM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFS2AF&modulo=Angl%C3%A9s%20t%C3%A8cnic%20II&docente=Alma%20Romero" target="_blank"><li>Anglés tècnic II</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFS2AF&docente=Hugo%20Bernat" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>