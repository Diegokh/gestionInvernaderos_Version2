<?php
include_once __DIR__ . '/../models/Database.php';

class Sesion extends Database {
    // Validar usuario
    public function validarCredenciales($email, $password) {
        $query = "SELECT idUsuario, nombreUsuario, rolUsuario FROM usuarios WHERE emailUsuario = ? AND passwordUsuario = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
}
?>
