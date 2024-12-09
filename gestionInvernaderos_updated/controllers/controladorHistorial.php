<?php
include_once __DIR__ . '/../models/Historial.php';

class controladorHistorial {
    private $historialModel;

    public function __construct() {
        $this->historialModel = new Historial();
    }

    // Obtener el historial completo
    public function obtenerHistorial() {
        return $this->historialModel->obtenerHistorial();
    }

    // Eliminar un registro del historial
    public function eliminarHistorial($idHistorial) {
        $this->historialModel->eliminarHistorial($idHistorial);
    }

    public function __destruct() {
        $this->historialModel->cerrarConexion();
    }
}
?>
