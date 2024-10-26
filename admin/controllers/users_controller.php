<?php 
class Users_Controller{
    public $User_Processing_Model;
    public function __construct(){
        include_once 'admin/models/user_processing_model.php';
        $this->User_Processing_Model = new User_Processing_Model();
    }

    public function Users(){
        $List_Users = $this->User_Processing_Model->List_Users();
        include_once 'admin/views/users.php';
    }
}