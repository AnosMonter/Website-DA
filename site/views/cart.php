<div class="Cart-Page">
    <?php
    $userId = $_SESSION['user']['ID'];
    $User_List_Products = $_SESSION['cart'][$userId] ?? [];
    ?>
    <div class="Notification-Detail">
        <?php
        if (isset($_GET['Error_Message'])) {
            echo '<div class="Show-Notification" style="color: red;">' . $_GET['Error_Message'] . '</div>';
        }

        if (isset($_GET['Success_Message'])) {
            echo '<div class="Show-Notification" style="color: green;">' . $_GET['Success_Message'] . '</div>';
        }
        ?>
    </div>
    <div class="Cart-Title">Giỏ Hàng</div>
    <div class="Cart-List-Product">
        <table border="1" style="border-collapse: collapse;">
            <tr>
                <th>Sản Phẩm</th>
                <th>Đơn Giá</th>
                <th>Số Lượng</th>
                <th>Giảm Giá</th>
                <th>Thành Tiền</th>
                <th>Xóa</th>
            </tr>
            <?php
            $List_Table_Products = '';
            if (empty($User_List_Products)) {
                $List_Table_Products = '
                <tr>
                    <th colspan="5">Bạn chưa thêm sản phẩm nào vào giỏ hàng</th>
                </tr>';
            } else {
                $Total = 0;
                foreach ($User_List_Products as $Val) {
                    $List_Table_Products .= '<tr>
                        <td><a href="index.php?action=products&product-action=detail&id='.$Val['ID'].'"><img width="100px" height="100px" src="public/img/Products/' . $Val['Image'] . '" alt="">' . $Val['Name'] . '<a></td>
                        <td>' . number_format($Val['Price'], 0, ',', '.') . ' VNĐ</td>
                        <td>' . $Val['Quantity'] . '</td>
                        <td>' . $Val['Sale'] . ' %</td>
                        <td>' . number_format(($Val['Price'] * $Val['Quantity']) * (1 - $Val['Sale'] / 100), 0, ',', '.') . ' VNĐ</td>
                        <td><a href="index.php?action=cart&cart-action=remove&id=' . $Val['ID'] . '">Xóa</a></td>
                    </tr>';
                    $Total += ($Val['Price'] * $Val['Quantity']) * (1 - $Val['Sale'] / 100);
                }
                $List_Table_Products .= '
                    <tr>
                        <td colspan="4">Tổng Tiền</td>
                        <td>' . number_format($Total, 0, ',', '.') . ' VNĐ</td>
                        <td><a href="index.php?action=cart&cart-action=checkout">Thanh Toán</a></td>
                    </tr>
                ';
            }
            echo $List_Table_Products;
            ?>

        </table>
    </div>
</div>