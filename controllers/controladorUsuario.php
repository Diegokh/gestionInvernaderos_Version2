<?php
include_once __DIR__ . '/../models/Usuario.php';


//El constructor crea una instancia del modelo Usuario.
class controladorUsuario {
    private $usuarioModelo;

    public function __construct() {
        $this->usuarioModelo = new Usuario();
    }

    //listarUsuarios(): Obtiene la lista de todos los usuarios llamando al método correspondiente en el modelo.
    public function listarUsuarios() {
        return $this->usuarioModelo->obtenerUsuarios();
    }
//agregarUsuario(): Agrega un nuevo usuario utilizando el método del modelo.
    public function agregarUsuario($nombre, $apellido, $email, $password, $telefono, $rolUsuario) {
        $this->usuarioModelo->agregarUsuario($nombre, $apellido, $email, $password, $telefono, $rolUsuario);
    }

    //eliminarUsuario(): Elimina un usuario por su ID.
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
