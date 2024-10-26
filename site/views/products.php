<div class="Background-All">
    <div class="container">
        <div class="Title" style="color: yellowgreen;">
            <h1>Sản Phẩm</h1>
        </div>
        <div class="Product-Page-All-Product">
            <div class="Product-Page-Category">
                <?php
                $Category = '<ul><a href="index.php?action=products">Categories</a>';
                foreach ($List_Categories as $Cat) {
                    if (isset($_GET['id']) && $_GET['id'] == $Cat['ID']) {
                        $Category .= '<a class="A_Cat" style="background-color: rgb(180,255,180)" href="index.php?action=products&product-action=fill-cat&id=' . $Cat['ID'] . '">' . $Cat['Name'] . '</a>';
                    } else {
                        $Category .= '<a class="A_Cat" href="index.php?action=products&product-action=fill-cat&id=' . $Cat['ID'] . '">' . $Cat['Name'] . '</a>';
                    }
                }
                $Category .= '</ul>';
                echo $Category;
                ?>
            </div>
            <div class="Product-Page-Products-Frame">
                <?php
                $Product = '';
                foreach ($List_Products as $Pro) {
                    $Product .= '
                        <a href="index.php?action=products&product-action=detail&id=' . $Pro['ID'] . '" class="Product-Page-Product">
                            <img src="public/img/Products/' . $Pro['Image'] . '" alt="">
                            <h2>' . $Pro['Name'] . '</h2>
                            <p><del>' . number_format($Pro['Price']) . ' VNĐ </del> <br>' . number_format(($Pro['Price']) - ($Pro['Price'] * $Pro['Sale']) / 100, 0, ',', '.') . ' VNĐ </p>
                        </a>
                    ';
                }
                echo $Product;
                ?>
            </div>
        </div>


    </div>
</div>