<?php
include_once __DIR__ . '/../models/Usuario.php';

class controladorUsuario {
    private $usuarioModelo;

    public function __construct() {
        $this->usuarioModelo = new Usuario();
    }

    public function listarUsuarios() {
        return $this->usuarioModelo->obtenerUsuarios();
    }

    public function agregarUsuario($nombre, $apellido, $email, $password, $telefono, $rolUsuario) {
        $this->usuarioModelo->agregarUsuario($nombre, $apellido, $email, $password, $telefono, $rolUsuario);
    }

    public function eliminarUsuario($idUsuario) {
        $this->usuarioModelo->eliminarUsuario($idUsuario);
    }

    // Obtener un usuario por ID
    public function obtenerUsuario($id) {
        return $this->usuarioModelo->obtenerUsuarioPorId($id);
    }

    // Actualizar un usuario
    public function actualizarUsuario($id, $nombre, $apellido, $email, $password, $telefono, $rolUsuario) {
        $this->usuarioModelo->actualizarUsuario($id, $nombre, $apellido, $email, $password, $telefono, $rolUsuario);
    }

    
}
?>
