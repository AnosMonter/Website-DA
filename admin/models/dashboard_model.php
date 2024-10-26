<?php 
class Dashboard_Model{
    public $Database;
    public $SQL_Database;
    public function __construct(){
        $this->Database = new Database_Model();
        $this->SQL_Database = new SQL_Database();
    }

    public function Dashboard_Page(){
        $Orders = $this->SQL_Database->Get_Orders();
        $Products = $this->SQL_Database->Get_Products();
        $Users = $this->SQL_Database->Get_User();
        return ['Products' => $Products, 'Users' => $Users, 'Orders' => $Orders];
    }
}

?>