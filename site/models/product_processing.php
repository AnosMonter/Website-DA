<?php
class Product_Processing_Model
{
    public $SQL_Database;
    public function __construct()
    {
        $this->SQL_Database = new SQL_Database();
    }
    public function Product_Page(){
        $List_Products = $this->SQL_Database->Get_Products();
        $List_Categories = $this->SQL_Database->Get_Categories();
        return [$List_Categories,$List_Products];
    }
    public function Detail_Page($id){
        $Product_Detail = $this->SQL_Database->Get_Product_By_ID($id);
        $Product_By_Category = $this->SQL_Database->Get_Product_By_Categories_Not_Product($Product_Detail[0]['Cat_ID'],$Product_Detail[0]['ID']);
        $Catergory_Product = $this->SQL_Database->Get_Category_By_ID($Product_Detail[0]['Cat_ID']);
        return [$Product_Detail,$Product_By_Category,$Catergory_Product];
    }

    public function Filter_Categories($id){
        $List_Categories = $this->SQL_Database->Get_Categories();
        $List_Products = $this->SQL_Database->Get_Product_By_Category($id);
        return [$List_Categories,$List_Products];
    }

    public function Search_Product_Name($Name){
        $List_Products = $this->SQL_Database->Search_Products_By_Name($Name);
        return $List_Products;
    }

    public function Add_Comment($id_prd,$Comment){
        $ID_User = $_SESSION['user']['ID'];
        if ($this->SQL_Database->Add_Comment($id_prd,$ID_User,$Comment) === false){ return false; } else { return true; }
    }
}
