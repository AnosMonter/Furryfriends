<style>
    .Quan-Ly-Danh-Muc-Bai-Viet {
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn-them-dm-bv {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    }
</style>
<main>
    <div class="Quan-Ly-Danh-Muc-Bai-Viet">
    <h1 class="Title-Page-Main">Quản Lý Danh Mục Bài Viết</h1>
        <a class="btn-them-dm-bv" href="admin.php?Page=them_danh_muc_bai_viet">Thêm Danh Mục Bài Viết</a>
        <table border="1">
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
            <?php $stt = $limit*($Page -1);
            foreach ($list_categories_news as $category_News) { ?>
                <tr>
                    <td><?= ++$stt ?></td>
                    <td><?= $category_News['Name'] ?></td>
                    <td><a href="admin.php?Page=an_hien_danh_muc_bai_viet&ID=<?= $category_News['ID'] ?>"><?= $category_News['Status'] == 0 ? 'Ẩn' : 'Hiện' ?></a></td>
                    <td>
                        <a href="admin.php?Page=sua_danh_muc_bai_viet&ID=<?= $category_News['ID'] ?>">Sửa</a>
                        <a href="admin.php?Page=xoa_danh_muc_bai_viet&ID=<?= $category_News['ID'] ?>" onclick="return confirm('Bạn Có Chắc Muốn Xóa Danh Mục Này Không?')">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <div class="pagination">
            <?php
            for ($i = 1; $i <= count($this->Import_Database->Get_All_News_Categories()) / $limit; $i++) {
                if (!isset($_GET['Page_Num'])) {
                    echo '<a class="Select" href="admin.php?Page=quan_ly_danh_muc_bai_viet&Page_Num=' . $i . '">' . $i . '</a>';
                } else if ($_GET['Page_Num'] == $i) {
                    echo '<a class="Select" href="admin.php?Page=quan_ly_danh_muc_bai_viet&Page_Num=' . $i . '">' . $i . '</a>';
                } else {
                    echo '<a href="admin.php?Page=quan_ly_danh_muc_bai_viet&Page_Num=' . $i . '">' . $i . '</a>';
                }
            }
            ?>
        </div>
    </div>
</main>