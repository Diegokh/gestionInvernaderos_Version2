<?php
include_once '../../models/Sensores.php';
/*
Define la clase principal del controlador con una propiedad privada 
$modeloSensores, que almacena una instancia del modelo Sensores.
*/
class controladorSensores {
    private $modeloSensores;


    /*
    El constructor inicializa la propiedad privada 
    $modeloSensores, asegurando que el controlador pueda interactuar con el modelo Sensores para realizar operaciones relacionadas con los datos de los sensores.
    */

    public function __construct() {
        $this->modeloSensores = new Sensores();
    }

    /*
    Entrada:

    $idUsuario: Identificador del usuario que solicita los datos.
    $esAdministrador: Un booleano que indica si el usuario tiene privilegios de administrador.

    Acción:

    Llama al método obtenerSensoresPorUsuario del modelo Sensores.
    Este método filtra y devuelve los datos de los sensores según el usuario. Si el usuario es administrador, probablemente devuelve todos los sensores; de lo contrario, solo los asociados al usuario.

    Salida:

    Retorna una lista (o estructura similar) de sensores filtrados según los parámetros de entrada.
    
    
    */


    public function obtenerSensores($idUsuario, $esAdministrador) {
        return $this->modeloSensores->obtenerSensoresPorUsuario($idUsuario, $esAdministrador);
    }

    /*
    Método: obtenerTiposDeSensores()

    Acción:
        Llama al método obtenerTiposDeSensores del modelo Sensores.
        Este método devuelve los diferentes tipos de sensores que existen en el sistema.
    Salida:
        Retorna una lista (o arreglo) con los tipos de sensores disponibles.
    
    */

    public function obtenerTiposDeSensores() {
        return $this->modeloSensores->obtenerTiposDeSensores();
    }
    

    /*
    
    Método: agregarSensor($idInvernadero, $tipoSensor, $ubicacion)

    Entrada:
        $idInvernadero: Identificador del invernadero al que se asociará el sensor.
        $tipoSensor: Tipo de sensor que se desea agregar (por ejemplo, temperatura, humedad, etc.).
        $ubicacion: La ubicación física del sensor dentro del invernadero.
    Acción:
        Llama al método agregarSensor del modelo Sensores.
        Este método registra un nuevo sensor en la base de datos asociado con los parámetros proporcionados.
    Salida: Ninguna. Realiza la operación directamente sobre los datos
    
    */
    public function agregarSensor($idInvernadero, $tipoSensor, $ubicacion) {
        $this->modeloSensores->agregarSensor($idInvernadero, $tipoSensor, $ubicacion);
    }
}
?>
