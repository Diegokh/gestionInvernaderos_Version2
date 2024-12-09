<?php
include_once '../models/Usuario.php';

class controladorSesion {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function iniciarSesion($email, $password) {
        return $this->usuarioModel->validarUsuario($email, $password);
    }

    public function __destruct() {
        $this->usuarioModel->cerrarConexion();
    }
}
?>