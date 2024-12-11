<?php
include_once __DIR__ . '/../../controllers/controladorInvernadero.php';

$controlador = new controladorInvernadero();

if (isset($_GET['id_Invernadero'])) {
    $id = $_GET['id_Invernadero'];
    $invernadero = $controlador->obtenerInvernaderoPorId($id);
}

if (isset($_POST['editar_invernadero'])) {
    $id = $_POST['id_Invernadero'];
    $ubicacion = $_POST['ubicacionInvernadero'];
    $idUsuario = intval($_POST['idUsuario']);
    $controlador->actualizarInvernadero($id, $ubicacion, $idUsuario);
    header("Location: gestionInvernaderos.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Invernadero</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Invernadero</h1>

        <?php if (!empty($invernadero)): ?>
            <form method="post" action="">
                <input type="hidden" name="id_Invernadero" value="<?php echo $invernadero['id_Invernadero']; ?>">
                <div class="mb-3">
                    <label for="ubicacionInvernadero" class="form-label">Ubicación del invernadero:</label>
                    <input type="text" name="ubicacionInvernadero" class="form-control" value="<?php echo $invernadero['ubicacionInvernadero']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="idUsuario" class="form-label">ID del dueño:</label>
                    <input type="text" name="idUsuario" class="form-control" value="<?php echo $invernadero['idUsuario']; ?>" required>
                </div>
                <button type="submit" name="editar_invernadero" class="btn btn-primary">Guardar Cambios</button>
            </form>
        <?php else: ?>
            <p class="text-danger">Invernadero no encontrado</p>
        <?php endif; ?>

        <a href="/vistas/agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a>
    </div>
</body>
</html>
