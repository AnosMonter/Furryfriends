<style>
 main {
    font-family: Arial, sans-serif;
}

.Them_bai_viet {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 10px 15px;
    border: 1px solid #ddd;
    text-align: center;
}

th {
    background-color: #f2f2f2;
}

td img {
    max-width: 100%;
    height: auto;
}

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination a {
    color: black;
    padding: 10px 15px;
    text-decoration: none;
    border: 1px solid #ddd;
    border-bottom: none;
}

.pagination a.active {
    background-color: #4CAF50;
    color: white;
    border-bottom: none;
}

.pagination a:hover:not(.active) {
    background-color: #ddd;
}

@media (max-width: 768px) {
    table {
        font-size: 0.8em;
    }

    td img {
        max-width: 80%;
    }
}

.Select{
    background-color: #f2f2f2;
    color: #000;
    font-weight: bold;
}
</style>
<main>
    <a class="Them_bai_viet" href="admin.php?Page=them_bai_viet">Thêm Tin Tức</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Hình Ảnh</th>
            <th>Tiêu Đề</th>
            <th>Ngày Đăng</th>
            <th>Trạng Thái</th>
            <th>Thao Tác</th>
        </tr>
        <?php
        $List_News = '';
        $STT = ($Page_num -= 1) * $Limit + 1;
        foreach ($All_News as $News) {
            $List_News .= '
            <tr>
                <td>' . $STT++ . '</td>
                <td><img width="100px" height="100px" src="';
                $List_News .= (substr($News['Image'], 0, 4) == 'http') ? $News['Image'] : 'public/img/News/' . $News['Image'];
                $List_News .= '" alt="' . $News['Name'] . '"></td>
                <td>' . $News['Name'] . '</td>
                <td>' . date('d/m/Y', strtotime($News['Create_Date'])) . '</td>';
            if ($News['Status'] == 1) {
                $List_News .= '<td><a href="admin.php?Page=an_hien_bai_viet&ID=' . $News['ID'] . '"><i class="fa-solid fa-eye"></i></a></td>';
            } else if ($News['Status'] == 0) {
                $List_News .= '<td><a href="admin.php?Page=an_hien_bai_viet&ID=' . $News['ID'] . '"><i class="fa-solid fa-eye-slash"></i></a></td>';
            }
            $List_News .= '
                <td>
                    <a href="admin.php?Page=sua_bai_viet&ID=' . $News['ID'] . '"><i class="fa-solid fa-pen-to-square"></i></a> |
                    <a href="admin.php?Page=xoa_bai_viet&ID=' . $News['ID'] . '"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>';
        }
        echo $List_News;
        ?>
    </table>
    <div class="pagination">
        <?php
        for ($i = 1; $i <= ceil(count($this->Import_Database->Get_All_News()) / $Limit); $i++) {
            if (!isset($_GET['Page_Num'])) {
                echo '<a class="Select" href="admin.php?Page=quan_ly_bai_viet&Page_Num=' . $i . '">' . $i . '</a>';
            } else if ($_GET['Page_Num'] == $i) {
                echo '<a class="Select" href="admin.php?Page=quan_ly_bai_viet&Page_Num=' . $i . '">' . $i . '</a>';
            } else {
                echo '<a href="admin.php?Page=quan_ly_bai_viet&Page_Num=' . $i . '">' . $i . '</a>';
            }
        }
        ?>
    </div>
</main>
