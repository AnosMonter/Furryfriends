<style>
    table {
        border-collapse: collapse;
        width: 100%;
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
    td i {
        display: block;
        text-align: center;
        margin: 0 auto;
        padding: 5px;
    }
</style>

<main>
    <h1 class="Title-Page-Main">Bảng quản lý người dùng</h1>
    <table>
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Quyền hạn</th>
            <th>Trạng thái</th>
            <th>Tác vụ</th>
        </tr>
        <?php
        $List_User = '';
        $STT = ($Page_num - 1) * $Limit + 1;
        foreach ($this->Import_Database->Get_User_By_Page($Limit, $Page_num) as $User) {
            $List_User .= '
                    <tr>
                        <td>' . $STT++ . '</td>
                        <td>' . $User['Name'] . '</td>';
            $List_User .= $User['Role'] == 1 ? '<td>Admin</td>' : '<td>User</td>';
            $List_User .= $User['Status'] == 1 ? '<td>Active</td>' : '<td>Lock</td>';
            if ($User['Role'] == 1) {
                $List_User .= '<td></td>';
            } else {
                $List_User .= '<td><a href="admin.php?Page=an_hien_tai_khoan&ID=' . $User['ID'] . '" style="align-item:center">'. ($User['Status'] == 1 ? '<i class="fa-solid fa-eye"></i>' : '<i class="fa-solid fa-eye-slash"></i>') . '</a></td>';
            }
            $List_User .= '</tr>';
        }
        echo $List_User;
        ?>
    </table>

    <div class="pagination">
        <?php
        for ($i = 1; $i <= ceil(count($this->Import_Database->Get_All_User()) / $Limit); $i++) {
            if (!isset($_GET['Page_Num'])) {
                echo '<a class="Select" href="admin.php?Page=quan_ly_tai_khoan&Page_Num=' . $i . '">' . $i . '</a>';
            } else if ($_GET['Page_Num'] == $i) {
                echo '<a class="Select" href="admin.php?Page=quan_ly_tai_khoan&Page_Num=' . $i . '">' . $i . '</a>';
            } else {
                echo '<a href="admin.php?Page=quan_ly_tai_khoan&Page_Num=' . $i . '">' . $i . '</a>';
            }
        }
        ?>
    </div>
</main>