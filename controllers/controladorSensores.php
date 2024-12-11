<?php
include_once '../../models/Sensores.php';

class controladorSensores {
    private $modeloSensores;

    public function __construct() {
        $this->modeloSensores = new Sensores();
    }

    public function obtenerSensores($idUsuario, $esAdministrador) {
        return $this->modeloSensores->obtenerSensoresPorUsuario($idUsuario, $esAdministrador);
    }

    public function obtenerTiposDeSensores() {
        return $this->modeloSensores->obtenerTiposDeSensores();
    }
    
    public function agregarSensor($idInvernadero, $tipoSensor, $ubicacion) {
        $this->modeloSensores->agregarSensor($idInvernadero, $tipoSensor, $ubicacion);
    }
}
?>
