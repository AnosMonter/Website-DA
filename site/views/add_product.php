<?php
include_once 'header.php';


?>
<link rel="stylesheet" href="../../public/css/style.css">
<div class="Admin-Product">
    <div class="Admin-Product-Frame">
        <form action="" method="post" class="Add-Product">
            <fieldset>
                <legend>Tên sản phẩm</legend>
                <input type="text" name="Name" placeholder="Tên sản phẩm">
            </fieldset>
            <fieldset>
                <legend>Giá sản phẩm</legend>
                <input type="text" name="Price" placeholder="Giá sản phẩm">
            </fieldset>
            <fieldset>
                <legend>Ảnh sản phẩm</legend>
                <input type="file" name="Image" placeholder="Ảnh sản phẩm">
            </fieldset>
            <fieldset>
                <legend>Giảm Giá Sản Phẩm</legend>
                <input type="text" name="Sale" placeholder="Giảm Giá Sản Phẩm">
            </fieldset>
            <fieldset>
                <legend>Mô tả sản phẩm</legend>
                <input type="text" name="Description" placeholder="Mô tả sản phẩm">
            </fieldset>
            <fieldset>
                <legend>Chi Tiết Sản Phẩm</legend>
                <input type="text" name="Detail" placeholder="Loại sản phẩm">
            </fieldset>
            <fieldset>
                <legend>Số lượng sản phẩm</legend>
                <input type="text" name="Quantity" placeholder="Số lượng sản phẩm">
            </fieldset>
            <fieldset>
                <legend>Ngày Sản Xuất</legend>
                <input type="date" name="Production_Date" placeholder="Ngày Sản Xuất">
            </fieldset>
            <fieldset>
                <legend>Ngày Hết Hạn</legend>
                <input type="date" name="Expiration_Date" placeholder="Ngày Hết Hạn">
            </fieldset>
            <fieldset>
                <legend>Loại sản phẩm</legend>
                <select name="Cat_ID">
                    <option value="0">Chưa Phân Loại</option>
                    <?php
                    foreach ($List_Categories as $Category) {
                        echo '<option value="' . $Category['ID'] . '">' . $Category['Name'] . '</option>';
                    }
                    ?>
                </select>
            </fieldset>
            <input type="submit" value="Thêm Sản Phẩm">
        </form>
    </div>
</div>