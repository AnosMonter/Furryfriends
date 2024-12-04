<style>
    .container {
        width: 1440px;
        margin: 0 auto;
        font-family: Arial, sans-serif;
    }

    .img {
        width: 100%;
        height: 300px;
        background-image: url('../../public/img/image 1.png');
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
        width: 100%;
        border-collapse: collapse;
        margin: 20px auto;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        width: fit-content;
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

    .btn-chi-tiet-hoa-don-us {
        width: 100%;
        text-align: center;
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        background-color: #007bff;
        color: #fff;
        transition: background-color 0.3s ease;
        white-space: nowrap;
    }

    .btn-chi-tiet-hoa-don-us:hover {
        background-color: #0056b3;
    }
</style>
<main>
    <div class="Container">
        <table border="-1">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Người Nhận</th>
                    <th>Số Điện Thoại</th>
                    <th>Địa Chỉ</th>
                    <th>Tổng thanh toán</th>
                    <th>Ngày Thanh Toán</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php $STT = 1;
                foreach ($donHang as $don): ?>
                    <tr>
                        <td><?= $STT++ ?></td>
                        <td><?= htmlspecialchars($don['Name']); ?></td>
                        <td><?= htmlspecialchars($don['Phone']); ?></td>
                        <td><?= htmlspecialchars($don['Address']); ?></td>
                        <td><?= number_format($don['Total'], 2); ?> đ</td>
                        <td><?= $don['Payment_Date'] ?? 'Chưa thanh toán'; ?></td>
                        <td><a class="btn-chi-tiet-hoa-don-us" href="index.php?Page=xem_so_luong&ID=<?= $don['ID'] ?>">
                                <?php
                                if ($don['Status_Order'] == 0) {
                                    echo 'Đang Xử Lý';
                                } else if ($don['Status_Order'] == 1) {
                                    echo 'Đang Chuẩn Bị';
                                } else if ($don['Status_Order'] == 2) {
                                    echo 'Đang Giao Hàng';
                                } else if ($don['Status_Order'] == 3) {
                                    echo 'Giao Hàng Hoàn Tất';
                                } else {
                                    echo 'Đơn Hàng Đã Hủy';
                                }
                                ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>