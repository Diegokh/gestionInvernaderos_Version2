<?php
class Sensores {
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

    public function obtenerSensoresPorUsuario($idUsuario, $esAdministrador = false) {
        if ($esAdministrador) {
            // Consulta para administradores: todos los sensores
            $query = "SELECT i.id_Invernadero, i.ubicacionInvernadero, s.idSensor, s.tipo_sensor
                      FROM invernadero i
                      INNER JOIN sensores_inver si ON i.id_Invernadero = si.id_Invernadero
                      INNER JOIN sensores s ON si.idSensor = s.idSensor";
            return $this->db->query($query);
        } else {
            // Consulta para usuarios regulares: solo sus sensores
            $query = "SELECT i.id_Invernadero, i.ubicacionInvernadero, s.idSensor, s.tipo_sensor
                      FROM invernadero i
                      INNER JOIN sensores_inver si ON i.id_Invernadero = si.id_Invernadero
                      INNER JOIN sensores s ON si.idSensor = s.idSensor
                      WHERE i.idUsuario = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            return $stmt->get_result();
        }
    }
    

    public function cerrarConexion() {
        $this->db->close();
    }
}
?>
