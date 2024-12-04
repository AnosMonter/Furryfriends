<main>
    <h1 class="Title-Page-Main">Quản Lý Sản Phẩm</h1>
    <div class="manager-product-container">
        <a class="Them_san_pham" href="admin.php?Page=them_san_pham">Thêm Sản Phẩm</a>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Hình Ảnh</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá</th>
                <th>Số Lượng Trong Kho</th>
                <th>Trạng Thái</th>
                <th>Thao Tác</th>
            </tr>
            <?php
            $List_Product = '';
            $STT = ($Page_num -= 1) * $Limit + 1;
            foreach ($All_Products as $Product) {
                $List_Product .= '
            <tr>
                <td>' . $STT++ . '</td>
                <td><img width="100px" height="100px" src="';
                $List_Product .= (substr($Product['Image'], 0, 4) == 'http') ? $Product['Image'] : 'public/img/Products/' . $Product['Image'];
                $List_Product .= '" alt="' . $Product['Name'] . '"></td>
                <td>' . $Product['Name'] . '</td>
                <td>' . number_format($Product['Discount'], 0, ',', '.') . 'VNĐ<br><del>' . $Product['Price'] . 'VNĐ</del></td>
                <td>' . $Product['Quantity'] . '</td>';
                if ($Product['Status'] == 1) {
                    $List_Product .= '<td><a href="admin.php?Page=an_hien&ID=' . $Product['ID'] . '"><i class="fa-solid fa-eye"></i></a></td>';
                } else if ($Product['Status'] == 0) {
                    $List_Product .= '<td><a href="admin.php?Page=an_hien&ID=' . $Product['ID'] . '"><i class="fa-solid fa-eye-slash"></i></a></td>';
                }
                $List_Product .= '
                <td>
                    <a href="admin.php?Page=sua_san_pham&ID=' . $Product['ID'] . '"><i class="fa-solid fa-pen-to-square"></i></a> |
                    <a style="background-color:red;" href="admin.php?Page=xoa_san_pham&ID=' . $Product['ID'] . '"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>';
            }
            echo $List_Product;
            ?>
        </table>
        <div class="pagination">
            <?php
            for ($i = 1; $i <= count($this->Import_Database->Get_All_Products()) / $Limit; $i++) {
                if (!isset($_GET['Page_Num'])) {
                    echo '<a class="Select" href="admin.php?Page=quan_ly_san_pham&Page_Num=' . $i . '">' . $i . '</a>';
                } else if ($_GET['Page_Num'] == $i) {
                    echo '<a class="Select" href="admin.php?Page=quan_ly_san_pham&Page_Num=' . $i . '">' . $i . '</a>';
                } else {
                    echo '<a href="admin.php?Page=quan_ly_san_pham&Page_Num=' . $i . '">' . $i . '</a>';
                }
            }
            ?>
        </div>
    </div>
</main>