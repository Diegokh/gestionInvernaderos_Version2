<?php
include_once __DIR__ . '/../models/Historial.php';

class controladorHistorial { //Define una clase con una propiedad privada 
    //$historialModel para manejar las interacciones con el modelo Historial.
    private $historialModel;

    public function __construct() {//Al instanciar el controlador, 
        //se crea un objeto del modelo Historial, lo que permite utilizar sus métodos.
        $this->historialModel = new Historial();
    }

    // Obtener el historial completo
    public function obtenerHistorial($idUsuario, $esAdministrador) {
        return $this->historialModel->obtenerHistorialPorUsuario($idUsuario, $esAdministrador);
    }

    /*
     Entrada:

    $idUsuario: Identificador del usuario.
    $esAdministrador: Indica si el usuario es administrador.

    Acción: Llama al método obtenerHistorialPorUsuario del modelo Historial, que probablemente devuelve una lista de registros del historial filtrados por usuario y rol.
    Salida: Retorna el historial del usuario (o todos los historiales si es administrador).
    */

    
    public function eliminarHistorial($idHistorial) {
        $this->historialModel->eliminarHistorial($idHistorial);
    }

    /*
    Entrada:

    $idHistorial: Identificador del registro del historial a eliminar.

Acción: Llama al método eliminarHistorial del modelo Historial, que elimina un registro específico del historial en la base de datos.
    
    */

    
}
?>
