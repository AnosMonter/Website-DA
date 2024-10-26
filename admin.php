<?php
session_start();
include_once 'system/core/config.php';
include_once 'system/core/Database.php';
if ((isset($_SESSION['admin_u']) || isset($_SESSION['admin_a'])) && (!empty($_SESSION['admin_u']) || !empty($_SESSION['admin_a']))) {
    include_once 'admin/views/header.php';
    $Admin_Action = isset($_GET['Admin_Action']) ? $_GET['Admin_Action'] : 'dashboard';
    $Products_Action = isset($_GET['Products_Action']) ? $_GET['Products_Action'] : '';
    $Category_Action = isset($_GET['Category_Action']) ? $_GET['Category_Action'] : '';
    $Users_Action = isset($_GET['User_Action'])? $_GET['User_Action'] : '';
    $id = isset($_GET['ID']) ? $_GET['ID'] : '';
    switch ($Admin_Action) {
        case 'dashboard':
            include_once 'admin/controllers/dashboard_controller.php';
            $Dashboard_Controller = new Dashboard_Controller();
            $Dashboard_Controller->index();
            break;
        case 'products':
            include_once 'admin/controllers/products_controller.php';
            $Products_Controller = new Products_Controller();
            $Products_Controller->index($Products_Action,$id);
            break;
        case 'categories':
            include_once 'admin/controllers/categories_controller.php';
            $Categories_Controller = new Categories_Controller();
            $Categories_Controller->Categories($Category_Action,$id);
            break;
        case 'users':
            include_once 'admin/controllers/users_controller.php';
            $Users_Controller = new Users_Controller();
            $Users_Controller->Users($Users_Action,$id);
            break;
        case 'loginadmin':
        case 'logoutadmin':
            unset($_SESSION['admin_a']);
            header('Location: index.php');
            break;
        case 'backtoindex':
            header('Location: index.php');
            break;
        default:
            header("Location: error404.php");
            break;
    }
    include_once 'admin/views/footer.php';
} else {
    include_once 'admin/models/login_model.php';
    include_once 'admin/views/login.php';
}
