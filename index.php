<?php
    require_once __DIR__ . '/config.php';

    $controller = new EmailController();

    // Determine action from query string, 
    // if does not exist --> 'index'
    if (isset($_GET['action'])){
        $action = $_GET['action']; 
    }
    else {
        $action = 'index';
    }

    switch ($action) {
        case 'index':
            $controller->index();
            break;
        case 'insert':
            $controller->insert();
            break;
        case 'edit':
            $controller->edit();
            break;
        case 'delete':
            $controller->delete();
            break;
        default:
            header('HTTP/1.0 404 Not Found');
            echo 'Action not found';
            exit;
    }
    
?>
