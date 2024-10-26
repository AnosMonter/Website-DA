<div class="Admin-Edit-Product-Page">
    <div class="Noitifications">
        <?php
        if (isset($_GET['Error_Message'])) {
            echo '<div class="Show-Notification" style="color: red;">' . $_GET['Error_Message'] . '</div>';
        } else if (isset($_GET['Success_Message'])) {
            echo '<div class="Show-Notification" style="color: green;">' . $_GET['Success_Message'] . '</div>';
        }
        if (isset($_COOKIE['Description_Detail'])) {
            $Description_Detail = json_decode($_COOKIE['Description_Detail'], true);
            setcookie('Description_Detail', '', -1, '/');
        }
        ?>
    </div>
    <h1>Edit Product</h1>
    <div class="Admin-Edit-Product">
        <form action="admin.php?Admin_Action=products&Products_Action=edit" method="post" enctype="multipart/form-data" class="Admin-Form-Edit-Product">
            <div class="Admin-Edit-Product-Frame">
                <div class="Edit-Frame-Left">
                    <input type="hidden" name="Product_ID" value="<?php echo $Infor_Product[0]['ID'] ?>">
                    <label>Name Product <br><input type="text" name="Name" value="<?php echo isset($_GET['Name']) ? $_GET['Name'] : $Infor_Product[0]['Name'] ?>" required placeholder="Name Product"></label>
                    <label>Price Product <br><input type="number" name="Price" value="<?php echo isset($_GET['Price']) ? $_GET['Price'] : $Infor_Product[0]['Price'] ?>" required placeholder="Price Product"></label>
                    <label>Sale Product <br><input type="number" name="Sale" value="<?php echo isset($_GET['Sale']) ? $_GET['Sale'] : $Infor_Product[0]['Sale'] ?>" placeholder="Sale" min="0" max="100"></label>
                    <label>Quantity Product <br><input type="number" name="Quantity" value="<?php echo isset($_GET['Quantity']) ? $_GET['Quantity'] : $Infor_Product[0]['Quantity'] ?>" required placeholder="Quantity"></label>
                    <label>Category <br>
                        <select name="Cat_ID">
                            <?php
                            foreach ($All_categories as $Category) {
                                if ($_GET['Cat_ID'] == $Category['ID'] || $Infor_Product[0]['Cat_ID'] == $Category['ID']) {
                                    echo '<option selected value="' . $Category['ID'] . '">' . $Category['Name'] . '</option>';
                                } else {
                                    echo '<option value="' . $Category['ID'] . '">' . $Category['Name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </label>
                    <label>Import Date <br><input type="date" name="Import_Date" value="<?php echo isset($_GET['Import_Date']) ? $_GET['Import_Date'] : $Infor_Product[0]['Import_Date']; ?>"></label>
                    <label>Production Date <br><input type="date" name="Production_Date" value="<?php echo isset($_GET['Production_Date']) ? $_GET['Production_Date'] : $Infor_Product[0]['Production_Date']; ?>"></label>
                    <label>Expiration Date <br><input type="date" name="Expiration_Date" value="<?php echo isset($_GET['Expiration_Date']) ? $_GET['Expiration_Date'] : $Infor_Product[0]['Expiration_Date']; ?>"></label>
                    <label>Status <br>
                        <select name="Status">
                            <option value="1" <?php echo isset($_GET['Status']) && $_GET['Status'] == 1 || !empty($Infor_Product[0]['Status']) == 1 ? 'selected' : ''; ?>>Còn Hàng</option>
                            <option value="2" <?php echo isset($_GET['Status']) && $_GET['Status'] == 2 || !empty($Infor_Product[0]['Status']) == 2 ? 'selected' : ''; ?>>Hết Hàng</option>
                            <option value="3" <?php echo isset($_GET['Status']) && $_GET['Status'] == 3 || !empty($Infor_Product[0]['Status']) == 3 ? 'selected' : ''; ?>>Đang Nhập Hàng</option>
                            <option value="4" <?php echo isset($_GET['Status']) && $_GET['Status'] == 4 || !empty($Infor_Product[0]['Status']) == 4 ? 'selected' : ''; ?>>Lô Cuối Cùng</option>
                        </select></label>
                </div>
                <div class="Edit-Image-Frame">
                    <img src="public/img/Products/<?php echo isset($_GET['New_Image']) ? $_GET['New_Image'] : $Infor_Product[0]['Image']; ?>" alt="<?php echo isset($_GET['New_Image']) ? $_GET['New_Image'] : $Infor_Product[0]['Image'] ?>">
                    <input type="hidden" name="Old_Image" value="<?php echo isset($_GET['New_Image']) ? $_GET['New_Image'] : $Infor_Product[0]['Image']; ?>" alt="<?php echo $Infor_Product[0]['Name'] ?>">
                </div>
                <div class="Edit-Frame-Right">
                    <label>Description <br><textarea name="Description" placeholder="Description"><?php echo isset($Description_Detail[0]) ? $Description_Detail[0] : $Infor_Product[0]['Description'] ?></textarea></label>
                    <label>Detail <br><textarea name="Detail" placeholder="Detail"><?php echo isset($Description_Detail[1]) ? $Description_Detail[1] : $Infor_Product[0]['Detail'] ?></textarea></label>
                    <label>Image <br><input type="file" name="Image"></label>
                    <!-- <label>More Image <br> <input type="file" name="More_Image" multiple></label> -->
                </div>
            </div>
            <input type="submit" name="Edit_Product" value="UPDATE PRODUCT">
        </form>
    </div>
</div>