<style>
 main {
    font-family: Arial, sans-serif;
}

.binh_luan {
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
    <h1>Quản Lý Bình Luận</h1>
    <a class="binh_luan" href="admin.php?Page=quan_ly_bai_viet" class="btn-back">Quay Lại Quản Lý Tin Tức</a>
    <table border="1" cellspacing="0" cellpadding="10" >
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>ID</th>
                <th>Người Dùng</th>
                <th>Bài Viết</th>
                <th>Nội Dung</th>
                <th>Ngày Gửi</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><?= $comment['ID']; ?></td>
                        <td><?= $comment['User_Name']; ?></td>
                        <td><?= $comment['News_Title']; ?></td>
                        <td><?= nl2br($comment['Content']); ?></td>
                        <td><?= $comment['Sent_Date']; ?></td>
                        <td>
                            <a href="admin.php?Page=xoa_binh_luan_tin_tuc&ID=<?= $comment['ID']; ?>" 
                               style="color: red; text-decoration: none;" 
                               onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?');">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" >Không có bình luận nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>
