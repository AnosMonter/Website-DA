<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $database = new Database_Model();
    $sql_database = new SQL_Database();
    $result = $sql_database->Get_User();
    $return_admin_login = '&Username='. $username;
    foreach ($result as $col => $row) {
        if ($row['Username'] == $username && $row['Passwords'] == sha1($password) && ($row['Role'] == 0 || $row['Role'] == 1)) {
            $_SESSION['admin_a'] = ['ID' => $row['ID'],'Name' => $row['Name'], 'Role' => $row['Role']];
            header('Location: admin.php');
            exit;
        } else if ($row['Username'] == $username && $row['Passwords'] != sha1($password)) {
            header('Location: admin.php?Error=Mật Khẩu Không Đúng'.$return_admin_login);
            exit;
        }
    }
    header('Location: admin.php?Error=Tài Khoản Không Tồn Tại'. $return_admin_login);
    exit();
}
