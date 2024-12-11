<?php
session_start(); // Asegúrate de iniciar la sesión

include_once '../../controllers/controladorSensores.php';

// Obtén el idUsuario y rolUsuario desde la sesión
$idUsuario = $_SESSION['idUsuario'] ?? null;
$rolUsuario = $_SESSION['rolUsuario'] ?? null;

// Determina si el usuario es administrador
$esAdministrador = ($rolUsuario === 'Administrador');

// Verifica que el usuario esté logueado
if (!$idUsuario) {
    die("Usuario no logueado.");
}

// Instanciar el controlador
$controlador = new controladorSensores();

// Obtener los sensores
$sensores = $controlador->obtenerSensores($idUsuario, $esAdministrador);
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
                    <th>Ubicación del Invernadero</th>
                    <th>ID Sensor</th>
                    <th>Tipo de Sensor</th>
                    <th>Ubicación del Sensor</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($sensores && $sensores->num_rows > 0): ?>
                    <?php while ($row = $sensores->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_Invernadero']; ?></td>
                            <td><?php echo $row['ubicacionInvernadero']; ?></td>
                            <td><?php echo $row['idSensor']; ?></td>
                            <td><?php echo $row['tipo_sensor']; ?></td>
                            <td><?php echo $row['ubicacionSensor']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">No se encontraron sensores para este usuario.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="/vistas/agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a>
    </div>
</body>
</html>
