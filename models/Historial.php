<?php
include_once __DIR__ . '/Database.php';

class Historial extends Database {

    // Eliminar un registro del historial
    public function eliminarHistorial($idHistorial) {
        $query = "DELETE FROM historial_control WHERE idHistorial = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $idHistorial);
        $stmt->execute();
        $stmt->close();
    }

    // Obtener historial por usuario
    public function obtenerHistorialPorUsuario($idUsuario, $esAdministrador) {
        if ($esAdministrador) {
            // Administrador ve todos los registros
            $query = "SELECT
                        h.idHistorial,
                        h.accionHistorial,
                        h.fechaHistorial,
                        h.horaHistorial,
                        h.id_Invernadero,
                        d.tipo_Dispositivo,
                        CASE
                            WHEN h.accionHistorial = 1 THEN 'Encendido'
                            WHEN h.accionHistorial = 2 THEN 'Apagado'
                        END AS estado_Dispositivo
                      FROM
                        historial_control h
                      JOIN
                        dispositivos_control d ON h.id_Dispositivo = d.id_Dispositivo";
            return $this->connection->query($query);
        } else {
            // Usuario estándar ve registros asociados a sus invernaderos
            $query = "SELECT
                        h.idHistorial,
                        h.accionHistorial,
                        h.fechaHistorial,
                        h.horaHistorial,
                        h.id_Invernadero,
                        d.tipo_Dispositivo,
                        CASE
                            WHEN h.accionHistorial = 1 THEN 'Encendido'
                            WHEN h.accionHistorial = 2 THEN 'Apagado'
                        END AS estado_Dispositivo
                      FROM
                        historial_control h
                      JOIN
                        dispositivos_control d ON h.id_Dispositivo = d.id_Dispositivo
                      JOIN
                        invernadero i ON h.id_Invernadero = i.id_Invernadero
                      WHERE i.idUsuario = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            return $stmt->get_result();
        }
    }
}
?>
