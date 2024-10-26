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
                        <a href="index.php?action=products&product-action=fill-cat&id=' . $Cat['ID'] . '" class="Product-Category">
                            <img src="public/img/Categories/' . $Cat['Image'] . '" alt="">
                            <h2>' . $Cat['Name'] . '</h2>
                        </a>
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
                <a href="index.php?action=products&product-action=detail&id='.$List_Product['ID'].'" class="Product-Sale">
                    <div class="img-product"><img src="public/img/Products/' . $List_Product['Image'] . '" alt="' . $List_Product['Image'] . '"></div>
                    <div class="info-product">
                        <h4>' . $List_Product['Name'] . '</h4>
                        <h5>' . number_format(($List_Product['Price']) - ($List_Product['Price'] * $List_Product['Sale']) / 100, 0, ',', '.') . ' VND</h5>
                        <del>' . number_format($List_Product['Price'], 0, ',', '.') . ' VND</del>
                        <div class="Prd-Sale">' . $List_Product['Sale'] . '% </div>
                    </div>
                </a>';
            }
            echo $Sale;
            ?>

        </div>
        <div class="Rank-Table">
            <div class="Rank-Table-Left">
                <h2>Khuyến Mãi Đang Có</h2>
                <div class="Rank-Table-Banner"></div>
            </div>
            <div class="Rank-Table-Right">
                <h2>Top Được Xem Nhiều</h2>
                <div class="Rank-Table-Content">
                    <?php 
                    $Rank_Views = '';
                    foreach ($Top_View as $Rank_View) {
                        $Rank_Views.= '
                            <a href="index.php?action=products&product-action=detail&id='.$Rank_View['ID'].'" class="Rank-Table-Card">
                                <img src="public/img/Products/'. $Rank_View['Image']. '" alt="'. $Rank_View['Image']. '">
                                <div class="Rank-Table-Card-Description">
                                    <h3>'. $Rank_View['Name']. '</h3>
                                    <h4>Giá: '. number_format(($Rank_View['Price']) - ($Rank_View['Price'] * $Rank_View['Sale']) / 100, 0, ',', '.') . ' VNĐ</h4>
                                    <h5>Lượt Xem: '. $Rank_View['View'] .'</h5> 
                                </div>
                            </a>
                        ';
                    }
                    echo $Rank_Views;
                    ?>
                        
                </div>
            </div>
        </div>
        
    </div>

</div>
</div>