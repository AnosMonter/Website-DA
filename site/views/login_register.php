<div class="User-Page">
    <div class="Notification">
        <?php
        if (isset($_GET['Error_Message'])) {
            echo '<div class="Show-Notification" style="color: red;">' . $_GET['Error_Message'] .'</div>';
        }

        if (isset($_GET['Success_Message'])) {
            echo '<div class="Show-Notification" style="color: green;">' . $_GET['Success_Message'] . ' Quay lại trang chủ sau 3s</div>';
            header('Refresh: 3; URL=index.php');
        }
        ?>
    </div>
    <div class="Frame">
        <input type="checkbox" id="Login-Register" class="Box-Log-Reg" <?php echo isset($_GET['Register']) ? 'checked' : '' ?>>
        <form action="index.php?action=user&useraction=login_register" class="Login" method="post">
            <h1>Login</h1>
            <img src="public/img/Page/Horizon_Logo_M.png" alt="">
            <b>Account</b>
            <input type="text" name="Login_Account" placeholder="Phone / Email / Username" value="<?php echo isset($_GET['Login_Account']) ? $_GET['Login_Account'] : '' ?>">
            <b>Password</b>
            <input type="password" name="Login_Password" placeholder="Password" value="<?php echo isset($_GET['Login_Password']) ? $_GET['Login_Password'] : '' ?>">
            <a href="index.php?action=user&useraction=forgot-password">Quên Mật Khẩu?</a>
            <input type="submit" name="Sub_Login" value="Đăng Nhập">
        </form>
        <form action="index.php?action=user&useraction=login_register" class="Register" method="post">
            <h1>Register</h1>
            <b>Username</b>
            <input type="text" name="Register_Username" placeholder="Username" value="<?php echo isset($_GET['Register_Username']) ? $_GET['Register_Username'] : '' ?>">
            <b>Password</b>
            <input type="password" name="Register_Password" placeholder="Password" value="<?php echo isset($_GET['Register_Password']) ? $_GET['Register_Password'] : '' ?>">
            <b>Confirm Password</b>
            <input type="password" name="Register_Confirm_Password" placeholder="Password" value="<?php echo isset($_GET['Register_Confirm_Password']) ? $_GET['Register_Confirm_Password'] : '' ?>">
            <b>Name</b>
            <input type="text" name="Register_Name" placeholder="Name" value="<?php echo isset($_GET['Register_Name']) ? $_GET['Register_Name'] : '' ?>">
            <b>Phone</b>
            <input type="text" name="Register_Phone" placeholder="Phone" value="<?php echo isset($_GET['Register_Phone']) ? $_GET['Register_Phone'] : '' ?>">
            <b>Email</b>
            <input type="text" name="Register_Email" placeholder="Email" value="<?php echo isset($_GET['Register_Email']) ? $_GET['Register_Email'] : '' ?>">
            <input type="submit" name="Sub_Register" value="Đăng Ký">
        </form>
        <div class="Hide-Form">
            <label class="Login_Button" for="Login-Register">Đăng Nhập</label>
            <label class="Register_Button" for="Login-Register">Đăng Ký</label>
        </div>
    </div>
</div>