<?php

require_once 'database.php';

Class ProductoModel {
    private $cn;

    public function __construct(){
        $this->cn = DatabaseConnection::getInstance()->getConnection();
    }

    //Funciones CRUD

    public function listar(){
        $sql = mysqli_query($this->cn, "CALL sp_listar_productos()");
        $productos = $sql->fetch_all(MYSQLI_ASSOC);
        return $productos;
    }

    public function cambiarEstado($id, $estado){
        $sql = mysqli_query($this->cn, "CALL sp_cambiar_estado_producto($id, $estado)");
        return $sql;
    }
}

?>