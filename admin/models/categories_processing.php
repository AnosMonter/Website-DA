<?php
class Categories_Processing_Model
{
    public $Database;
    public $SQL_Database;
    public function __construct()
    {
        $this->Database = new Database_Model();
        $this->SQL_Database = new SQL_Database();
    }
    public function List_Categories()
    {
        $List_Categories = $this->SQL_Database->Get_Categories();
        return $List_Categories;
    }

    public function Add_Category()
    {
        if (isset($_POST['Add_Category'])) {
            $Name = $_POST['Name'];
            $Image_Name = $_FILES['Image']['name'];
            $tmp_name = $_FILES['Image']['tmp_name'];
            $Return = '&Name='. $Name;
            if (empty($Name)) {
                header('Location: admin.php?Admin_Action=categories&Error_Massage=Không được bỏ trống Name'. $Return);
                exit();
            } else if (empty($Image_Name)) {
                header('Location: admin.php?Admin_Action=categories&Error_Massage=Không được bỏ trống Image'. $Return);
                exit();
            } else {
                $File_Dir = 'public/img/Categories/';
                $New_Name_Image = 'Categories' . $Name . strrchr($Image_Name, '.');
                if (move_uploaded_file($tmp_name, $File_Dir . $New_Name_Image) == false) {
                    header('Location: admin.php?Admin_Action=categories&Error_Massage=Thêm Ảnh Thất Bại'. $Return);
                    exit();
                };
                $Category_Exit = $this->List_Categories();
                foreach ($Category_Exit as $Cat){
                    if (preg_replace('/[^A-Za-z0-9]/', '', strtolower($Cat['Name'])) == preg_replace('/[^A-Za-z0-9]/', '', strtolower($Name))) {
                        header('Location: admin.php?Admin_Action=categories&Error_Massage=Tên Loại Sản Phẩm đã tồn tại'. $Return);
                        exit();
                    }
                }
                $sql = "INSERT INTO categories (name,image) VALUES (:name,:image)";
                $connect = $this->Database->Connect();
                $stml = $connect->prepare($sql);
                $stml->bindParam(':name', $Name);
                $stml->bindParam(':image', $New_Name_Image);
                $stml->execute();
                header('Location: admin.php?Admin_Action=categories&Success_Massage=Thêm Thành Công'. $Return);
                exit();
            }
        }
    }

    public function Edit_Category($id)
    {
        if (isset($_POST['Edit_Category'])) {
            $id = $_POST['ID'];
            $name = $_POST['Name'];
            $image = $_FILES['Image']['name'];
            $tmp_name = $_FILES['Image']['tmp_name'];
            $Old = $_POST['Old_Image'];
            $Return_Edit_Category = '&Name='.$name;
            if (empty($name)) {
                header('Location: admin.php?Admin_Action=categories&Category_Action=edit&Error_Massage=Không được bỏ trống Name'.$Return_Edit_Category);
                exit();
            } else {
                if (!empty($image)) {
                    $Check_Image = 1;
                } else {
                    $Check_Image = 0;
                    $New_Name_Image = $Old;
                }
                if ($Check_Image == 1) {
                    $File_Dir = 'public/img/Categories/';
                    $New_Name_Image = 'Categories' . $name . strrchr($image, '.');
                    if (file_exists($File_Dir . $Old)) {
                        unlink($File_Dir . $Old);
                    }
                    if (move_uploaded_file($tmp_name, $File_Dir . $New_Name_Image) == false) {
                        header('Location: admin.php?Admin_Action=categories&Category_Action=edit&Error_Massage=Sửa ảnh Thất Bại'.$Return_Edit_Category);
                        exit();
                    }
                } 
                $sql = "UPDATE categories SET name = :name, image = :image WHERE id = :id";
                $connect = $this->Database->Connect();
                $stml = $connect->prepare($sql);
                $stml->bindParam(':name', $name);
                $stml->bindParam(':image', $New_Name_Image);
                $stml->bindParam(':id', $id);
                $stml->execute();
                $connect = null;
                header('Location: admin.php?Admin_Action=categories&Category_Action=edit&Success_Message=Sửa Sản Phẩm Thành Công'.$Return_Edit_Category.'&New_Image='.$New_Name_Image);
                exit();
            }
        }
    }

    public function Delete_Category($id)
    {   
        $connect = $this->Database->Connect();
        $sql_check_cat = "SELECT * FROM products WHERE Cat_ID = :id";
        $stml_check_cat = $connect->prepare($sql_check_cat);
        $stml_check_cat->bindParam(':id', $id);
        $stml_check_cat->execute();
        $row_check_cat = $stml_check_cat->fetchAll();
        if (count($row_check_cat) > 0) {
            $Noitificate = 'Danh Mục Còn '. count($row_check_cat).' Sản Phẩm Đang Liên Kết';
            header('Location: admin.php?Admin_Action=categories&Error_Message='.$Noitificate);
            exit();
        }
        $sql_Cat = "SELECT * FROM categories WHERE id = :id";
        $stml = $connect->prepare($sql_Cat);
        $stml->bindParam(':id', $id);
        $stml->execute();
        $row = $stml->fetchAll();
        $image = $row[0]['Image'];
        if (file_exists('public/img/Categories/' . $image)) {
            if (unlink('public/img/Categories/' . $image) == false) {
                header('Location: admin.php?Admin_Action=categories&Error_Message=Xóa Thất Bại');
                exit();
            }
        }
        $sql = "DELETE FROM categories WHERE id = :id";
        $stml1 = $connect->prepare($sql);
        $stml1->bindParam(':id', $id);
        $stml1->execute();
        header('Location: admin.php?Admin_Action=categories&Success_Message=Xóa Thành Công');
        exit();
    }
}
