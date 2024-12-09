<?php
include_once __DIR__ . '/Database.php';

class Historial extends Database {
    private $db;

    public function __construct() {
        $server = "localhost:3306";
        $user = "root";
        $pass = "";
        $base = "gestioninvernaderos";
        $this->db = new mysqli($server, $user, $pass, $base);

        if ($this->db->connect_error) {
            die("Error de conexión: " . $this->db->connect_error);
        }
    }

    // Obtener el historial completo
    public function obtenerHistorial() {
        $query = "SELECT 
                    h.idHistorial, 
                    h.accionHistorial, 
                    h.fechaHistorial, 
                    h.horaHistorial, 
                    d.tipo_Dispositivo, 
                    CASE 
                        WHEN h.accionHistorial = 1 THEN 'Encendido'
                        WHEN h.accionHistorial = 2 THEN 'Apagado'
                    END AS estado_Dispositivo
                  FROM 
                    historial_control h
                  JOIN 
                    dispositivos_control d ON h.id_Dispositivo = d.id_Dispositivo;";
        return $this->db->query($query);
    }

    // Eliminar un registro del historial
    public function eliminarHistorial($idHistorial) {
        $query = "DELETE FROM historial_control WHERE idHistorial = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idHistorial);
        $stmt->execute();
        $stmt->close();
    }

    public function cerrarConexion() {
        $this->db->close();
    }
}
?>
