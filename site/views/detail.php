<?php $SQL_Database = new SQL_Database(); ?>
<div class="Background-All">
    <div class="Detail-Page">
        <div class="Detail-Path-Bar">
            <a href="index.php"><i class="fa-solid fa-house" style="color: rgb(150,150,150);"></i>Trang Chủ</a>
            <span> > </span> <a href="index.php?action=products">Sản Phẩm</a> <span> > </span> <a href="index.php?action=products&product-action=fill-cat&id=<?php echo $Category[0]['ID']; ?>"><?php echo $Category[0]['Name'] ?></a> <span> > </span> <a href="index.php?action=products&product-action=detail&id=<?php echo $Product_Detail[0]['ID'] ?>"><?php echo $Product_Detail[0]['Name'] ?></a>
        </div>
        <div class="Detail-Content">
            <div class="Detail-Left-Image">
                <div class="Detail-Main-Images">
                    <img src="public/img/Products/<?php echo $Product_Detail[0]['Image'] ?>" alt="">
                </div>
                <div class="Detail-More-Images">
                    <img src="public/img/Products/<?php echo $Product_Detail[0]['Image'] ?>" alt="">
                </div>
            </div>
            <div class="Detail-Left-Info">
                <h1><?php echo $Product_Detail[0]['Name'] ?></h1>
                <p><?php echo nl2br($Product_Detail[0]['Description']) ?></p>
                <div class="Price-Detail"><del><?php echo number_format($Product_Detail[0]['Price'], 0, ',', '.') ?> VNĐ</del> <br> <?php echo number_format(($Product_Detail[0]['Price'] - ($Product_Detail[0]['Price'] * $Product_Detail[0]['Sale'] / 100)), 0, ',', '.') ?> VNĐ</div>
                <a href="index.php?action=cart&cart-action=add&id=<?php echo $Product_Detail[0]['ID']; ?>" class="Detail-Left-Add-Cart">Thêm vào giỏ hàng</a>
                <div class="Detail-Sale"><?php echo '-'.$Product_Detail[0]['Sale']. '%';?></div>
                <div class="Notification-Detail">
                    <?php
                    if (isset($_GET['Error_Message'])) {
                        echo '<div class="Show-Notification" style="color: red;">' . $_GET['Error_Message'] . '</div>';
                    } else if (isset($_GET['Success_Message'])) {
                        echo '<div class="Show-Notification" style="color: green;">' . $_GET['Success_Message'] . '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="Detail-Other">
            <div class="Detail-Rating">
                <div class="Detail-Page-Title">Đánh Giá</div>
                <div class="Detail-Rating-Star"></div>
                <div class="Review-Content">
                    Chưa có đánh giá nào
                </div>
            </div>
            <div class="Detail-Comment">
                <div class="Show-Comment">
                    <div class="Notification-Detail">
                        <?php
                        if (isset($_GET['Error_Comment'])) {
                            echo '<div class="Show-Notification" style="color: red;">' . $_GET['Error_Comment'] . '</div>';
                        } else if (isset($_GET['Success_Comment'])) {
                            echo '<div class="Show-Notification" style="color: green;">' . $_GET['Success_Comment'] . '</div>';
                        }
                        if (!isset($_GET['Error_Comment']) && !isset($_GET['Error_Message']) && !isset($_GET['Success_Comment']) && !isset($_GET['Success_Message'])) {
                            $SQL_Database->Up_View_Product_By_ID($Product_Detail[0]['ID']);
                        }
                        ?>
                    </div>
                    <?php
                    $All_Comment = $SQL_Database->Get_All_Comments_And_Users_By_Product($Product_Detail[0]['ID']);
                    $Out_Comment = '';
                    foreach ($All_Comment as $Comment) {
                        $Out_Comment .= $Comment['Comments'] . '<p style="color: gray; font-size: 10px;">' . $Comment['Name'] . '  -  ' . $Comment['Dates'] . '<p><br>';
                    }
                    if (empty($Out_Comment)) {
                        $Out_Comment = 'Chưa Có Bình Luận Nào Cho Sản Phẩm Này';
                    }
                    echo $Out_Comment;
                    ?>
                </div>
                <div class="Write-Comment">
                    <?php
                    $Comment = '';
                    if (isset($_SESSION['user']) || isset($_SESSION['admin_u']) || isset($_SESSION['admin_a'])) {
                        $Comment .= '
                            <form action="index.php?action=products&product-action=comment" method="post" class="Comment-Form">
                                <textarea name="Comment" placeholder="Nhập nội dung bình luận..."></textarea>
                                <input type="submit" value="Gửi Bình Luận" name="Sub">
                                <input type="hidden" name="ID_PRD" value="' . $Product_Detail[0]['ID'] . '">
                            </form>
                            ';
                    } else {
                        $Comment .= '<p>Bạn cần đăng nhập để bình luận và đánh giá sản phẩm.</p>';
                    }
                    echo $Comment;
                    ?>

                </div>
            </div>
            <div class="Detail-Related-Products">
                <div class="Detail-Page-Title">Sản Phẩm Liên Quan</div>
                <div class="Related-Products-Frame">
                    <?php
                    $List_Related_Product = '';
                    $Product_By_Category = $Detail_Page[1];
                    foreach ($Product_By_Category as $List_Product) {
                        $List_Related_Product .= '
                                <a class="Related-Products-Product" href="index.php?action=products&product-action=detail&id=' . $List_Product['ID'] . '">
                                    <img src="public/img/Products/' . $List_Product['Image'] . '" alt="' . $List_Product['Image'] . '">
                                    <h4>' . $List_Product['Name'] . '</h4>
                                    <del>' . number_format($List_Product['Price'], 0, ',', '.') . ' VNĐ </del>
                                    <p>' . number_format(($List_Product['Price'] - ($List_Product['Price'] * $List_Product['Sale'] / 100)), 0, ',', '.') . 'VNĐ</p>
                                </a>
                            ';
                    }
                    if (empty($List_Related_Product)) {
                        $List_Related_Product .= '<p>Không tìm thấy sản phẩm liên quan.</p>';  // Hiện thông báo nếu không có sản phẩm liên quan
                    }
                    echo $List_Related_Product;

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>