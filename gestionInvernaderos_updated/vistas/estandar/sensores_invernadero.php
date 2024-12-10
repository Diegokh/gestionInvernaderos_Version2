<?php
session_start();
include_once __DIR__ . '/../../controllers/controladorSensores.php';

$controlador = new ControladorSensores();

// Obtén los datos del usuario desde la sesión
$idUsuario = $_SESSION['idUsuario'] ?? null;
$rolUsuario = $_SESSION['rolUsuario'] ?? null;

if ($idUsuario) {
    // Verifica si el usuario es administrador
    $esAdministrador = ($rolUsuario === 'Administrador');
    $sensores = $controlador->obtenerSensores($idUsuario, $esAdministrador);
} else {
    die("Usuario no logueado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensores por Invernadero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Sensores por Invernadero</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Invernadero</th>
                    <th>Ubicación</th>
                    <th>ID Sensor</th>
                    <th>Tipo de Sensor</th>
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
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">No se encontraron sensores para este usuario.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="/vistas/agrosmart_estandar.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a>
    </div>
</body>
</html>
