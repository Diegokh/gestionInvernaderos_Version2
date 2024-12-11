<?php
include_once '../../models/Alerta.php';

class controladorAlerta { //Defino la clase del 
    //controlador y una propiedad privada $alertaModel para trabajar con 
    //instancias del modelo Alerta.
    private $alertaModel;

    //Al instanciar la clase, el constructor inicializa un 
    //objeto del modelo Alerta. Esto permite que los
    // métodos del controlador interactúen directamente con
    // las funciones del modelo.
    public function __construct() {
        $this->alertaModel = new Alerta();
    }

    /*
    
    Entrada:

    $idUsuario: Identificador del usuario.
    $esAdministrador: Bandera que indica si el usuario es administrador.

    Acción: Llama al método obtenerAlertas del modelo Alerta, que posiblemente consulta 
    y devuelve las alertas asociadas al usuario o a un administrador.
    
    */
  

    public function obtenerAlertas($idUsuario, $esAdministrador) {
        return $this->alertaModel->obtenerAlertas($idUsuario, $esAdministrador);
    }
    

    
    public function eliminarAlerta($idAlerta) {
        $this->alertaModel->eliminarAlerta($idAlerta);
    }

    /*
     Entrada:

    $idAlerta: Identificador de la alerta a eliminar.

    Acción: Llama al método eliminarAlerta del modelo Alerta,
    que elimina una alerta de la base de datos.

     */


   
}
?>
