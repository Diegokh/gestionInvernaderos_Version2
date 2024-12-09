<?php
class Alerta {
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

    // Obtener las notificaciones de alerta
    public function obtenerAlertas() {
        $query = "SELECT 
                    a.idAlerta,
                    a.tipoAlerta,                            
                    a.descripcionAlerta,                     
                    na.fechaNotificacion,                    
                    na.horaNotificacion,                    
                    u.nombreUsuario,                         
                    u.apellidoUsuario AS apellidosUsuario,        
                    i.id_Invernadero AS Invernadero_Afectado         
                  FROM 
                    notificacionAlertaUsuario na
                  JOIN 
                    usuarios u ON na.idUsuario = u.idUsuario    
                  JOIN 
                    alertas a ON na.idAlerta = a.idAlerta    
                  JOIN 
                    invernadero i ON na.id_Invernadero = i.id_Invernadero;";
        return $this->db->query($query);
    }

    // Eliminar una alerta
    public function eliminarAlerta($idAlerta) {
        $query = "DELETE FROM alertas WHERE idAlerta = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idAlerta);
        $stmt->execute();
        $stmt->close();
    }

    public function cerrarConexion() {
        $this->db->close();
    }
}
?>
