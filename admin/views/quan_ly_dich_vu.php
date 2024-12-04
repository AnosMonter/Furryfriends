<style>
    .admin-page-dich-vu {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    .admin-page-dich-vu h1 {
        text-align: center;
        color: #333;
    }

    .admin-page-dich-vu a {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
    }

    .admin-page-dich-vu table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .admin-page-dich-vu th,
    .admin-page-dich-vu td {
        border: 1px solid #ddd;
        padding: 15px;
        text-align: left;
    }

    .admin-page-dich-vu th {
        background-color: #f2f2f2;
    }

    .admin-page-dich-vu img {
        max-width: 100%;
    }
</style>

<main>
    <h1 class="Title-Page-Main">Quản Lý Dịch Vụ</h1>
    <div class="admin-page-dich-vu">
        <a href="admin.php?Page=them_dich_vu">Thêm Dịch Vụ</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Tên Dịch Vụ</th>
                <th>Ảnh Minh Họa</th>
                <th>Giá</th>
                <th>Thời Gian</th>
                <th>Trạng Thái</th>
                <th>Thao Tác</th>
            </tr>
            <?php
            $List_Service = '';
            foreach ($All_Service as $Service) {
                $List_Service .= '<tr><td>' . $Service['ID'] . '</td><td>' . $Service['Name'] . '</td>
                <td><img width="100px" height="100px" src="' . $Service['Image'] . '" alt="' . $Service['Name'] . '"></td>
                <td>' . $Service['Price'] . '</td><td>' . $Service['Time_Service'] . '</td><td><a href="admin.php?Page=an_hien_dich_vu&ID=' . $Service['ID'] . '">';
                $List_Service .= $Service['Status'] == 0 ? '<i class="fa-solid fa-eye-slash"></i>' : '<i class="fa-solid fa-eye"></i>' . '</a></td>';
                $List_Service .=
                    '<td>
                    <a href="admin.php?Page=sua_dich_vu&ID=' . $Service["ID"] . '"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a style="background-color:red;" href="admin.php?Page=xoa_dich_vu&ID=' . $Service["ID"] . '" onclick="return confirm(\'Bạn có muốn xóa hay không?\')"><i class="fa-solid fa-trash-can"></i></a>
                </td></tr>';
            }
            echo $List_Service;
            ?>
        </table>
        <div class="pagination">
            <?php
            for ($i = 1; $i <= ceil(count($this->Import_Database->Get_All_Service()) / $limit); $i++) {
                if (!isset($_GET['Page_Num'])) {
                    echo '<a class="Select" href="admin.php?Page=quan_ly_dich_vu&Page_Num=' . $i . '">' . $i . '</a>';
                } else if ($_GET['Page_Num'] == $i) {
                    echo '<a class="Select" href="admin.php?Page=quan_ly_dich_vu&Page_Num=' . $i . '">' . $i . '</a>';
                } else {
                    echo '<a href="admin.php?Page=quan_ly_dich_vu&Page_Num=' . $i . '">' . $i . '</a>';
                }
            }
            ?>
        </div>
    </div>
</main>