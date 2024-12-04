
<main>
    <?= isset($_GET['Noti']) ? '<script>alert("' . $_GET['Noti'] . '")</script>' : '' ?>
    <h1 class="Title-Page-Main">Quản lý Danh mục</h1>
    <a class="btn-add" href="admin.php?Page=them_danh_muc">Thêm Danh Mục</a>
    <table class="category-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Danh Mục</th>
                <th>Ảnh</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $category_list = '';
            foreach ($list_categories as $category) {
                $category_list .= '<tr>
                    <td>' . $category['ID'] . '</td>
                    <td>' . $category['Name'] . '</td>
                    <td><img class="category-image" width="100px" height="100px" src="' . (substr($category['Image'], 0, 4) == 'http' ? $category['Image'] : $category['Image']) . '" alt="' . $category['Name'] . '"></td>
                    <td>
                        <a href="admin.php?Page=sua_danh_muc&ID=' . $category['ID'] . '" class="btn-edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="admin.php?Page=xoa_danh_muc&ID=' . $category['ID'] . '" class="btn-delete"><i class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>';
            }
            echo $category_list;
            ?>
        </tbody>
    </table>
    <div class="pagination">
            <?php
            for ($i = 1; $i <= count($this->Import_Database->Get_All_Category())/ $limit; $i++) {
                if (!isset($_GET['Page_Num'])) {
                    echo '<a class="Select" href="admin.php?Page=quan_ly_danh_muc&Page_Num=' . $i . '">' . $i . '</a>';
                } else if ($_GET['Page_Num'] == $i) {
                    echo '<a class="Select" href="admin.php?Page=quan_ly_danh_muc&Page_Num=' . $i . '">' . $i . '</a>';
                } else {
                    echo '<a href="admin.php?Page=quan_ly_danh_muc&Page_Num=' . $i . '">' . $i . '</a>';
                }
            }
            ?>
        </div>
</main>