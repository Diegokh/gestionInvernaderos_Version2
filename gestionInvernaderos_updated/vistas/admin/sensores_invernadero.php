<?php
include_once '../../controllers/controladorSensores.php';


// Instanciar el controlador
$controlador = new controladorSensores();

// Obtener los sensores
$sensores = $controlador->obtenerSensores();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sensores en Invernaderos</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Sensores en Invernaderos</h1>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Invernadero</th>
                    <th>ID Sensor</th>
                    <th>Ubicación</th>
                    <th>Tipo de Sensor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($sensores && $sensores->num_rows > 0) {
                    while ($row = $sensores->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_Invernadero']}</td>
                                <td>{$row['idSensor']}</td>
                                <td>{$row['ubicacionInvernadero']}</td>
                                <td>{$row['tipo_sensor']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No se han encontrado sensores en invernaderos</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="/vistas/agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a>
    </div>
</body>
</html>
