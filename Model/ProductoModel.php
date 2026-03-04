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
        while(mysqli_next_result($this->cn)){;}
        return $productos;
    }

    public function cambiarEstado($id_prod, $estado){
        $sql = mysqli_query($this->cn, "CALL sp_cambiar_estado_producto($id_prod, $estado)");
        while(mysqli_next_result($this->cn)){;}
        return $sql;
    }

    public function listar_prod($id_prod){
        $sql = mysqli_query($this->cn, "CALL sp_obtener_producto($id_prod)");
        $producto = $sql->fetch_assoc();
        while(mysqli_next_result($this->cn)){;}
        return $producto;
    }

    public function agregar($nombre_prod, $marca_prod, $desc_prod, $precio, $stock, $estado){
        $sql = mysqli_query($this->cn, "CALL sp_crear_producto('$nombre_prod', '$marca_prod', '$desc_prod', $precio, $stock, $estado)");
        while(mysqli_next_result($this->cn)){;}
        return $sql;
    }

    public function editar($id_prod, $nombre_prod, $marca_prod, $desc_prod, $precio, $stock, $estado){
        $sql = mysqli_query($this->cn, "CALL sp_actualizar_producto($id_prod, '$nombre_prod', '$marca_prod', '$desc_prod', $precio, $stock, $estado)");
        while(mysqli_next_result($this->cn)){;}
        return $sql;
    }

    public function eliminar($id_prod){
        $sql = mysqli_query($this->cn, "CALL sp_eliminar_producto($id_prod)");
        while(mysqli_next_result($this->cn)){;}
        return $sql;
    }
    
}

?>