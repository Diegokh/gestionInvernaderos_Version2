<?php
session_start();


$server = "localhost:3306";
$user = "root";
$pass = "";
$base = "gestioninvernaderos";

$conn = mysqli_connect($server, $user, $pass, $base);




?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroSmart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .img-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 15rem;
            margin-top: 3rem;
        }

        .img {
            max-width: 100%;
            max-height: 100%;
        }

        p{
            text-align: center;
            margin-top: 5.5rem;
        }
    </style>
</head>


<body>
    <header class="container">
        <h1>AgroSmart</h1>
        <h2>Bienvenido <?php echo ($_SESSION['nombreUsuario']) ?></h2>
        <a   href="/php_gestionInvernaderos/logout/logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </header>

    <div class="container mt-4">
        <div class="list-group">
            <a href="/vistas/estandar/sensores_invernadero.php" class="list-group-item list-group-item-action">Consultar Sensores en invernadero</a>
            <a href="/vistas/estandar/historialControl.php" class="list-group-item list-group-item-action">Consultar Historial de control</a>
            <a href="/vistas/estandar/alertas.php" class="list-group-item list-group-item-action">Consultar Alertas</a>
            <!--<a href="#">Consultar Lecturas de sensores</a>-->
        </div>
    </div>

    <div class="img-container">
        <img class="img" src="/img/logo.png" alt="Logo de AgroSmart">
    </div>

</body>
<footer>
    <p>All Rights Reserved Diego Inc.©</p>
</footer>
</html>

