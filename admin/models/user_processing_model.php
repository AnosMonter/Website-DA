<?php 
class User_Processing_Model {
    public $Database;
    public $SQL_Database;
    public function __construct() {
        $this->Database = new Database_Model();
        $this->SQL_Database = new SQL_Database();
    }

    public function List_Users() {
        return $this->SQL_Database->Get_User();
    }

    public function Edit_User($ID) {
        $Profile = $this->SQL_Database->Get_User_By_ID($ID);
        
    }
}