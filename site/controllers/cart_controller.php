<?php
class Cart_Controller{
    public $Cart_Action;
    public $id;
    public $Cart_Processing;
    public function __construct($Action,$id)
    {
        include_once 'site/models/cart_processing.php';
        $this->Cart_Processing = new Cart_Model();
        $this->Cart_Action = $Action;
        $this->id = $id;
    }

    public function Cart_Processing(){
        switch ($this->Cart_Action){
            case '':
                include_once 'site/views/cart.php';
                break;
            case 'add':
                if (!isset($_SESSION['user'])){
                    header('Location: index.php?action=products&product-action=detail&id='.$this->id.'&Error_Message=Bạn Cần Đăng Nhập Để Thêm Sản Phẩm Vào Giỏ Hàng');
                    exit();
                }
                $this->Cart_Processing->Add_Product_Cart($this->id);
                break;
            case 'remove':
                $this->Cart_Processing->Delete_Product_Cart($this->id);
                include_once 'site/views/cart.php';
                break;
            case 'update':
            default:
                include_once 'site/views/cart.php';
                break;
        }
    }
}