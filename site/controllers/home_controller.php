<?php
class Home_Controller{
    public $Database;
    public $SQL_Database;
    public function __construct(){
        $this->Database = new Database_Model();
        $this->SQL_Database = new SQL_Database(); 
    }

    public function index(){
        $Conn = $this->Database->Connect();
        $sql = "SELECT * FROM products WHERE Sale >= 10 ORDER BY Sale DESC Limit 8";
        $stml = $Conn->prepare($sql);
        $stml->execute();
        $List_Sale_Products = $stml->fetchAll();
        $List_Cat = $this->SQL_Database->Get_Categories();
        $Top_View = $this->SQL_Database->Get_Top_Products_By_Collum('View','5');
        include_once 'site/views/home.php';
    }
}