<?php
include_once '../../controllers/controladorInvernadero.php';

// Instanciar el controlador
$controlador = new controladorInvernadero();

// Obtener los datos de los invernaderos
$invernaderos = $controlador->obtenerInvernaderos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>AgroSmart</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">AgroSmart</h1>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Invernadero</th>
                    <th>Ubicación</th>
                    <th>ID Usuario</th>
                    <th>Nombre Usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($invernaderos && $invernaderos->num_rows > 0) {
                    while ($row = $invernaderos->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_Invernadero']}</td>
                                <td>{$row['ubicacionInvernadero']}</td>
                                <td>{$row['idUsuario']}</td>
                                <td>{$row['nombreUsuario']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No se han encontrado usuarios asociados a los invernaderos</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="/vistas/agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a>
    </div>
</body>
</html>
