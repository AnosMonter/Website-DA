<div class="Background-All">
    <div class="container">
        <article>
            <div class="Banner"></div>
        </article>
        <div class="Title" style="color: yellowgreen;">
            <h1>Danh Mục Sản Phẩm</h1>
        </div>
        <div class="Category-Grid">
            <?php
            $Category = '';
            foreach ($List_Cat as $Cat) {
                $Category .= '
                        <div class="Product-Category">
                            <img src="public/img/Categories/' . $Cat['Image'] . '" alt="">
                            <h2>' . $Cat['Name'] . '</h2>
                        </div>
                    ';
            }
            echo $Category;
            ?>
        </div>
        <div class="Title">
            <h1>Sản Phẩm Khuyến Mãi</h1>
        </div>
        <div class="Sale-Grid">
            <?php
            $Sale = '';
            foreach ($List_Sale_Products as $List_Product) {
                $Sale .= '
                <div class="Product-Sale">
                    <div class="img-product"><img src="public/img/Products/' . $List_Product['Image'] . '" alt="' . $List_Product['Image'] . '"></div>
                    <div class="info-product">
                        <h4>' . $List_Product['Name'] . '</h4>
                        <h5>' . number_format(($List_Product['Price']) - ($List_Product['Price'] * $List_Product['Sale']) / 100, 0, ',', '.') . ' VND</h5>
                        <del>' . number_format($List_Product['Price'], 0, ',', '.') . ' VND</del>
                        <div class="Prd-Sale">' . $List_Product['Sale'] . '% </div>
                    </div>
                </div>';
            }
            echo $Sale;
            ?>

        </div>
        <div class="Title">
            <h1>Bảng Xếp Hạng Yêu Thích</h1>
        </div>
    </div>

</div>
</div>