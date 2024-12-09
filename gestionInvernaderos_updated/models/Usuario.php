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
    public function agregarUsuario($nombre, $apellido, $email, $password, $telefono) {
        $query = "INSERT INTO usuarios (nombreUsuario, apellidoUsuario, emailUsuario, passwordUsuario, telefonoUsuario) 
                  VALUES ('$nombre', '$apellido', '$email', '$password', '$telefono')";
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
    public function actualizarUsuario($id, $nombre, $apellido, $email, $password, $telefono) {
        $query = "UPDATE usuarios SET nombreUsuario = ?, apellidoUsuario = ?, emailUsuario = ?, passwordUsuario = ?, telefonoUsuario = ? WHERE idUsuario = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssssi", $nombre, $apellido, $email, $password, $telefono, $id);
        $stmt->execute();
        $stmt->close();
    }

    // Cerrar conexión
    public function cerrarConexion() {
        $this->connection->close();
    }
}
?>