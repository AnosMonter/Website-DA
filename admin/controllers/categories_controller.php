<?php
class Categories_Controller
{
    public $Categories_Processing;
    public function __construct()
    {
        include_once 'admin/models/categories_processing.php';
        $this->Categories_Processing = new Categories_Processing_Model();
    }
    public function Categories($Action,$id)
    {
        switch ($Action) {
            case '':
                $List_Categories = $this->Categories_Processing->List_Categories();
                include_once 'admin/views/categories.php';
                break;
            case 'add':
                $this->Categories_Processing->Add_Category();
                include_once 'admin/views/categories.php';
                break;
            case 'edit':
                $Database = $this->Categories_Processing->Database->Connect();
                $sql_cat = "SELECT * FROM categories WHERE id = :id";
                $stmt = $Database->prepare($sql_cat);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $Infor_Category = $stmt->fetchAll();
                $this->Categories_Processing->Edit_Category($id);
                include_once 'admin/views/edit_category.php';
                break;
            case 'delete':
                $this->Categories_Processing->Delete_Category($id);
                break;
        }
    }
}
