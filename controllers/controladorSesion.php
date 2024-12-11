<?php
include_once __DIR__ . '/../models/Sesion.php';
/*
Define la clase principal del controlador con una propiedad privada 
$sesionModel, que almacena una instancia del modelo Sesion.
*/
class controladorSesion {
    private $sesionModel;
//Inicializa el controlador creando una instancia de Sesion.Se encargara
// de las operaciones de autenticacion
    public function __construct() {
        $this->sesionModel = new Sesion();
    }


    //Valida las credenciales proporcionadas por el usuario 
    //(correo y contraseña) llamando al método correspondiente del modelo Sesion.
    public function iniciarSesion($email, $password) {
        return $this->sesionModel->validarCredenciales($email, $password);
    }

    /*
    Entrada

    $email: El correo electrónico del usuario que intenta iniciar sesión.
    $password: La contraseña proporcionada por el usuario.

    Acción

    Llama al método validarCredenciales del modelo Sesion.
    Este método comprueba si el correo electrónico y la contraseña coinciden con los datos almacenados (por ejemplo, en una base de datos).

    Salida

    Devuelve el resultado de la validación:
        Si las credenciales son correctas, puede devolver un objeto o arreglo con los datos del usuario.
    
    
    */
}
?>
