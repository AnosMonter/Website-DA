<?php
class Products_Controller
{
    public $Products_Processing;
    public function __construct()
    {
        include_once 'admin/models/product_processing.php';
        $this->Products_Processing = new Product_Processing_Model();
    }
    public function index($action, $id)
    {
        switch ($action) {
            case '':
                $Data_Base = $this->Products_Processing->Database;
                $sql_cat = "SELECT * FROM categories;";
                $sql_prod = "SELECT * FROM products;";
                $All_categories = $Data_Base->Query($sql_cat);
                $All_products = $Data_Base->Query($sql_prod);
                include_once 'admin/views/products.php';
                break;
            case 'add':
                $this->Products_Processing->Add_Product();
                include_once 'admin/views/products.php';
                break;
            case 'edit':
                if (isset($id)) {
                    $sql_cat = "SELECT * FROM categories;";
                    $All_categories = $this->Products_Processing->Database->Query($sql_cat);
                    $sql = "SELECT * FROM products where id = :id";
                    $connect = $this->Products_Processing->Database->Connect();
                    $stmt = $connect->prepare($sql);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    $Infor_Product = $stmt->fetchAll();
                }
                $this->Products_Processing->Edit_Product($id);
                include_once 'admin/views/edit_products.php';
                break;
            case 'delete':
                $this->Products_Processing->Delete_Product($id);
                break;
        }
    }
}
