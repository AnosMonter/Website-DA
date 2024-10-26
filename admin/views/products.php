<div class="Backgrounds-Admins">
    <div class="Noitifications">
        <?php
            if (isset($_GET['Error_Message'])){
                echo '<div class="Show-Notification" style="color: red;">'. $_GET['Error_Message']. '</div>';
            } else if (isset($_GET['Success_Message'])) {
                echo '<div class="Show-Notification" style="color: green;">'. $_GET['Success_Message']. '</div>';
            }
        ?>
    </div>
    <div class="Admin-Products-Page">
        <h1>ADD PRODUCT</h1>
        <div class="Admin-Add-Product">
            <form action="admin.php?Admin_Action=products&Products_Action=add" method="post" enctype="multipart/form-data" class="Admin-Form-Add-Product">
                <div class="Admin-Add-Product-Frame">
                    <div class="Add-Frame-Left">
                        <label>Name Product <br><input type="text" name="Name" value="<?php echo isset($_GET['Name']) ? $_GET['Name'] : '' ?>" required placeholder="Name Product"></label>
                        <label>Price Product <br><input type="number" name="Price" value="<?php echo isset($_GET['Price']) ? $_GET['Price'] : '' ?>" required placeholder="Price Product"></label>
                        <label>Sale Product <br><input type="number" name="Sale" value="<?php echo isset($_GET['Sale']) ? $_GET['Sale'] : '' ?>" placeholder="Sale" min="0" max="100"></label>
                        <label>Quantity Product <br><input type="number" name="Quantity" value="<?php echo isset($_GET['Quantity']) ? $_GET['Quantity'] : '' ?>" required placeholder="Quantity"></label>
                        <label>Category <br>
                            <select name="Cat_ID">
                                <?php
                                foreach ($All_categories as $Category) {
                                    if ($_GET['Cat_ID'] == $Category['ID']) {
                                        echo '<option selected value="' . $Category['ID'] . '">' . $Category['Name'] . '</option>';
                                    } else {
                                        echo '<option value="' . $Category['ID'] . '">' . $Category['Name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </label>
                        <label>Import Date <br><input type="date" name="Import_Date" value="<?php echo isset($_GET['Import_Date']) ? $_GET['Import_Date'] : '' ?>"></label>
                        <label>Production Date <br><input type="date" name="Production_Date" value="<?php echo isset($_GET['Production_Date']) ? $_GET['Production_Date'] : '' ?>"></label>
                        <label>Expiration Date <br><input type="date" name="Expiration_Date" value="<?php echo isset($_GET['Expiration_Date']) ? $_GET['Expiration_Date'] : '' ?>"></label>
                        <label>Status <br>
                            <select name="Status">
                                <option value="1" <?php echo isset($_GET['Status']) && $_GET['Status'] == 0 ? 'selected' : '' ?>>Còn Hàng</option>
                                <option value="2" <?php echo isset($_GET['Status']) && $_GET['Status'] == 1 ? 'selected' : '' ?>>Hết Hàng</option>
                                <option value="3" <?php echo isset($_GET['Status']) && $_GET['Status'] == 2 ? 'selected' : '' ?>>Đang Nhập Hàng</option>
                                <option value="4" <?php echo isset($_GET['Status']) && $_GET['Status'] == 3 ? 'selected' : '' ?>>Lô Cuối Cùng</option>
                            </select></label>
                    </div>
                    <div class="Add-Frame-Right">
                        <label>Description <br><textarea name="Description" placeholder="Description"><?php echo isset($_GET['Description']) ? $_GET['Description'] : '' ?></textarea></label>
                        <label>Detail <br><textarea name="Detail" placeholder="Detail"><?php echo isset($_GET['Detail']) ? $_GET['Detail'] : '' ?></textarea></label>
                        <label>Image <br><input type="file" name="Image"></label>
                        <!-- <label>More Image <br> <input type="file" name="More_Image" multiple></label> -->
                    </div>
                </div>
                <input type="submit" name="Product_Add" value="ADD PRODUCT">
            </form>
        </div>
    </div>
    <div class="Admin-Products-Page">
        <h1>PRODUCTS ADDED</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Sale</th>
                <th>Action</th>
            </tr>
            <?php
            $List_Table_Products = '';
            foreach ($All_products as $product) {
                $List_Table_Products .= '<tr>
                <td>' . $product['ID'] . ' </td>
                <td><img src="public/img/Products/' . $product['Image']  . '" width="100px" height="100px" alt=""></td>
                <td>' . $product['Name'] . '</td>
                <td>' . $product['Price'] . '</td>
                <td>'. $product['Sale'] . '%</td>';
                $List_Table_Products .= '
                <td><a class="Admin_Edit_PRD" href="admin.php?Admin_Action=products&Products_Action=edit&ID=' . $product['ID'] . '">Edit</a> | <a class="Admin_Del_PRD" href="admin.php?Admin_Action=products&Products_Action=delete&ID=' . $product['ID'] . '">Delete</a></td>
                </tr>';
            }
            if (empty($List_Table_Products)){
                $List_Table_Products.='<tr><td colspan="5">Bạn Chưa Thêm Sản Phẩm Nào</td></tr>';
            }
            echo $List_Table_Products;
            ?>
        </table>
    </div>
</div>