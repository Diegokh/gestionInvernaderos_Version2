<?php
include_once __DIR__ . '/../../models/Usuario.php';

// Instancia de la clase Usuario
$usuarioModel = new Usuario();

// Verifica si se ha enviado un ID de usuario
if (isset($_GET['idUsuario'])) {
    $id = $_GET['idUsuario'];
    $usuario = $usuarioModel->obtenerUsuarioPorId($id); // Método en la clase Usuario
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['idUsuario'];
    $nombre = $_POST['nombreUsuario'];
    $apellido = $_POST['apellidoUsuario'];
    $email = $_POST['emailUsuario'];
    $password = $_POST['passwordUsuario'];
    $telefono = $_POST['telefonoUsuario'];
    $rolUsuario = $_POST['rolUsuario'];

    $usuarioModel->actualizarUsuario($id, $nombre, $apellido, $email, $password, $telefono, $rolUsuario); // Método en la clase Usuario
    header('Location: gestionUsuario.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Usuario</h1>

        <form method="POST" action="">
            <input type="hidden" name="idUsuario" value="<?php echo $usuario['idUsuario']; ?>">
            <div class="mb-3">
                <label for="nombreUsuario" class="form-label">Nombre:</label>
                <input type="text" name="nombreUsuario" class="form-control" value="<?php echo $usuario['nombreUsuario']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellidoUsuario" class="form-label">Apellido:</label>
                <input type="text" name="apellidoUsuario" class="form-control" value="<?php echo $usuario['apellidoUsuario']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="emailUsuario" class="form-label">Email:</label>
                <input type="email" name="emailUsuario" class="form-control" value="<?php echo $usuario['emailUsuario']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="passwordUsuario" class="form-label">Contraseña:</label>
                <input type="password" name="passwordUsuario" class="form-control" value="<?php echo $usuario['passwordUsuario']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefonoUsuario" class="form-label">Teléfono:</label>
                <input type="text" name="telefonoUsuario" class="form-control" value="<?php echo $usuario['telefonoUsuario']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="rolUsuario" class="form-label">Rol:</label>
                <input type="text" name="rolUsuario" class="form-control" value="<?php echo $usuario['rolUsuario']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
        <a href="gestionUsuario.php" class="btn btn-secondary mt-3">Cancelar</a>
    </div>
</body>
</html>
