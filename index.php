<?php
require_once 'helpers/Database.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/UserController.php';

session_start();

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'product';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($controller) {
    case 'product':
        $productController = new ProductController();
        switch ($action) {
            case 'index':
                $productController->index();
                break;
            case 'create':
                $productController->create();
                break;
            case 'view':
                $productController->view();
                break;
            default:
                $productController->index();
                break;
        }
        break;
    case 'user':
        $userController = new UserController();
        switch ($action) {
            case 'register':
                $userController->register();
                break;
            case 'login':
                $userController->login();
                break;
            case 'logout':
                $userController->logout();
                break;
            default:
                $userController->login();
                break;
        }
        break;
    default:
        $productController = new ProductController();
        $productController->index();
        break;
}
?>
