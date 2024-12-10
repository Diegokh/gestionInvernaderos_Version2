<?php
include_once __DIR__ . '/../controllers/controladorSesion.php';


$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $controlador = new controladorSesion();
    $user = $controlador->iniciarSesion($email, $password);

    if ($user) {
        session_start();
        $_SESSION['idUsuario'] = $user['idUsuario'];
        $_SESSION['nombreUsuario'] = $user['nombreUsuario'];
        $_SESSION['rolUsuario'] = $user['rolUsuario'];

        if ($user['rolUsuario'] === 'Administrador') {
            header("Location: /vistas/agrosmart.php");
        } else {
            header("Location: /vistas/agrosmart_estandar.php");
        }
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AgroSmart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        p {
            text-align: center;
            margin-top: 15rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-primary text-white">
                        <h1>Inicio de sesión</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Ingresa tu email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" placeholder="Ingresa tu contraseña" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                        </form>
                        <?php if ($error): ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <p>All Rights Reserved Diego Inc.©</p>
</footer>
</html>
