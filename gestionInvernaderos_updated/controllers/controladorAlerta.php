<?php
include_once '../../models/Alerta.php';

class controladorAlerta {
    private $alertaModel;

    public function __construct() {
        $this->alertaModel = new Alerta();
    }

  

    public function obtenerAlertas($idUsuario, $esAdministrador) {
        return $this->alertaModel->obtenerAlertas($idUsuario, $esAdministrador);
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
