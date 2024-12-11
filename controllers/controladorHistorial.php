<?php
include_once __DIR__ . '/../models/Historial.php';

class controladorHistorial {
    private $historialModel;

    public function __construct() {
        $this->historialModel = new Historial();
    }

    // Obtener el historial completo
    public function obtenerHistorial($idUsuario, $esAdministrador) {
        return $this->historialModel->obtenerHistorialPorUsuario($idUsuario, $esAdministrador);
    }

    // Eliminar un registro del historial
    public function eliminarHistorial($idHistorial) {
        $this->historialModel->eliminarHistorial($idHistorial);
    }

    

    
}
?>
