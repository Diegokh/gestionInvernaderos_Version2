<?php
include_once __DIR__ . '/../models/Database.php';
include_once __DIR__ . '/../models/Usuario.php';

class Sesion extends Database {
    // Validar usuario y guardar en sesión
    public function iniciarSesion($email, $password) {
        $query = "SELECT * FROM usuarios WHERE emailUsuario = ? AND passwordUsuario = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            
            // Crear objeto Usuario
            $usuario = new Usuario();
            $usuario->setIdUsuario($userData['idUsuario']);
            $usuario->setNombreUsuario($userData['nombreUsuario']);
            $usuario->setApellidoUsuario($userData['apellidoUsuario']);
            $usuario->setEmailUsuario($userData['emailUsuario']);
            $usuario->setRolUsuario($userData['rolUsuario']);

            // Serializar el objeto Usuario y guardarlo en la sesión
            session_start();
            $_SESSION['usuario'] = serialize($usuario);

            return true;
        }

        return false;
    }

    // Recuperar usuario desde la sesión
    public function obtenerUsuarioSesion() {
        session_start();
        if (isset($_SESSION['usuario'])) {
            // Deserializar el objeto Usuario
            return unserialize($_SESSION['usuario']);
        }

        return null;
    }

    public function validarCredenciales($email, $password) {
        $query = "SELECT * FROM usuarios WHERE emailUsuario = ? AND passwordUsuario = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Devuelve los datos del usuario
        }
    
        return false; // Credenciales inválidas
    }
    

    // Cerrar sesión
    public function cerrarSesion() {
        session_start();
        session_destroy();
    }
}
