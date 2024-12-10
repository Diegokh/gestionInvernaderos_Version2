<?php
session_start(); // Asegúrate de iniciar la sesión
include_once '../../controllers/controladorAlerta.php';

// Verifica si el usuario está logueado
$idUsuario = $_SESSION['idUsuario'] ?? null;
$esAdministrador = ($_SESSION['rolUsuario'] ?? '') === 'Administrador';

if ($idUsuario === null) {
    die("Usuario no autenticado.");
}

// Instanciar el controlador
$controlador = new controladorAlerta();

// Obtener las alertas dependiendo del usuario y su rol
$alertas = $controlador->obtenerAlertas($idUsuario, $esAdministrador);

// Manejo de acciones (eliminar alerta)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $controlador->eliminarAlerta($_POST['idAlerta']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones de Alertas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Notificaciones de Alertas</h1>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tipo de Alerta</th>
                    <th>Descripción de la Alerta</th>
                    <th>Fecha de Notificación</th>
                    <th>Hora de Notificación</th>
                    <th>Nombre de Usuario</th>
                    <th>Apellidos del Usuario</th>
                    <th>ID Invernadero Afectado</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($alertas && $alertas->num_rows > 0) {
                    while ($row = $alertas->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['tipoAlerta']}</td>
                                <td>{$row['descripcionAlerta']}</td>
                                <td>{$row['fechaNotificacion']}</td>
                                <td>{$row['horaNotificacion']}</td>
                                <td>{$row['nombreUsuario']}</td>
                                <td>{$row['apellidosUsuario']}</td>
                                <td>{$row['Invernadero_Afectado']}</td>
                                <td>
                                    <form method='POST' style='display:inline-block;'>
                                        <input type='hidden' name='idAlerta' value='{$row['idAlerta']}'>
                                        <input type='submit' name='delete' value='Eliminar' class='btn btn-danger'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No se han encontrado notificaciones de alertas</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="/vistas/agrosmart_estandar.php" class="btn btn-primary mt-4">Volver al Menú de Inicio</a>
    </div>
</body>
</html>
