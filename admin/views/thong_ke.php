<main>
    <span id="Time"></span>
    <div class="Thong-Ke">
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        setInterval(drawChart(), 1000 * 600);
    </script>
    <div class="Thong-ke-tren-tong-don-hang">
        <div class="Tong-doanh-thu">
            <h2>Tổng Doanh Thu</h2>
            <p><?= number_format($Total, 0, ',', ',') . 'VNĐ' ?></p>
            <i class="fa-solid fa-money-bill"></i>
        </div>
        <div class="Tong-don-hang">
            <h2>Tổng Số Lượng Đơn Hàng</h2>
            <p><?= $Count_Order; ?></p>
            <i class="fa-solid fa-boxes-stacked"></i>
        </div>
        <div class="Tong-san-pham">
            <h2>Đơn Hàng Thành Công</h2>
            <p><?= $Order_Suc; ?></p>
            <i class="fa-brands fa-dropbox"></i>
        </div>
        <div class="Tong-san-pham">
            <h2>Đơn Hàng Chưa Xác Nhận</h2>
            <p><?= $xuly; ?></p>
            <i class="fa-solid fa-hourglass-half"></i>
        </div>
        <div class="Tong-san-pham">
            <h2>Tổng Số Sản Phẩm</h2>
            <p><?= count($this->Import_Database->Get_All_Products()) ?></p>
            <i class="fa-solid fa-times-circle"></i>
        </div>
        <div class="Tong-san-pham">
            <h2>Tổng Số Bài Viết</h2>
            <p><?= count($this->Import_Database->Get_All_News()) ?></p>
            <i class="fa-solid fa-box-open"></i>
        </div>
    </div>
</main>