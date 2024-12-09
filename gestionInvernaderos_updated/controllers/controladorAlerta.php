<?php
include_once '../../models/Alerta.php';

class controladorAlerta {
    private $alertaModel;

    public function __construct() {
        $this->alertaModel = new Alerta();
    }

    // Obtener las alertas
    public function obtenerAlertas() {
        return $this->alertaModel->obtenerAlertas();
    }

    // Eliminar una alerta
    public function eliminarAlerta($idAlerta) {
        $this->alertaModel->eliminarAlerta($idAlerta);
    }

    public function __destruct() {
        $this->alertaModel->cerrarConexion();
    }
}
?>
