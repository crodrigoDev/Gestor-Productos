<?php 

class DatabaseConnection {
    private static ?DatabaseConnection $instance = null;
    private $connection;
    private $host = 'localhost';
    private $name = 'root';
    private $password = '';
    private $db = 'elektroniko';

    private function __construct(){

        $this->connection = new mysqli($this->host, $this->name, $this->password, $this->db);

        if($this->connection->connect_error){
            die('No se pudo conectar a la Base de Datos: ' . $this->connection->connect_error);
        }
    }

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new DatabaseConnection();
        }

        return self::$instance;
    }

    public function getConnection(){
        return $this->connection;
    }  
}

?>