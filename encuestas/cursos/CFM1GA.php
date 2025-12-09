<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['pagina'] != "cursos/CFM1GA.php") {
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
            <h2>CFM1GA</h2>
            <hr>
            <ul>
                <a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1GA&modulo=EA&docente=Diana%20Segarra" target="_blank"><li>EA</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1GA&modulo=TC&docente=Lola%20Berm%C3%BAdez" target="_blank"><li>TC</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1GA&modulo=TII&docente=Nerea%20Vidal" target="_blank"><li>TII</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1GA&modulo=CEAC&docente=Gala%20Montes" target="_blank"><li>CEAC</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1GA&modulo=OACV&docente=Valeria%20Serra" target="_blank"><li>OACV</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1GA&modulo=Angl%C3%A9s%20profess.%20GM&docente=Javier%20Sol%C3%ADs" target="_blank"><li>Anglés profess. GM</li></a><a href="https://creaactiva.jotform.com/251421061867858?grupo=CFM1GA&modulo=IPO%20I&docente=Valeria%20Alcina" target="_blank"><li>IPO I</li></a><a href="https://creaactiva.jotform.com/251421433454853?grupo=CFM1GA&docente=Diana%20Segarra%20Gil" target="_blank"><li>Tutoria</li></a>
            </ul>
        </div>
        <?php include '../footer.php'?>
    </body>
      </html>