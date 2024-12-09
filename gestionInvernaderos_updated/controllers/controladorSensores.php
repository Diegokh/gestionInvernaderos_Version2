<?php
include_once '../../models/Sensores.php';

class controladorSensores {
    private $sensoresModel;

    public function __construct() {
        $this->sensoresModel = new Sensores();
    }

    public function obtenerSensores() {
        return $this->sensoresModel->obtenerSensoresPorInvernadero();
    }

    public function __destruct() {
        $this->sensoresModel->cerrarConexion();
    }
}
?>
