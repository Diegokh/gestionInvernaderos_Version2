<?php
include_once __DIR__ . '/Database.php';

class Usuario extends Database {
    private $idUsuario;
    private $nombreUsuario;
    private $apellidoUsuario;
    private $emailUsuario;
    private $passwordUsuario;
    private $telefonoUsuario;
    private $rolUsuario;

    public function __construct() {
        parent::__construct();
    }

    // Obtener todos los usuarios
    public function obtenerUsuarios() {
        $query = "SELECT * FROM usuarios";
        $result = $this->connection->query($query);
        if (!$result) {
            die("Error al obtener usuarios: " . $this->connection->error);
        }
        return $result;
    }

    // Agregar un usuario
    public function agregarUsuario($nombre, $apellido, $email, $password, $telefono, $rolUsuario) {
        $query = "INSERT INTO usuarios (nombreUsuario, apellidoUsuario, emailUsuario, passwordUsuario, telefonoUsuario) 
                  VALUES ('$nombre', '$apellido', '$email', '$password', '$telefono', '$rolUsuario')";
        if ($this->connection->query($query)) {
            return true;
        } else {
            die("Error al agregar usuario: " . $this->connection->error);
        }
    }

    // Validar credenciales de usuario
    public function validarUsuario($email, $password) {
        $query = "SELECT * FROM usuarios WHERE emailUsuario = '$email' AND passwordUsuario = '$password'";
        $result = $this->connection->query($query);

        if ($result && $result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Eliminar un usuario
    public function eliminarUsuario($idUsuario) {
        $query = "DELETE FROM usuarios WHERE idUsuario = $idUsuario";
        if ($this->connection->query($query)) {
            return true;
        } else {
            die("Error al eliminar usuario: " . $this->connection->error);
        }
    }

    // Obtener un usuario por su ID
    public function obtenerUsuarioPorId($id) {
        $query = "SELECT * FROM usuarios WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Actualizar un usuario
    public function actualizarUsuario($id, $nombre, $apellido, $email, $password, $telefono, $rolUsuario) {
        $query = "UPDATE usuarios SET nombreUsuario = ?, apellidoUsuario = ?, emailUsuario = ?, passwordUsuario = ?, telefonoUsuario = ?, rolUsuario = ? WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssssssi", $nombre, $apellido, $email, $password, $telefono, $rolUsuario, $id);
        $stmt->execute();
        $stmt->close();
    }

    // Cerrar conexión
    public function cerrarConexion() {
        $this->connection->close();
    }

    //Set y Getter
    public function setIdUsuario($id) {
        $this->idUsuario = $id;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setNombreUsuario($nombre) {
        $this->nombreUsuario = $nombre;
    }

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function setApellidoUsuario($apellido) {
        $this->apellidoUsuario = $apellido;
    }

    public function getApellidoUsuario() {
        return $this->apellidoUsuario;
    }

    public function gettelefonoUsuario() {
        return $this->telefonoUsuario;
    }

    public function settelefonoUsuarop($telefonoUsuario) {
        $this->telefonoUsuario = $telefonoUsuario;
    }


    public function setEmailUsuario($email) {
        $this->emailUsuario = $email;
    }

    public function getEmailUsuario() {
        return $this->emailUsuario;
    }

    public function setPasswordUsuario($password) {
        $this->passwordUsuario = $password;
    }

    public function getPasswordUsuario() {
        return $this->passwordUsuario;
    }

    public function setRolUsuario($rol) {
        $this->rolUsuario = $rol;
    }

    public function getRolUsuario() {
        return $this->rolUsuario;
    }

}
?>