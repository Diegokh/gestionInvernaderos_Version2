<?php
include_once __DIR__ . '/../models/Invernaderos.php';

/*
Define la clase principal del controlador con una propiedad privada 
$invernaderoModel, que almacena una instancia del modelo Invernaderos.
*/
class controladorInvernadero {
    private $invernaderoModel;

    public function __construct() { /* Al crear una instancia de esta clase, 
        se inicializa un objeto del modelo Invernaderos, lo que permite usar sus métodos.  */
        $this->invernaderoModel = new Invernadero();
    }

    // Método para obtener un invernadero por ID
    public function obtenerInvernadero($id) {
        return $this->invernaderoModel->obtenerInvernadero($id); // Método definido en el modelo
    }

    /*
    
    Entrada:

    $id: Identificador único del invernadero.

    Acción: Llama al método obtenerInvernadero en el modelo para recuperar la información del invernadero correspondiente.
    Salida: Devuelve los datos del invernadero.
    
    */



    // Método para actualizar un invernadero
    public function actualizarInvernadero($id, $ubicacion, $idUsuario) {
        $this->invernaderoModel->actualizarInvernadero($id, $ubicacion, $idUsuario); // Método definido en el modelo
    }

    /*
    Entrada:

    $id: Identificador del invernadero.
    $ubicacion: Nueva ubicación del invernadero.
    $idUsuario: Usuario responsable de la actualización.

    Acción: Llama al modelo para actualizar la información del invernadero.
    
    */

    // Método para listar todos los invernaderos
    public function listarInvernaderos() {
        return $this->invernaderoModel->obtenerInvernaderos(); // Este método está en el modelo
    }

    /*
    Acción: Obtiene una lista de todos los invernaderos llamando al modelo.
    Salida: Retorna un arreglo con todos los invernaderos disponibles.
    
    */



    // Método para agregar un invernadero
    public function agregarInvernadero($ubicacionInvernadero, $idUsuario) {
        $this->invernaderoModel->agregarInvernadero($ubicacionInvernadero, $idUsuario); // Método del modelo
    }

    /*
    Entrada:

    $ubicacionInvernadero: Ubicación del nuevo invernadero.
    $idUsuario: Usuario responsable de la adición.

    Acción: Llama al modelo para insertar un nuevo invernadero en la base de datos.
    */

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
