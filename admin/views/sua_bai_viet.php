<style>
    form {
    width: 100%;
    background-color: #f2f2f2;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
textarea,
select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
<main>
    <form action="admin.php?Page=sua_bai_viet&ID=<?php echo $news['ID']; ?>" method="post" enctype="multipart/form-data">
        <label for="name">Tên tin tức:</label>
        <input type="text" id="name" name="name" value="<?php echo $news['Name']; ?>" required>
        <?= isset($nameError) ? '<p class="Error">' . $nameError . '</p>' : '' ?>

        <label for="current_image">Hình ảnh hiện tại:</label>
        <img src="<?php echo substr($news['Image'], 0, 4) == 'http' ? $news['Image'] : 'public/img/News/' . $news['Image']; ?>" alt="Hình ảnh tin tức" style="max-width: 200px;">
        <br>

        <label for="image">Chọn hình ảnh mới:</label>
        <input type="file" id="image" name="image">
        <?= isset($imageError) ? '<p class="Error">' . $imageError . '</p>' : '' ?>

        <label for="image_url">Hoặc nhập link URL hình ảnh:</label>
        <input type="text" id="image_url" name="image_url" placeholder="https://example.com/image.jpg" value="<?php echo isset($news['Image_URL']) ? $news['Image_URL'] : ''; ?>">
        <?= isset($imageUrlError) ? '<p class="Error">' . $imageUrlError . '</p>' : '' ?>


        <label for="create_date">Ngày đăng:</label>
        <input type="datetime-local" id="create_date" name="create_date" value="<?php echo date('Y-m-d\TH:i', strtotime($news['Create_Date'])); ?>" required>
        <?= isset($create_dateError) ? '<p class="Error">' . $create_dateError . '</p>' : '' ?>

        <label for="content">Nội dung:</label>
        <textarea id="content" name="content"><?php echo $news['content']; ?></textarea>
        <?= isset($contentError) ? '<p class="Error">' . $contentError . '</p>' : '' ?>

        <label for="status">Trạng thái:</label>
        <select id="status" name="status">
            <option value="0" <?php if ($news['Status'] == 0) echo 'selected'; ?>>Ẩn</option>
            <option value="1" <?php if ($news['Status'] == 1) echo 'selected'; ?>>Hiển thị</option>
        </select>
        <?= isset($statusError) ? '<p class="Error">' . $statusError . '</p>' : '' ?>

        <label for="category_id">Danh mục:</label>
        <select id="category_id" name="category_id">
            <?php
            foreach ($Category as $Category) {
                if ($Category['ID'] == $news['Category_ID']) {
                    echo '<option value="' . $Category['ID'] . '" selected>' . $Category['Name'] . '</option>';
                } else {
                    echo '<option value="' . $Category['ID'] . '">' . $Category['Name'] . '</option>';
                }
            }
            ?>
        </select>
        <?= isset($categoryError) ? '<p class="Error">' . $categoryError . '</p>' : '' ?>
        <input type="submit" value="Sửa tin tức">
    </form>
</main>