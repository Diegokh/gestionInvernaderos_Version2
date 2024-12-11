
<?php
abstract class Database {
    protected $connection;

    public function __construct() {
        $this->connection = new mysqli('localhost', 'root', '', 'gestioninvernaderos');
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function closeConnection() {
        $this->connection->close();
    }

    public function __destruct() {
        $this->closeConnection();
    }
}
?>
