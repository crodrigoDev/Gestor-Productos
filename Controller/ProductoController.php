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

    public function agregarview(){
        require 'View/agregar.php';
    }

    public function editarview(){
        $producto = $this->model->listar_prod($_GET['id']);
        require 'View/editar.php';
    }

    public function agregar(){
        $this->model->agregar($_POST['nombre_prod'], $_POST['marca_prod'], $_POST['desc_prod'], $_POST['precio'], $_POST['stock'], $_POST['estado']);
        Header('Location: index.php');
        exit;
    }


}


?>