<?php
class Products_Controller
{
    public $Databases;
    public $Product_Processing;
    public function __construct()
    {
        $this->Databases = new Database_Model();
        include_once 'site/models/product_processing.php';
        $this->Product_Processing = new Product_Processing_Model();
    }
    public function Products($Act_Product, $id)
    {
        switch ($Act_Product) {
            case '':
                $Page_Data = $this->Product_Processing->Product_Page();
                $List_Categories = $Page_Data[0];
                $List_Products = $Page_Data[1];
                include_once 'site/views/products.php';
                break;
            case 'detail':
                $Conn = $this->Databases->Connect();
                $Detail_Page = $this->Product_Processing->Detail_Page($id);
                $Product_Detail = $Detail_Page[0];
                $Category = $Detail_Page[2];
                include_once 'site/views/detail.php';
                break;
            case 'comment':
                if (isset($_POST['Sub'])) {
                    $Comment_Content = $_POST['Comment'];
                    $ID_PRD = $_POST['ID_PRD'];
                    if ($this->Product_Processing->Add_Comment($ID_PRD, $Comment_Content)) {
                        header("Location: index.php?action=products&product-action=detail&id=" . $ID_PRD . "&Success_Comment=Đã Đăng Bình Luận Thành Công");
                        exit();
                    } else {
                        header("Location: index.php?action=products&product-action=detail&id=" . $ID_PRD . "&Error_Comment=Đăng Bình Luận Thất Bại");
                        exit();
                    }
                }
                break;
            case 'fill-cat':
                $Fillter = $this->Product_Processing->Filter_Categories($id);
                $List_Categories = $Fillter[0];
                $List_Products = $Fillter[1];
                include_once 'site/views/products.php';
                break;
            case 'search':
                if (isset($_POST['Sub'])) {
                    $Key_Search = $_POST['Search'];
                    $List_Products = $this->Product_Processing->Search_Product_Name($Key_Search);
                    include_once 'site/views/SearchResult.php';
                }
                break;
        }
    }
}
