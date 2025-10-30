<!-- header.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreaActiva</title>

    <!-- CSS del header -->
    <link rel="stylesheet" href="/creaactiva-web/desarrollo/publico/recursos/css/headerStyles.css">

    <!-- Fuente -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header-principal">
    <div class="container header-contenido">
        <!-- Logo -->
        <div class="logo">
            <a href="/creaactiva-web/desarrollo/index.php">
                <img src="/creaactiva-web/desarrollo/publico/recursos/imagenes/logo_creaactiva.png" alt="Logo CreaActiva">
            </a>
        </div>

        <!-- Navegación + Botones -->
        <div class="nav-acciones">
            <nav class="navegacion">
                <ul>
                    <a href="/creaactiva-web/desarrollo/index.php?page=equipo">Equipo</a>
                    <a href="/creaactiva-web/desarrollo/index.php?page=servicios">Servicios</a>
                    <a href="/creaactiva-web/desarrollo/index.php?page=blog">Blog</a>
                    <a href="/creaactiva-web/desarrollo/index.php?page=contacto">Contacto</a>
                </ul>
            </nav>

            <div class="acciones-header">
                <button class="btn-accesibilidad" title="Accesibilidad (modo lectura)">
                    <img src="/creaactiva-web/desarrollo/publico/recursos/imagenes/iconos/oido.png" alt="Accesibilidad" style="height: 24px; width: 24px;">
                </button>
                <button class="btn-idioma" title="Cambiar idioma">ES</button>
            </div>
        </div>
    </div>
</header>
