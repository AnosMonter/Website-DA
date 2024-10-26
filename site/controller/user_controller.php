<?php
class User_Controller
{
    public $User_Action;
    public function __construct($Act)
    {
        $this->User_Action = $Act;
    }
    public function login_register()
    {
        $Database = new Database_Model();
        switch ($this->User_Action) {
            case 'login_register':
                if (isset($_POST['Sub_Login'])) {
                    $Succes = 0;
                    $sql = "SELECT * FROM users;";
                    $User = $Database->Query($sql);
                    $Login_Account = $_POST['Login_Account'];
                    $Login_Password = $_POST['Login_Password'];
                    $Return_Login = '&Login_Account=' . $Login_Account . '&Login_Password=' . $Login_Password;
                    if (empty($Login_Account)) {
                        header('Location: index.php?action=user&useraction=login_register&Error_Message=Thông Tin Đăng Nhập Không Được Để Trống' . $Return_Login);
                    } else if (empty($Login_Password)) {
                        header('Location: index.php?action=user&useraction=login_register&Error_Message=Mật Khẩu Đăng Nhập Không Được Để Trống' . $Return_Login);
                    } else {
                        foreach ($User as $k => $Login) {
                            if (($Login_Account == $Login['Username'] || $Login_Account == $Login['Phone'] || $Login_Account == $Login['Email']) && $Login_Password == $Login['Passwords']) {
                                $Login_Succes = ['ID'=>$Login['ID'],'Name' => $Login['Name'], 'Role' => $Login['Role']];
                                setcookie('user', json_encode($Login_Succes), time() + 3600);
                                $Succes = 1;
                                header('Location: index.php?action=user&useraction=login_register&Success_Message=Đăng Nhập Thành Công');
                            } else if (($Login_Account == $Login['Username'] || $Login_Account == $Login['Phone'] || $Login_Account == $Login['Email']) && $Login_Password != $Login['Passwords']) {
                                header('Location: index.php?action=user&useraction=login_register&Error_Message=Sai Mật Khẩu Đăng Nhập' . $Return_Login);
                            }
                        }
                        if ($Succes == 0) {
                            header('Location: index.php?action=user&useraction=login_register&Error_Message=Tài Khoản Không Tồn Tại' . $Return_Login);
                        }
                    }
                }
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
                        $Check_Exits = $Database->Query("Select * from users");
                        foreach ($Check_Exits as $k => $Exits) {
                            if ($UserName == $Exits['Username']) {
                                header('Location: index.php?action=user&useraction=login_register&Register=Yes&Error_Message=Tài Khoản Đã Tồn Tại' . $Return_Register);
                                exit();
                            }
                        }
                        $Register_User = ['Username' => $UserName, 'Passwords' => $UserPassword, 'Image'=>'', 'Name' => $User_Name, 'Phone' => $UserPhone, 'Email' => $UserEmail, 'Role' => 'user'];
                        $Database->Insert_Values('users', $Register_User);
                        header('Location: index.php?action=user&useraction=login_register&Register=Yes&Success_Message=Đăng Ký Thành Công');
                    }
                }
                include_once 'site/views/login_register.php';
                break;
            case 'logout':
                setcookie('user', '', 0);
                header('Location: index.php');
                break;
            case 'profile':
                $User_Login_Success = json_decode($_COOKIE['user'], true);
                $sql_select_user = 'SELECT * FROM `users` WHERE `id` = '.$User_Login_Success['ID'];
                $Infor_User = $Database->Query($sql_select_user);
                include_once 'site/views/profile.php';
                break;
            default:

        }
    }
}
