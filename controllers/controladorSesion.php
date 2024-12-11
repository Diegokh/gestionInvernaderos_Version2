<?php
include_once __DIR__ . '/../models/Sesion.php';

class controladorSesion {
    private $sesionModel;

    public function __construct() {
        $this->sesionModel = new Sesion();
    }

    public function iniciarSesion($email, $password) {
        return $this->sesionModel->validarCredenciales($email, $password);
    }
}
?>
