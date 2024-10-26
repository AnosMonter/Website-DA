<div class="Background-All">
    <div class="container">
        <div class="Title" style="color: yellowgreen;">
            <h1>Kết Quả Tìm Kiếm Các Sản Phẩm Có "<?php echo $Key_Search; ?>"</h1>
        </div>
        <div class="Product-Page-Products-Frame">
                <?php
                $Product = '';
                foreach ($List_Products as $Pro) {
                    $Product .= '
                        <div class="Product-Page-Product">
                            <img src="public/img/Products/' . $Pro['Image'] . '" alt="">
                            <h2>' . $Pro['Name'] . '</h2>
                            <p>Giá: <del>' . number_format($Pro['Price']) . ' VNĐ </del> ' . number_format(($Pro['Price']) - ($Pro['Price'] * $Pro['Sale']) / 100, 0, ',', '.') . ' VND </p>
                            <a href="index.php?action=products&product-action=detail&id=' . $Pro['ID'] . '" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    ';
                }
                echo $Product;
                ?>
            </div>
    </div>
</div>