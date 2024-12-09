<?php
session_start();
include_once './models/Usuario.php';

echo "<h1>Pruebas de Serialización y Deserialización</h1>";

try {
    // Crear un objeto Usuario con datos simulados
    $userSession = new Usuario();
    $userSession->setIdUsuario(999);
    $userSession->setNombreUsuario("Session");
    $userSession->setApellidoUsuario("Test");
    $userSession->setEmailUsuario("session@example.com");
    $userSession->setPasswordUsuario("sessionpassword");
    $userSession->setTelefonoUsuario("123456789");
    $userSession->setRolUsuario("user");

    // Serializar y almacenar en la sesión
    $_SESSION['usuario'] = serialize($userSession);
    echo "Usuario serializado y almacenado en la sesión.<br>";

    // Deserializar
    $userFromSession = unserialize($_SESSION['usuario']);

    // Mostrar los datos deserializados
    echo "Usuario deserializado: " . json_encode([
        'idUsuario' => $userFromSession->getIdUsuario(),
        'nombreUsuario' => $userFromSession->getNombreUsuario(),
        'apellidoUsuario' => $userFromSession->getApellidoUsuario(),
        'emailUsuario' => $userFromSession->getEmailUsuario(),
        'telefonoUsuario' => $userFromSession->getTelefonoUsuario(),
        'rolUsuario' => $userFromSession->getRolUsuario(),
    ]) . "<br>";
} catch (Exception $e) {
    echo "Error en la serialización/deserialización: " . $e->getMessage() . "<br>";
}
?>
