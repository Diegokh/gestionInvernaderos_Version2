<?php
include_once __DIR__ . '/../../controllers/controladorUsuario.php';

// Instanciar el controlador
$controlador = new controladorUsuario();

// Manejo de acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $controlador->eliminarUsuario($_POST['idUsuario']);
    } elseif (isset($_POST['add'])) {
        $controlador->agregarUsuario($_POST['nombreUsuario'], $_POST['apellidoUsuario'], $_POST['emailUsuario'], $_POST['passwordUsuario'], $_POST['telefonoUsuario']);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Obtener usuarios
$usuarios = $controlador->listarUsuarios();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestionar Usuarios</h1>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Teléfono</th>
                    <th>Eliminar</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($usuarios && $usuarios->num_rows > 0) {
                    while ($row = $usuarios->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['idUsuario']}</td>
                                <td>{$row['nombreUsuario']}</td>
                                <td>{$row['apellidoUsuario']}</td>
                                <td>{$row['emailUsuario']}</td>
                                <td>{$row['passwordUsuario']}</td>
                                <td>{$row['telefonoUsuario']}</td>
                                <td>
                                    <form method='POST' style='display:inline-block;'>
                                        <input type='hidden' name='idUsuario' value='{$row['idUsuario']}'>
                                        <input type='submit' name='delete' value='Eliminar' class='btn btn-danger'>
                                    </form>
                                </td>
                                <td>
                                    <form method='GET' action='/vistas/admin/editarUsuario.php' style='display:inline-block;'>
                                        <input type='hidden' name='idUsuario' value='{$row['idUsuario']}'>
                                        <input type='submit' value='Editar' class='btn btn-primary'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No se han encontrado usuarios</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h2 class="mb-3">Agregar Usuario</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nombreUsuario" class="form-label">Nombre Usuario:</label>
                <input type="text" name="nombreUsuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="apellidoUsuario" class="form-label">Apellido Usuario:</label>
                <input type="text" name="apellidoUsuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="emailUsuario" class="form-label">Email Usuario:</label>
                <input type="email" name="emailUsuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="passwordUsuario" class="form-label">Password Usuario:</label>
                <input type="password" name="passwordUsuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telefonoUsuario" class="form-label">Teléfono Usuario:</label>
                <input type="text" name="telefonoUsuario" class="form-control" required>
            </div>
            <button type="submit" name="add" class="btn btn-success">Agregar Usuario</button>
        </form>
        <a href="/vistas/agrosmart.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a>
    </div>
</body>
</html>
