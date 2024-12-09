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

    public function obtenerSensoresPorInvernadero() {
        $query = "SELECT i.id_Invernadero, i.ubicacionInvernadero, s.idSensor, s.tipo_sensor
                  FROM invernadero i
                  INNER JOIN sensores_inver si ON i.id_Invernadero = si.id_Invernadero
                  INNER JOIN sensores s ON si.idSensor = s.idSensor;";
        return $this->db->query($query);
    }

    public function cerrarConexion() {
        $this->db->close();
    }
}
?>
