<?php 
class Comment_Model{
    public $Database;
    public $SQL_Database;
    public function __construct(){
        $this->Database = new Database_Model();
        $this->SQL_Database = new SQL_Database();
    }
}
?>