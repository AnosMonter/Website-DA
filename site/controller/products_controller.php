<?php
class Products_Controller{
    public function Products(){
        $Databases = new Database_Model();
        $sql = "SELECT * FROM products";
        $List_Products = $Databases->Query($sql);
        include_once '../../site/views/products.php';
    }
}