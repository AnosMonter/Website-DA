<?php
class Home_Controller{
    public function index(){
        $Database = new Database_Model();
        $sql = "SELECT * FROM products WHERE Sale >= 20";
        $List_Sale_Products = $Database->Query($sql);
        $sql_cat = "SELECT * FROM categories;";
        $List_Cat = $Database->Query($sql_cat);
        include_once 'site/views/home.php';
    }
}