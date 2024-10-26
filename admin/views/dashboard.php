<div class="Dashboard-Page">
    <div class="Dashboard-Grid">
        <div class="Dashboard_Card">
            <h4>Tài Khoản</h4>
            <div class="Dashboard_Card-Value">
                <?php
                if (isset($_SESSION['admin_u'])) {
                    echo 'Xin Chào Admin ' . $_SESSION['admin_u']['Name'];
                } else if (isset($_SESSION['admin_a'])) {
                    echo 'Xin Chào Admin ' . $_SESSION['admin_a']['Name'];
                }
                ?>
            </div>
        </div>
        <div class="Dashboard_Card">
            <h4>Doanh Thu</h4>
            <div class="Dashboard_Card-Value">
                <?php
                $Order = $Dashboard['Orders'];
                $Revenue = 0;
                foreach ($Order as $O) {
                    $Revenue += $O['Total'];
                }
                echo number_format($Revenue,0,',','.').' VNĐ';
                ?>
            </div>
        </div>
        <div class="Dashboard_Card">
            <h4>Tổng Số Đơn Hàng</h4>
            <div class="Dashboard_Card-Value">
                <?php
                echo count($Order);
                ?>
            </div>
        </div>
        <div class="Dashboard_Card">
            <h4>Tất Cả Sản Phẩm</h4>
            <div class="Dashboard_Card-Value">
                <?php
                $Product = $Dashboard['Products'];
                echo count($Product);
                ?>
            </div>
        </div>
        <div class="Dashboard_Card">
            <h4>Tất Cả Khách Hàng</h4>
            <div class="Dashboard_Card-Value">
                <?php
                $Customer = $Dashboard['Users'];
                $User_Normal = 0;
                foreach ($Customer as $C) {
                    if ($C['Role'] == 2) {
                        $User_Normal++;
                    }
                }
                echo $User_Normal;
                ?>
            </div>
        </div>
        <div class="Dashboard_Card">
            <h4>Tất Cả Admin</h4>
            <div class="Dashboard_Card-Value">
                <?php
                $Customer = $Dashboard['Users'];
                $User_Admin = 0;
                foreach ($Customer as $C) {
                    if ($C['Role'] == 0 || $C['Role'] == 1) {
                        $User_Admin++;
                    }
                }
                echo $User_Admin;
                ?>
            </div>
        </div>
    </div>
</div>