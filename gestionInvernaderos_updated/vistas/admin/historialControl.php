<?php
include_once __DIR__ . '/../../controllers/controladorHistorial.php';

// Instanciar el controlador
$controlador = new controladorHistorial();

// Manejo de acciones (eliminar registro)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $controlador->eliminarHistorial($_POST['idHistorial']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Obtener el historial
$historial = $controlador->obtenerHistorial();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Control de Dispositivos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Historial de Control de Dispositivos</h1>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Historial</th>
                    <th>Acción</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Tipo de Dispositivo</th>
                    <th>Estado del Dispositivo</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($historial && $historial->num_rows > 0) {
                    while ($row = $historial->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['idHistorial']}</td>
                                <td>{$row['accionHistorial']}</td>
                                <td>{$row['fechaHistorial']}</td>
                                <td>{$row['horaHistorial']}</td>
                                <td>{$row['tipo_Dispositivo']}</td>
                                <td>{$row['estado_Dispositivo']}</td>
                                <td>
                                    <form method='POST' style='display:inline-block;'>
                                        <input type='hidden' name='idHistorial' value='{$row['idHistorial']}'>
                                        <input type='submit' name='delete' value='Eliminar' class='btn btn-danger'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No se ha encontrado historial de control</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="/vistas/agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a>
    </div>
</body>
</html>
