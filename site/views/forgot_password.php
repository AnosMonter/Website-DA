<div class="User-Page">
    <div class="Notification">
        <?php
        if (isset($_GET['Error_Message'])) {
            echo '<div class="Show-Notification" style="color: red;">' . $_GET['Error_Message'] . '</div>';
        }

        if (isset($_GET['Success_Message'])) {
            echo '<div class="Show-Notification" style="color: green;">' . $_GET['Success_Message'] . ' Quay Lại Trang Đăng Nhập Sau 3s</div>';
            header('Refresh: 3; URL=index.php?action=user&useraction=login_register');
        }
        ?>
    </div>
    <div class="Mini-Frame">
        <h1> Forgot Password </h1>
        <form action="index.php?action=user&useraction=forgot-password" method="post" class="Fogot-Password-Frame">
            <label>Login Infor: <input type="text" value="<?php echo isset($_GET['Login-Infor']) ? $_GET['Login-Infor'] : '' ?>" name="Login-Infor" placeholder="Email / Phone / User Name"></label>
            <label>New Password: <input type="password" value="<?php echo isset($_GET['New-Pass']) ? $_GET['New-Pass'] : '' ?>" name="New-Pass" placeholder="New Password"></label>
            <label>Confirm New Password: <input type="password" value="<?php echo isset($_GET['Confirm-New-Pass']) ? $_GET['Confirm-New-Pass'] : '' ?>" name="Confirm-New-Pass" placeholder="Confirm New Password"></label>
            <input type="submit" name="Sub" value="Resset Password">
        </form>
    </div>
</div>