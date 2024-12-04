<main>
    <h1>Quản Lý Đơn Hàng</h1>
    <table border="1" class="Table-Order-Manager">
        <tr>
            <th>ID Hóa Đơn</th>
            <th>Tên Tài Khoản Người Nhận</th>
            <th>Tổng Tiền</th>
            <th>Ngày Tạo Đơn Hàng</th>
            <th>Ngày Thanh Toán</th>
            <th>Trạng Thái</th>
        </tr>
        <?php $stt = 1;
        foreach ($this->Import_Database->Get_Order_By_Page($page,$limit) as $key => $value) { ?>
            <tr>
                <td><?= $stt++ ?></td>
                <td><?= $this->Import_Database->Get_User_By_ID($value['ID_User'])['Name'] ?> </td>
                <td><?= $value['Total'] ?></td>
                <td><?= $value['Create_Date'] ?></td>
                <td><?= $value['Payment_Date'] ?></td>
                <td>
                    <form class="form-update-status-order" action="admin.php?Page=cap_nhat_don_hang&ID=<?= $value['ID'] ?>" method="post">
                        <select name="Status_Order_Update" id="">
                            <option value="0" <?= $value['Status_Order'] == 0 ? 'selected' : '' ?>>Đang Xử Lý</option>
                            <option value="1" <?= $value['Status_Order'] == 1 ? 'selected' : '' ?>>Đang Chuẩn Bị</option>
                            <option value="2" <?= $value['Status_Order'] == 2 ? 'selected' : '' ?>>Đang Giao Hàng</option>
                            <option value="3" <?= $value['Status_Order'] == 3 ? 'selected' : '' ?>>Giao Hàng Hoàn Tất</option>
                            <option value="4" <?= $value['Status_Order'] == 4 ? 'selected' : '' ?>>Hủy Đơn Hàng</option>
                        </select>
                        <button type="submit">Cập Nhật Trạng Thái</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    <div class="pagination">
        <?php
        for ($i = 1; $i <= ceil(count($this->Import_Database->Get_All_Orders()) / $limit); $i++) {
            if (!isset($_GET['Page_Num'])) {
                echo '<a class="Select" href="admin.php?Page=quan_ly_don_hang&Page_Num=' . $i . '">' . $i . '</a>';
            } else if ($_GET['Page_Num'] == $i) {
                echo '<a class="Select" href="admin.php?Page=quan_ly_don_hang&Page_Num=' . $i . '">' . $i . '</a>';
            } else {
                echo '<a href="admin.php?Page=quan_ly_don_hang&Page_Num=' . $i . '">' . $i . '</a>';
            }
        }
        ?>
    </div>
</main>