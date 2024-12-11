<?php
include_once __DIR__ . '/Database.php';

class Alerta extends Database {
    // Obtener las notificaciones de alerta
    public function obtenerAlertas($idUsuario, $esAdministrador) {
        if ($esAdministrador) {
            // Mostrar todas las alertas para administradores
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
            return $this->connection->query($query);
        } else {
            // Mostrar solo las alertas asociadas a los invernaderos del usuario
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
                        invernadero i ON na.id_Invernadero = i.id_Invernadero
                      WHERE i.idUsuario = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            return $stmt->get_result();
        }
    }

    // Eliminar una alerta
    public function eliminarAlerta($idAlerta) {
        $query = "DELETE FROM alertas WHERE idAlerta = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $idAlerta);
        $stmt->execute();
        $stmt->close();
    }
}
