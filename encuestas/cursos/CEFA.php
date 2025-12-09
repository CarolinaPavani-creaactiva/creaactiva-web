<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CEFA.php") {
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
            <h2>CEFA</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CEFA&modulo=TFA&docente=%C3%81lvaro%20Torres" target="_blank"><li>TFA</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CEFA&modulo=DAOF&docente=%C3%81lvaro%20Torres" target="_blank"><li>DAOF</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CEFA&modulo=MLI&docente=Sergio%20Beltr%C3%A1n" target="_blank"><li>MLI</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CEFA&modulo=E3D&docente=%C3%81lvaro%20Torres" target="_blank"><li>E3D</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CEFA&modulo=PP&docente=%C3%93scar%20Requena" target="_blank"><li>PP</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CEFA&modulo=MCF&docente=%C3%93scar%20Requena" target="_blank"><li>MCF</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CEFA&docente=%C3%93scar%20Requena%20Dorado" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>