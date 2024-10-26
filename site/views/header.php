<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizon Store</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/all.css">
</head>

<body> 
    <input type="checkbox" class="White-Dark" id="BGC" <?php  if (isset($_SESSION['Themer']) && $_SESSION['Themer'] == 1) {echo 'checked';} ?>>
    <header>
        <div class="header-bar">
            <div class="logo">
                <a href="index.php"><img src="public/img/Page/Horizon_Logo_M.png" alt=""></a>
            </div>
            <form class="search" method="post" action="index.php?action=products&product-action=search">
                <input type="text" name="Search" placeholder="Search">
                <input class="button-search" name="Sub" type="submit" value="Search"></input>
            </form>
            <div class="menu-right">
                <ul>
                <div class="Header-Profile">
                    <?php
                    if (isset($_SESSION['user'])) {
                        $User_Login = $_SESSION['user'];
                        $Role_Account = ($User_Login['Role'] == 0 || $User_Login['Role'] == 1)? 'Admin':'User' ; 
                        $Avatar = '';
                        echo '<li><a href="index.php?action=user&useraction=profile">Xin Chào ' . $Role_Account . ' ' . $User_Login['Name'] . '</a></li>';
                        echo '<li><a href="index.php?action=user&useraction=logout">Đăng Xuất</a></li>';
                    } else {
                        echo '<li><a href="index.php?action=user&useraction=login_register">Đăng Nhập / Đăng Ký</a></li>';
                    }
                    ?>
                    </div>
                    <div class="Menu-Main">
                        <li><a href="index.php?action=cart"><i class="fa-solid fa-bag-shopping"></i> Giỏ Hàng </a></li>
                        <li class="Themer"><a href="<?php
                            if (isset($_SESSION['Themer']) && $_SESSION['Themer'] == 1){
                                echo 'index.php?Theme=Light';
                            } else if (isset($_SESSION['Themer']) && $_SESSION['Themer'] == 0){
                                echo 'index.php?Theme=Dark';
                            }
                        ?>"><label class="Switch" for="BGC"><i class="fa-solid fa-palette" style="background-color: transparent;"></i></label></a></li>
                    </div>
                </ul>
            </div>
            <?php echo isset($_SESSION['admin_a'])? '<a href="admin.php" class="Admin-Dashboard">Go To Admin Dashboard</a>' : ''; ?>
        </div>
    </header>
    <nav class="User-Nav-Page">
        <div class="container">
            <div class="menu">
                <ul>
                    <li><a href="index.php"><i class="fa-solid fa-house" style="color: rgb(150,150,150);"></i> Trang Chủ</a></li>
                    <li><a href="index.php?action=products">Sản Phẩm</a></li>
                    <li><a href="index.php?action=sale">Khuyến Mãi</a></li>
                    <li><a href="index.php?action=about">Về Chúng Tôi</a></li>
                    <li><a href="index.php?action=contact">Liên Hệ</a></li>
                </ul>
            </div>
        </div>
    </nav>