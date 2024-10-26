<?php
class Login_Register_Model
{
    public $Database;
    public $SQL_Database;
    public function __construct()
    {
        $this->Database = new Database_Model();
        $this->SQL_Database = new SQL_Database();
    }
    public function Login_Model()
    {
        //============================================= Login Model =========================================
        if (isset($_POST['Sub_Login'])) {
            $User = $this->SQL_Database->Get_User();
            $Login_Account = $_POST['Login_Account'];
            $Login_Password = $_POST['Login_Password'];
            $Return_Login = '&Login_Account=' . $Login_Account . '&Login_Password=' . $Login_Password;
            if (empty($Login_Account)) {
                header('Location: index.php?action=user&useraction=login_register&Error_Message=Thông Tin Đăng Nhập Không Được Để Trống' . $Return_Login);
            } else if (empty($Login_Password)) {
                header('Location: index.php?action=user&useraction=login_register&Error_Message=Mật Khẩu Đăng Nhập Không Được Để Trống' . $Return_Login);
            } else {
                foreach ($User as $k => $Login) {
                    if (($Login_Account == $Login['Username'] || $Login_Account == $Login['Phone'] || $Login_Account == $Login['Email']) && (sha1($Login_Password) == $Login['Passwords']) && ($Login['Status'] == 1)) {
                        header('Location: index.php?action=user&useraction=login_register&Error_Message=Tài Khoản Bị Khóa' . $Return_Login);
                        exit();
                    } else if (($Login_Account == $Login['Username'] || $Login_Account == $Login['Phone'] || $Login_Account == $Login['Email']) && (sha1($Login_Password) == $Login['Passwords'])) {
                        $Login_Succes = ['ID' => $Login['ID'], 'Name' => $Login['Name'], 'Role' => $Login['Role']];
                        $_SESSION['user'] = $Login_Succes;
                        if ($Login['Role'] == 0 || $Login['Role'] == 1) {
                            $_SESSION['admin_u'] = $Login_Succes;
                        }
                        header('Location: index.php?action=user&useraction=login_register&Success_Message=Đăng Nhập Thành Công');
                        exit();
                    } else if (($Login_Account == $Login['Username'] || $Login_Account == $Login['Phone'] || $Login_Account == $Login['Email']) && (sha1($Login_Password) != $Login['Passwords'])) {
                        header('Location: index.php?action=user&useraction=login_register&Error_Message=Sai Mật Khẩu Đăng Nhập' . $Return_Login);
                        exit();
                    }
                }
                header('Location: index.php?action=user&useraction=login_register&Error_Message=Tài Khoản Không Tồn Tại' . $Return_Login);
            }
        }
    }
    public function Register_Model()
    {
        //=========================================  Register Model ========================================== 
        if (isset($_POST['Sub_Register'])) {
            $UserName = $_POST['Register_Username'];
            $UserPassword = $_POST['Register_Password'];
            $UserConfirmPassword = $_POST['Register_Confirm_Password'];
            $User_Name = $_POST['Register_Name'];
            $UserPhone = $_POST['Register_Phone'];
            $UserEmail = $_POST['Register_Email'];
            $Return_Register = '&Register_Username=' . $UserName . '&Register_Password=' . $UserPassword . '&Register_Confirm_Password=' . $UserConfirmPassword . '&Register_Name=' . $User_Name . '&Register_Phone=' . $UserPhone . '&Register_Email=' . $UserEmail;
            if (empty($UserName)) {
                header('Location: index.php?action=user&useraction=login_register&Register=Yes&Error_Message=Không Được Bỏ Trống Username' . $Return_Register);
                exit();
            } else if (empty($UserPassword)) {
                header('Location: index.php?action=user&useraction=login_register&Register=Yes&Error_Message=Không Được Bỏ Trống Mật Khẩu' . $Return_Register);
                exit();
            } else if (strlen($UserPassword <= 8)) {
                header('Location: index.php?action=user&useraction=login_register&Register=Yes&Error_Message=Mật Khẩu Phải Lớn Hơn 8 Ký Tự' . $Return_Register);
                exit();
            } else if (empty($UserConfirmPassword)) {
                header('Location: index.php?action=user&useraction=login_register&Register=Yes&Error_Message=Không Được Bỏ Trống Xác Nhận Mật Khẩu' . $Return_Register);
                exit();
            } else if ($UserPassword != $UserConfirmPassword) {
                header('Location: index.php?action=user&useraction=login_register&Register=Yes&Error_Message=Mật Khẩu Xác Nhận Không Đúng' . $Return_Register);
                exit();
            } else if (empty($UserPhone)) {
                header('Location: index.php?action=user&useraction=login_register&Register=Yes&Error_Message=Không Được Bỏ Trống Số Điện Thoại' . $Return_Register);
                exit();
            } else if (empty($UserEmail)) {
                header('Location: index.php?action=user&useraction=login_register&Register=Yes&Error_Message=Không Được Bỏ Trống Email' . $Return_Register);
                exit();
            } else {
                $Check_Exits = $this->SQL_Database->Get_User();
                foreach ($Check_Exits as $k => $Exits) {
                    if ($UserName == $Exits['Username']) {
                        header('Location: index.php?action=user&useraction=login_register&Register=Yes&Error_Message=Tài Khoản Đã Tồn Tại' . $Return_Register);
                        exit();
                    } else if ($UserEmail == $Exits['Email']) {
                        header('Location: index.php?action=user&useraction=login_register&Register=Yes&Error_Message=Email Đã Được Đăng Ký' . $Return_Register);
                        exit();
                    } else if ($UserPhone == $Exits['Phone']) {
                        header('Location: index.php?action=user&useraction=login_register&Register=Yes&Error_Message=Số Điện Thoại Đã Được Đăng Ký' . $Return_Register);
                        exit();
                    }
                }
                $Register_User = [
                    'Username' => $UserName,
                    'Passwords' => sha1($UserPassword),
                    'Image' => '',
                    'Name' => $User_Name,
                    'Phone' => $UserPhone,
                    'Email' => $UserEmail,
                    'Role' => 2,
                    'Status' => 0
                ];
                $Conn = $this->Database->Connect();
                $Sql = "INSERT INTO users (Username,Passwords,Name,Image,Phone,Email,Role,Status) Values
                (:Username,:Passwords,:Name,:Image,:Phone,:Email,:Role,:Status);";
                $stmt = $Conn->prepare($Sql);
                $stmt->execute($Register_User);
                $Conn = null;
                header('Location: index.php?action=user&useraction=login_register&Register=Yes&Success_Message=Đăng Ký Thành Công' . $Return_Register);
                exit();
            }
        }
    }

    public function Forgot_Password()
    {
        //=========================================  Forgot Password Model ========================================== 
        if (isset($_POST['Sub'])) {
            $Login_Infor = $_POST['Login-Infor'];
            $New_Pass = $_POST['New-Pass'];
            $Confirm_New_Pass = $_POST['Confirm-New-Pass'];
            $Return_Forgot_Pas = '&Login-Infor='. $Login_Infor . '&New-Pass='. $New_Pass . '&Confirm-New-Pass='. $Confirm_New_Pass;
            if (empty($Login_Infor)) {
                header('Location: index.php?action=user&useraction=forgot-password&Error_Message=Không Được Bỏ Trống Thông Tin Đăng Nhập'. $Return_Forgot_Pas);
                exit();
            } else if (empty($New_Pass)) {
                header('Location: index.php?action=user&useraction=forgot-password&Error_Message=Không Được Bỏ Trống Mật Khẩu Mới'. $Return_Forgot_Pas);
                exit();
            } else if (empty($Confirm_New_Pass)) {
                header('Location: index.php?action=user&useraction=forgot-password&Error_Message=Không Được Bỏ Trống Xác Nhận Mật Khẩu Mới'. $Return_Forgot_Pas);
                exit();
            } else {
                $Check_Exits = $this->SQL_Database->Get_User();
                $Update = 0;
                foreach ($Check_Exits as $k => $Exits) {
                    if ($Login_Infor == $Exits['Email'] || $Login_Infor == $Exits['Username'] || $Login_Infor == $Exits['Phone'] && $New_Pass == $Confirm_New_Pass) {
                        if (sha1($New_Pass) == $Exits['Passwords']) {
                            header('Location: index.php?action=user&useraction=forgot-password&Error_Message=Mật Khẩu Mới Phải Khác Với Mật Khẩu Cũ'. $Return_Forgot_Pas);
                            exit();
                        }
                        $New_Info = ['Passwords' => sha1($New_Pass), 'ID' => $Exits['ID']];
                        $Connect = $this->Database->Connect();
                        $Sql_Update_Password = "UPDATE users SET Passwords = :Passwords WHERE ID = :ID";
                        $stml = $Connect->prepare($Sql_Update_Password);
                        $stml->execute($New_Info);
                        $Conn = null;
                        $Update = 1;
                        header('Location: index.php?action=user&useraction=forgot-password&Success_Message=Mật Khẩu Mới Đã Được Cập Nhật'. $Return_Forgot_Pas);
                        exit();

                    }
                }
                if ($Update == 0) {
                    header('Location: index.php?action=user&useraction=forgot-password&Error_Message=Thông Tin Đăng Nhập Không Tồn Tại');
                    exit();
                }
            }
        }
    }
}
