<div class="Admin-Category-Page">
    <div class="Noitifications">
        <?php
        if (isset($_GET['Error_Massage'])) {
            echo '<div class="Show-Notification" style="color: red;">' . $_GET['Error_Massage'] . '</div>';
        } else if (isset($_GET['Success_Massage'])) {
            echo '<div class="Show-Notification" style="color: green;">' . $_GET['Success_Massage'] . '</div>';
        }
        ?>
    </div>
    <h1>ADD CATEGORY</h1>
    <form action="admin.php?Admin_Action=categories&Category_Action=add" method="post" enctype="multipart/form-data" class="Form-Add-Category">
        <label>Name Category <br><input type="text" name="Name" value="<?php echo isset($_GET['Name']) ? $_GET['Name'] : '' ?>" required placeholder="Name Category"></label><br>
        <label>Image <br><input type="file" name="Image"></label>
        <input type="submit" name="Add_Category" value="ADD CATEGORY">
    </form>
    <h1>CATEGORY ADDED</h1>
    <table border="1" class="Table-List-Category">
        <tr>
            <th>ID</th>
            <th>Name Category</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php
        $Table_Category = '';
        foreach ($List_Categories as $key => $value) {
            $Table_Category .= '<tr>
            <td>' . $value['ID'] . '</td>
            <td>' . $value['Name'] . '</td>
            <td><img src="public/img/Categories/' . $value['Image'] . '" alt="Image Category" width="100px" height="100px"></td>
            <td><a href="admin.php?Admin_Action=categories&Category_Action=edit&ID=' . $value['ID'] . '">Edit</a> | 
            <a href="admin.php?Admin_Action=categories&Category_Action=delete&ID=' . $value['ID'] . '">Delete</a></td>
            </tr>';
        }
        echo $Table_Category;
        ?>
    </table>
</div>