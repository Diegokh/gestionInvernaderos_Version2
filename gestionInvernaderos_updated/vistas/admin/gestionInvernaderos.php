<?php
include_once __DIR__ . '/../../controllers/controladorInvernadero.php';

// Instanciar el controlador
$controlador = new controladorInvernadero();

// Manejo de acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $controlador->eliminarInvernadero($_POST['id_Invernadero']);
    } elseif (isset($_POST['add'])) {
        $controlador->agregarInvernadero($_POST['ubicacionInvernadero'], $_POST['idUsuario']);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Obtener los datos
$invernaderos = $controlador->listarInvernaderos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestionar Invernaderos</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestionar Invernaderos</h1>
       
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Invernadero</th>
                    <th>Ubicación</th>
                    <th>ID Usuario</th>
                    <th>Dueño</th>
                    <th>Eliminar</th>
                    <th>Editar</th>
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
                                <td>
                                    <form method='POST' style='display:inline-block;'>
                                        <input type='hidden' name='id_Invernadero' value='{$row['id_Invernadero']}'>
                                        <input type='submit' name='delete' value='Eliminar' class='btn btn-danger'>
                                    </form>
                                </td>
                                <td>
                                    <form method='get' action='editarInvernadero.php' style='display:inline-block;'>
                                        <input type='hidden' name='id_Invernadero' value='{$row['id_Invernadero']}'>
                                        <input type='submit' value='Editar' class='btn btn-primary'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No se han encontrado Invernaderos</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Agregar Invernadero</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="ubicacionInvernadero" class="form-label">Ubicación:</label>
                <input type="text" name="ubicacionInvernadero" id="ubicacionInvernadero" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="idUsuario" class="form-label">ID Usuario:</label>
                <input type="text" name="idUsuario" id="idUsuario" class="form-control" required>
            </div>
            <button type="submit" name="add" class="btn btn-success">Agregar Invernadero</button>
        </form>
        <a href="/vistas/agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a>
    </div>
</body>
</html>
