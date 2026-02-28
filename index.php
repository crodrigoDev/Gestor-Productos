<?php
    require_once 'Controller/ProductoController.php';

    $controller = new ProductoController();
    $action = $_GET['action'] ?? 'index';

    switch($action){
        case 'activar':
            $controller->activar(); break;
        case 'desactivar':
            $controller->desactivar(); break;
        case 'agregarview':
            $controller->agregarview(); break;
        case 'agregar':
            $controller->agregar(); break;
        case 'editarview':
            $controller->editarview(); break;
        case 'editar':
            $controller->editar(); break;
        case 'eliminar':
            $controller->eliminar(); break;
        default:
            $controller->index(); break;
    }



?>