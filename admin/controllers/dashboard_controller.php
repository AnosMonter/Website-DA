<?php
class Dashboard_Controller{
    public $Dashboard_Model;
    public function __construct()
    {
        include_once 'admin/models/dashboard_model.php';
        $this->Dashboard_Model = new Dashboard_Model();
    }
    public function index(){
        $Dashboard = $this->Dashboard_Model->Dashboard_Page();
        include_once 'admin/views/dashboard.php';
    }
}