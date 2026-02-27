<?php
require_once 'Model/ProductoModel.php';

Class ProductoController{
    private $model;

    public function __construct(){
        $this->model = new ProductoModel();
    }

    public function index(){
        $productos = $this->model->listar();
        require 'View/index.php';
    }

    public function activar(){
        $this->model->cambiarEstado($_GET['id'], 1);
        Header('Location: index.php');
        exit;
    }

    public function desactivar(){
        $this->model->cambiarEstado($_GET['id'], 0);
        Header('Location: index.php');
        exit;
    }


}


?>