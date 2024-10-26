<div class="Profile">
    <div class="Notification">
        <?php
        if (isset($_GET['Error_Message'])) {
            echo '<div class="Show-Notification" style="color: red;">' . $_GET['Error_Message'] . '</div>';
        }

        if (isset($_GET['Success_Message'])) {
            echo '<div class="Show-Notification" style="color: green;">' . $_GET['Success_Message'] . '</div>';
        }
        ?>
    </div>
    <div class="Profile-Farm">
        <div class="Old-Profile">
            <div class="Avatar">
                <?php
                if (!empty($Infor_User[0]['Image'])) {
                    echo '<img src="public/img/Users/' . $Infor_User[0]['Image'] . '" alt="">';
                } else {
                    echo '<div class="No-Avatar">' . substr($Infor_User[0]['Name'], 0, 1) . '</div>';
                }
                ?>
            </div>
            <div class="Show-Info">
                <fieldset>
                    <legend> User Name </legend>
                    <p><?php echo $Infor_User[0]['Username']; ?></p>
                </fieldset>
                <fieldset>
                    <legend> Email </legend>
                    <p><?php echo $Infor_User[0]['Email']; ?></p>
                </fieldset>
                <fieldset>
                    <legend> Phone </legend>
                    <p><?php echo $Infor_User[0]['Phone']; ?></p>
                </fieldset>
                <fieldset>
                    <legend> Name </legend>
                    <p><?php echo $Infor_User[0]['Name']; ?></p>
                </fieldset>
                <?php
                if ($Infor_User[0]['Role'] == 0 || $Infor_User[0]['Role'] == 1) {
                    echo '<fieldset class="Action-Profile">
                            <legend> Action </legend>
                            <a href="admin.php">Đi Đến Trang Quản Trị</a>
                        </fieldset>';
                }
                ?>
            </div>

        </div>
        <div class="Profile-Updates">
            <input type="checkbox" id="Action-Account" class="Select-Box-Change" <?php if (isset($_GET['Check']) && $_GET['Check'] == 1) {echo 'checked';} ?>>
            <div class="Select-Change">
                <label for="Action-Account" class="Select-Label-UpProfile">Cập Nhật Thông Tin</label>
                <label for="Action-Account" class="Select-Label-UpPassword">Cập Nhật Mật Khẩu</label>
                <div class="Show-Select-Change"></div>
            </div>
            <form action="index.php?action=user&useraction=profile" class="Update-Profile" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend> Username </legend>
                    <input type="text" name="New_Username" placeholder="Username" value="<?php echo isset($_GET['Username'])? $_GET['Username']:$Infor_User[0]['Username']; ?>">
                </fieldset>
                <fieldset>
                    <legend> Email </legend>
                    <input type="text" name="New_Email" placeholder="Email" value="<?php echo isset($_GET['Email'])? $_GET['Email']: $Infor_User[0]['Email']; ?>">
                </fieldset>
                <fieldset>
                    <legend> Phone </legend>
                    <input type="text" name="New_Phone" placeholder="Phone" value="<?php echo isset($_GET['Phone'])? $_GET['Phone']: $Infor_User[0]['Phone']; ?>">
                </fieldset>
                <fieldset>
                    <legend> Name </legend>
                    <input type="text" name="New_Name" placeholder="Name" value="<?php echo isset($_GET['Name'])? $_GET['Name']: $Infor_User[0]['Name']; ?>">
                </fieldset>
                <fieldset>
                    <legend> Avatar </legend>
                    <input type="file" name="New_Image">
                </fieldset>
                <fieldset>
                    <legend> Password </legend>
                    <input type="password" name="Password" placeholder="Password">
                </fieldset>
                <input type="hidden" name="Old_Image" value="<?php echo $Infor_User[0]['Image'] ?>">
                <input type="submit" name="Sub_Update_Profile" value="Update Profile">
            </form>
            <form action="" class="Update-Password" method="post">
                <fieldset>
                    <legend> Old Password </legend>
                    <input type="password" name="Old_Password" placeholder="Old Password" value="<?php echo isset($_GET['Old_Password'])? $_GET['Old_Password']:''; ?>">
                </fieldset>
                <fieldset>
                    <legend> New Password </legend>
                    <input type="password" name="New_Password" placeholder="New Password" value="<?php echo isset($_GET['New_Password'])? $_GET['New_Password']:''; ?>">
                </fieldset>
                <fieldset>
                    <legend> Confirm Password </legend>
                    <input type="password" name="Confirm_Password" placeholder="Confirm Password" value="<?php echo isset($_GET['Confirm_Password'])? $_GET['Confirm_Password']:''; ?>">
                </fieldset>
                <input type="submit" name="Sub_Update_Password" value="Update Password">
            </form>
        </div>
    </div>
</div>