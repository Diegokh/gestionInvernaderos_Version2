<?php
session_start();
include_once __DIR__ . '/../../controllers/controladorSensores.php';

// Instanciar el controlador
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

// Manejo de formulario para agregar sensores
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addSensor'])) {
    $idInvernadero = $_POST['idInvernadero'];
    $tipoSensor = $_POST['tipoSensor'];
    $ubicacion = $_POST['ubicacion'];

    $controlador->agregarSensor($idInvernadero, $tipoSensor, $ubicacion);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Obtener tipos de sensores para el desplegable
$tiposSensores = $controlador->obtenerTiposDeSensores();
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
        
        <!-- Formulario para agregar sensores -->
        <h2 class="mt-5">Agregar Sensor</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="idInvernadero" class="form-label">ID del Invernadero:</label>
                <input type="number" name="idInvernadero" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tipoSensor" class="form-label">Tipo de Sensor:</label>
                <select name="tipoSensor" class="form-control" required>
                    <option value="">Seleccione un tipo de sensor</option>
                    <?php foreach ($tiposSensores as $tipo): ?>
                        <option value="<?php echo $tipo['idSensor']; ?>"><?php echo $tipo['tipo_sensor']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación del Sensor:</label>
                <input type="text" name="ubicacion" class="form-control" required>
            </div>
            <button type="submit" name="addSensor" class="btn btn-success">Agregar Sensor</button>
        </form>

        <a href="/vistas/agrosmart_estandar.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a>
    </div>
</body>
</html>
