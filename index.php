<?php
include_once 'site/views/header.php';
include_once 'system/core/config.php';
include_once 'system/core/Database.php';
$Action = isset($_GET['action']) ? $_GET['action'] : 'index';
$User_Action = isset($_GET['useraction']) ? $_GET['useraction'] : '';
$Product_Action = isset($_GET['product-action']) ? $_GET['product-action'] : '';
$Cart_Action = isset($_GET['cart-action']) ? $_GET['cart-action'] : '';
$Id = isset($_GET['id']) ? $_GET['id'] : '';
switch ($Action) {
    case 'index':
        include_once 'site/controllers/home_controller.php';
        $Home_Page = new Home_Controller();
        $Home_Page->index();
        break;
    case 'products':
        include_once 'site/controllers/products_controller.php';
        $Products_Page = new Products_Controller();
        $Products_Page->Products($Product_Action, $Id);
        break;
    case 'user':
        include_once 'site/controllers/user_controller.php';
        $User_Page = new User_Controller($User_Action);
        $User_Page->User_Processing();
        break;
    case 'cart':
        include_once 'site/controllers/cart_controller.php';
        $Cart_Page = new Cart_Controller($Cart_Action,$Id);
        $Cart_Page->Cart_Processing();
        break;
    case 'deletecart':
        unset($_SESSION['cart']);
        header('Location: index.php');
        exit();
        break;
    default:
        header("Location: error404.html");
        break;
}
include_once 'site/views/footer.php';
