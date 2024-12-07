<style>
    .img {
        width: 100%;
        height: 300px;
        background-image: url('public/img/image 1.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        overflow: hidden;
    }

    .box-login {
        width: 800px;
        border: 1px solid #ddd;
        border-radius: 10px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 20px;
        padding: 20px;
        margin: 0 auto;
        background-color: #f9f9f9;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .header-text {
        position: absolute;
        top: -41%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 24px;
        font-weight: bold;
        color: #000000;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 70%;
        margin: 0 auto;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .thay-doi-thong-tin {
        color: #333;
        font-size: 16px;
        display: inline-flex;
        align-items: center;
        border-bottom: 1px solid #ccc;
        padding: 10px 0;
    }

    .thaydoi_donhang {
        display: flex;
        width: 100%;
        justify-content: space-evenly;
        font-size: 20px;

    }

    a {
        text-decoration: none;
        color: #333;
    }

    h2 {
        display: flex;
        width: 100%;
        justify-content: space-evenly;
        font-size: 20px;
    }

    .total-price {
        text-align: left;
        font-weight: bold;
    }

    h2.thanhtoan {
        justify-content: center;
        text-align: center;
    }

    .order-details {
        margin-top: 20px;
    }

    .order-details p {
        margin-bottom: 10px;
    }

    .product-info {
        display: flex;
        align-items: center;
    }

    .product-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 10px;
        border-radius: 5px;
    }

    .product-name {
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    .order-details {
        width: 40%;
        font-size: 14px;
        color: #333;
        margin-left: 220px;
    }

    .order-details p {
        margin: 10px 0;
    }


    .order-details p {
        margin: 10px 0;
    }
</style>
<div class="Container">
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <?= $Check_Status == 3 ? '<th>Đánh Giá</th>' : '' ?>
            </tr>
        </thead>
        <tbody>
            <?php if ($CTDH): ?>
                <?php $i = 1;
                foreach ($CTDH as $item): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td>
                            <a href="index.php?Page=chi_tiet&id=<?= $item['ID_Product'] ?>" class="product-info">
                                <img src="<?= $item['Image'] ?>" alt="<?= $item['Name'] ?>" class="product-img">
                                <span class="product-name"><?= $item['Name'] ?></span>
                            </a>
                        </td>
                        <td><?= $item['Quantity'] ?></td>
                        <td><?= number_format($item['Price'], 0, ',', '.') ?> VND</td>
                        <?php
                        $DG_DH = empty($this->Database->Get_Product_Rating_By_ID_Order_Detail($item["ID"])) ? "<a href='index.php?Page=danh_gia&ID=" . $item["ID_Product"] . "&ID_Order_Detail=" . $item["ID"] . "'>Viết Đánh Giá</a>" : "Đã Đánh Giá";
                        echo $Check_Status == 3 ? '<td>' . $DG_DH . '</td>' : '' ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Không có dữ liệu</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td><?php if ($Get_Order['Status_Order'] <= 1) { ?>
                        <a href="index.php?Page=huy_don_hang&ID=<?= $Get_Order['ID'] ?>&Status=4" onclick="return confirm('Bạn Có Chắc Muốn Hủy Đơn?')">Hủy Đơn</a>
                    <?php } ?>
                </td>
                <td colspan="2">Tổng Thanh Toán</td>
                <td class="total-price"><?= number_format($total_price, 0, ',', '.') ?> VND</td>
            </tr>
        </tfoot>
    </table>

</div>

<div class="order-details">
    <p><strong>Địa chỉ nhận hàng:</strong> <?= $Get_Order['Address'] ?></p>
    <p><strong>Tên người nhận:</strong> <?= $Get_Order['Name'] ?></p>
    <p><strong>Số điện thoại liên lạc:</strong> <?= $Get_Order['Phone'] ?></p>
    <p><strong>Thời gian thanh toán:</strong> <?= $Get_Order['Payment_Date']?? 'Chưa Thanh Toán' ?></p>
    <p><strong>Phương thức thanh toán:</strong> <?= $Get_Order['Payment_Method'] == 1 && $Get_Order['Status_Order'] == 3 ? 'Tiền Mặt' : 'Chưa Thanh Toán' ?></p>
</div>

</div>