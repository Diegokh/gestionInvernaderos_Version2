<?php
include_once __DIR__ . '/../models/Database.php';

class Invernadero extends Database {
    // Método para obtener todos los invernaderos
    public function obtenerInvernaderos() {
        $query = "SELECT
                    invernadero.id_Invernadero,
                    invernadero.ubicacionInvernadero,
                    invernadero.idUsuario,
                    usuarios.nombreUsuario
                  FROM invernadero
                  LEFT JOIN usuarios ON invernadero.idUsuario = usuarios.idUsuario";
        $result = $this->connection->query($query);
        if (!$result) {
            die("Error al obtener invernaderos: " . $this->connection->error);
        }
        return $result;
    }

    // Método para agregar un invernadero
    public function agregarInvernadero($ubicacionInvernadero, $idUsuario) {
        $query = "INSERT INTO invernadero (ubicacionInvernadero, idUsuario) VALUES ('$ubicacionInvernadero', $idUsuario)";
        if (!$this->connection->query($query)) {
            die("Error al agregar invernadero: " . $this->connection->error);
        }
    }

    // Método para eliminar un invernadero
    public function eliminarInvernadero($id_Invernadero) {
        $query = "DELETE FROM invernadero WHERE id_Invernadero = $id_Invernadero";
        if (!$this->connection->query($query)) {
            die("Error al eliminar invernadero: " . $this->connection->error);
        }
    }

    // Método para obtener un invernadero por ID
    public function obtenerInvernadero($id) {
        $query = "SELECT * FROM invernadero WHERE id_Invernadero = $id";
        $result = $this->connection->query($query);
        if (!$result) {
            die("Error al obtener el invernadero: " . $this->connection->error);
        }
        return $result->fetch_assoc();
    }

    

    // Método para obtener invernaderos con usuarios
    public function obtenerInvernaderosConUsuarios() {
        $query = "SELECT i.id_Invernadero, i.ubicacionInvernadero, i.idUsuario, u.nombreUsuario
                  FROM invernadero i
                  INNER JOIN usuarios u ON i.idUsuario = u.idUsuario";
        $result = $this->connection->query($query);
        if (!$result) {
            die("Error al obtener invernaderos con usuarios: " . $this->connection->error);
        }
        return $result;
    }

    public function obtenerInvernaderoPorId($id) {
        $query = "SELECT * FROM invernadero WHERE id_Invernadero = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function actualizarInvernadero($id, $ubicacion, $idUsuario) {
        $query = "UPDATE invernadero SET ubicacionInvernadero = ?, idUsuario = ? WHERE id_Invernadero = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sii", $ubicacion, $idUsuario, $id);
        $stmt->execute();
        $stmt->close();
    }
}
?>

