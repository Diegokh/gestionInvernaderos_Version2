<?php
include_once __DIR__ . '/../models/Invernaderos.php';

class controladorInvernadero {
    private $invernaderoModel;

    public function __construct() {
        $this->invernaderoModel = new Invernadero();
    }

    // Método para obtener un invernadero por ID
    public function obtenerInvernadero($id) {
        return $this->invernaderoModel->obtenerInvernadero($id); // Método definido en el modelo
    }

    // Método para actualizar un invernadero
    public function actualizarInvernadero($id, $ubicacion, $idUsuario) {
        $this->invernaderoModel->actualizarInvernadero($id, $ubicacion, $idUsuario); // Método definido en el modelo
    }

    // Método para listar todos los invernaderos
    public function listarInvernaderos() {
        return $this->invernaderoModel->obtenerInvernaderos(); // Este método está en el modelo
    }

    // Método para agregar un invernadero
    public function agregarInvernadero($ubicacionInvernadero, $idUsuario) {
        $this->invernaderoModel->agregarInvernadero($ubicacionInvernadero, $idUsuario); // Método del modelo
    }

    // Método para eliminar un invernadero
    public function eliminarInvernadero($id_Invernadero) {
        $this->invernaderoModel->eliminarInvernadero($id_Invernadero); // Método del modelo
    }

    public function obtenerInvernaderos() {
        return $this->invernaderoModel->obtenerInvernaderosConUsuarios();
    }

    

    public function obtenerInvernaderoPorId($id) {
        return $this->invernaderoModel->obtenerInvernaderoPorId($id);
    }

    

    
}
?>
