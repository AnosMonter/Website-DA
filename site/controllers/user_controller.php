<?php
class User_Controller
{
    public $Database;
    public $User_Action;
    public $SQL_Database;
    public $User;
    public function __construct($Act)
    {
        include_once 'site/models/login_register_model.php';
        $this->Database = new Database_Model();
        $this->SQL_Database = new SQL_Database();
        $this->User = new Login_Register_Model();
        $this->User_Action = $Act;
    }
    public function User_Processing()
    {
        switch ($this->User_Action) {
            case 'login_register':
                $this->User->Login_Model();
                $this->User->Register_Model();
                include_once 'site/views/login_register.php';
                break;
            case 'logout':
                unset($_SESSION['user']);
                unset($_SESSION['admin_u']);
                header('Location: index.php');
                exit();
                break;
            case 'profile':
                if (isset($_SESSION['user'])) {
                    $User_Login_Success = $_SESSION['user'];
                    $Infor_User = $this->SQL_Database->Get_User_By_ID($User_Login_Success['ID']);
                    include_once 'site/models/profile_processing.php';
                    $Profile = new Profile_Model();
                    $Profile->Update_Profile();
                    $Profile->Update_Password();
                    include_once 'site/views/profile.php';
                } else {
                    header('Location: index.php?action=user&useraction=login_register');
                    exit();
                }
                break;
            case 'forgot-password':
                $this->User->Forgot_Password();
                include_once 'site/views/forgot_password.php';
                break;
        }
    }
}
