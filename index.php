<?php
    require_once 'Controller/ProductoController.php';

    $controller = new ProductoController();
    $action = $_GET['action'] ?? 'index';

    switch($action){
        case 'activar':
            $controller->activar(); break;
        case 'desactivar':
            $controller->desactivar(); break;
        default:
            $controller->index(); break;
    }



?>