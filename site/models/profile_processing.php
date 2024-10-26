<?php
class Profile_Model
{
    public $Database;
    public $SQL_Database;
    public function __construct()
    {
        $this->Database = new Database_Model();
        $this->SQL_Database = new SQL_Database();
    }
    public function Update_Profile()
    {
        if (isset($_POST['Sub_Update_Profile'])) {
            $Info_User_Login = $_SESSION['user'];
            $Infor_User = $this->SQL_Database->Get_User_By_ID($Info_User_Login['ID']);
            $List_Users_Check = $this->SQL_Database->Get_User_Not_ID($Info_User_Login['ID']);
            $New_Username = $_POST['New_Username'];
            $New_Name = $_POST['New_Name'];
            $New_Email = $_POST['New_Email'];
            $New_Phone = $_POST['New_Phone'];
            $Old_Image = $_POST['Old_Image'];
            $Password = $_POST['Password'];
            $Return_Update_Profile = '&Username=' . $New_Username . '&Email=' . $New_Email . '&Phone=' . $New_Phone . '&Name=' . $New_Name;
            foreach ($List_Users_Check as $User_Exits) {
                if ($User_Exits['Username'] == $New_Username){
                    $UserName_Exit = 1;
                }
                if ($User_Exits['Phone'] == $New_Phone){
                    $Phone_Exit = 1;
                }
                if ($User_Exits['Email'] == $New_Email){
                    $Email_Exit = 1;
                }
            }
            if (empty($New_Username)) {
                header('Location: index.php?action=user&useraction=profile&Error_Message=Không được bỏ trống Username' . $Return_Update_Profile);
                exit();
            } else if (empty($New_Name)) {
                header('Location: index.php?action=user&useraction=profile&Error_Message=Không được bỏ trống Name' . $Return_Update_Profile);
                exit();
            } else if (empty($New_Email)) {
                header('Location: index.php?action=user&useraction=profile&Error_Message=Không được bỏ trống Email' . $Return_Update_Profile);
                exit();
            } else if (empty($New_Phone)) {
                header('Location: index.php?action=user&useraction=profile&Error_Message=Không được bỏ trống Phone' . $Return_Update_Profile);
                exit();
            } else if (empty($Password)) {
                header('Location: index.php?action=user&useraction=profile&Error_Message=Nhập Password Để Xác Nhận Thay Đổi Thông Tin' . $Return_Update_Profile);
                exit();
            } else if (sha1($Password) != $Infor_User[0]['Passwords']) {
                header('Location: index.php?action=user&useraction=profile&Error_Message=Mật Khẩu Không Đúng' . $Return_Update_Profile);
                exit();
            } else 
                if ($UserName_Exit == 1) {
                header('Location: index.php?action=user&useraction=profile&Error_Message=Username đã tồn tại' . $Return_Update_Profile);
                exit();
            } else if ($Phone_Exit == 1) {
                header('Location: index.php?action=user&useraction=profile&Error_Message=Số điện thoại đã được đăng ký' . $Return_Update_Profile);
                exit();
            } else if ($Email_Exit == 1) {
                header('Location: index.php?action=user&useraction=profile&Error_Message=Email đã được đăng ký' . $Return_Update_Profile);
                exit();
            } else {
                $New_Image_Exits = empty($_FILES['New_Image']['name']) ? 0 : 1;
                $New_Image_Name = $_FILES['New_Image']['name'];
                $New_Image_Tmp_Name = $_FILES['New_Image']['tmp_name'];
                if ($New_Image_Exits == 1) {
                    $New_Name_Image = 'Users' . $Infor_User[0]['ID'] . strrchr($New_Image_Name, '.');
                } else {
                    $New_Name_Image = $Infor_User[0]['Image'];
                }
                $File_Dir = 'public/img/Users/';
                if (file_exists($File_Dir . $Old_Image) && $New_Image_Exits == 1) {
                    unlink($File_Dir . $Old_Image);
                }
                if ($New_Image_Exits == 1) {
                    if (move_uploaded_file($New_Image_Tmp_Name, $File_Dir . $New_Name_Image) === false) {
                        header('Location: index.php?action=user&useraction=profile&Error_Message= Không thể upload ảnh' . $Return_Update_Profile);
                        exit();
                    }
                }
                $New_Infor = ['Username' => $New_Username, 'Name' => $New_Name, 
                'Image' => $New_Name_Image, 'Phone' => $New_Phone, 'Email' => $New_Email, 'ID' => $Infor_User[0]['ID']];
                $Conn = $this->Database->Connect();
                $sql_update_user = 'UPDATE `users` SET `Username` =:Username, `Name` =:Name, `Image` =:Image, 
                `Phone` = :Phone, `Email` = :Email WHERE `ID` =:ID';
                $stmt = $Conn->prepare($sql_update_user);
                $stmt->execute($New_Infor);
                header('Location: index.php?action=user&useraction=profile&Success_Message=Cập Nhật Thông Tin Thành Công' . $Return_Update_Profile);
                exit();
            }
        }
    }
    public function Update_Password()
    {
        if (isset($_POST['Sub_Update_Password'])) {
            $Database = new Database_Model();
            $Info_User_Login = $_SESSION['user'];
            $Infor_User = $this->SQL_Database->Get_User_By_ID($Info_User_Login['ID']);
            $Old_Password = $_POST['Old_Password'];
            $New_Password = $_POST['New_Password'];
            $New_Confirm_Password = $_POST['Confirm_Password'];
            $Return_Update_Password = '&Old_Password=' . $Old_Password . '&New_Password=' . $New_Password . '&Confirm_Password=' . $New_Confirm_Password;
            if (empty($Old_Password)) {
                header('Location: index.php?action=user&useraction=profile&Check=1&Error_Message=Không được bỏ trống Old Password' . $Return_Update_Password);
                exit();
            } else if (empty($New_Password)) {
                header('Location: index.php?action=user&useraction=profile&Check=1&Error_Message=Không được bỏ trống New Password' . $Return_Update_Password);
                exit();
            } else if (empty($New_Confirm_Password)) {
                header('Location: index.php?action=user&useraction=profile&Check=1&Error_Message=Không được bỏ trống Confirm Password' . $Return_Update_Password);
                exit();
            } else if ($New_Password != $New_Confirm_Password) {
                header('Location: index.php?action=user&useraction=profile&Check=1&Error_Message=Mật Khẩu Không Trùng Khớp' . $Return_Update_Password);
                exit();
            } else if (sha1($Old_Password) != $Infor_User[0]['Passwords']) {
                header('Location: index.php?action=user&useraction=profile&Check=1&Error_Message=Mật Khẩu Cũ Không Đúng' . $Return_Update_Password);
                exit();
            } else if (strlen($New_Password) < 8) {
                header('Location: index.php?action=user&useraction=profile&Check=1&Error_Message=Mật Khẩu Mới Phải Lớn Hơn Hoặc Bằng 8 Ký Tự' . $Return_Update_Password);
                exit();
            } else if ($Old_Password == $New_Password) {
                header('Location: index.php?action=user&useraction=profile&Check=1&Error_Message=Mật Khẩu Mới Phải Khác Mật Khẩu Cũ' . $Return_Update_Password);
                exit();
            } else {
                $New_Info = ['Passwords' => sha1($New_Password), 'ID'=> $Infor_User[0]['ID']];
                $Connect = $this->Database->Connect();
                $Sql_Update_Password = "UPDATE users SET Passwords = :Passwords WHERE ID = :ID";
                $stml = $Connect->prepare($Sql_Update_Password);
                $stml->execute($New_Info);
                $Conn = null;
                header('Location: index.php?action=user&useraction=profile&Check=1&Success_Message=Cập Nhật Mật Khẩu Thành Công' . $Return_Update_Password);
                exit();
            }
        }
    }
}
