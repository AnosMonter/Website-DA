<div class="Admin-Category-Page">
    <div class="Noitifications">
        <?php
        if (isset($_GET['Error_Message'])) {
            echo '<div class="Show-Notification" style="color: red;">' . $_GET['Error_Message'] . '</div>';
        } else if (isset($_GET['Success_Message'])) {
            echo '<div class="Show-Notification" style="color: green;">' . $_GET['Success_Message'] . '</div>';
        }
        ?>
    </div>
    <h1>EDIT CATEGORY</h1>
    <form action="admin.php?Admin_Action=categories&Category_Action=edit" method="post" enctype="multipart/form-data" class="Form-Edit-Category">
        <input type="hidden" name="ID" value="<?php echo isset($_GET['ID'])? $_GET['ID']: $Infor_Category[0]['ID']; ?>">
    <label>Name Category <br><input type="text" name="Name" value="<?php echo isset($_GET['Name']) ? $_GET['Name'] : $Infor_Category[0]['Name'] ?>" required placeholder="Name Category"></label>
        <label>Image <br><input type="file" name="Image"></label>
        <input type="hidden" name="Old_Image" value="<?php echo isset($_GET['New_Image'])? $_GET['New_Image'] : $Infor_Category[0]['Image']; ?>">
        <input type="submit" name="Edit_Category" value="EDIT CATEGORY">
    </form>
    <div class="Edit-Category-Image">
        <img src="public/img/Categories/<?php echo isset($_GET['New_Image'])? $_GET['New_Image'] : $Infor_Category[0]['Image'];  ?>" alt="<?php echo $Infor_Category[0]['Name'] ?>">
    </div>
</div>