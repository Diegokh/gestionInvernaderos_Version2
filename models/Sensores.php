<?php
include_once __DIR__ . '/Database.php';

class Sensores extends Database {
    public function obtenerSensoresPorUsuario($idUsuario, $esAdministrador = false) {
        if ($esAdministrador) {
            // Consulta para administradores: todos los sensores
            $query = "SELECT 
                        i.id_Invernadero, 
                        i.ubicacionInvernadero, 
                        s.idSensor, 
                        s.tipo_sensor,
                        si.Ubicacion AS ubicacionSensor
                      FROM invernadero i
                      INNER JOIN sensores_inver si ON i.id_Invernadero = si.id_Invernadero
                      INNER JOIN sensores s ON si.idSensor = s.idSensor";
            $result = $this->connection->query($query);
            if (!$result) {
                die("Error al obtener sensores: " . $this->connection->error);
            }
            return $result;
        } else {
            // Consulta para usuarios regulares: solo sus sensores
            $query = "SELECT 
                        i.id_Invernadero, 
                        i.ubicacionInvernadero, 
                        s.idSensor, 
                        s.tipo_sensor,
                        si.Ubicacion AS ubicacionSensor
                      FROM invernadero i
                      INNER JOIN sensores_inver si ON i.id_Invernadero = si.id_Invernadero
                      INNER JOIN sensores s ON si.idSensor = s.idSensor
                      WHERE i.idUsuario = ?";
            $stmt = $this->connection->prepare($query);
            if (!$stmt) {
                die("Error al preparar consulta: " . $this->connection->error);
            }
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        }
    }
    


    public function obtenerTiposDeSensores() {
        $query = "SELECT * FROM sensores";
        $result = $this->connection->query($query);
        if (!$result) {
            die("Error al obtener tipos de sensores: " . $this->connection->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function agregarSensor($idInvernadero, $tipoSensor, $ubicacion) {
        $query = "INSERT INTO sensores_inver (id_Invernadero, idSensor, Ubicacion) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            die("Error al preparar consulta: " . $this->connection->error);
        }
        $stmt->bind_param("iis", $idInvernadero, $tipoSensor, $ubicacion);
        $stmt->execute();
        $stmt->close();
    }

   
}
?>
