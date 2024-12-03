
<main>
    <form class="form-edit-category" action="admin.php?Page=sua_danh_muc&ID=<?php echo $category['ID']; ?>" method="post" enctype="multipart/form-data">
        <h2>Sửa Danh Mục</h2>
        <label for="ten_danh_muc">Tên Danh Mục:</label>
        <input type="text" id="ten_danh_muc" name="name" value="<?php echo $category['Name']; ?>" required>
        <?= isset($nameError) && !empty($nameError) ? $nameError : '' ?>

        <label for="anh_danh_muc">Ảnh Danh Mục:</label>
        <input type="file" id="anh_danh_muc" name="image">
        <img src="<?php echo substr($category['Image'], 0, 4) == 'http' ? $category['Image'] : 'public/img/Categories/' . $category['Image']; ?>" alt="<?php echo $category['Name']; ?>" width="100">
        <?= isset($imageError) && !empty($imageError) ? $imageError : '' ?>

        <label for="trang_thai_danh_muc">Trạng Thái Danh Mục</label>
        <select id="trang_thai_danh_muc" name="status">
            <option value="0" <?php if ($category['Status'] == 0) echo 'selected'; ?>>Ẩn</option>
            <option value="1" <?php if ($category['Status'] == 1) echo 'selected'; ?>>Hiển Thị</option>
        </select>
        <?= isset($statusError) && !empty($statusError) ? $statusError : '' ?>

        <input type="submit" value="Lưu">
    </form>
</main>