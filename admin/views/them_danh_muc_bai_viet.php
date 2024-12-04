<style>
    form {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    input[type="text"],
    input[type="file"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
<form action="admin.php?Page=them_danh_muc_bai_viet" method="post" enctype="multipart/form-data">
<h2>Thêm Danh Mục Bài Viết</h2>

<input type="text" name="name" id="name" value="<?= isset($category) ? $category['Name'] : ''; ?>" required>
    <label for="status">Trạng Thái:</label>
    <select name="status" id="status">
        <option value="1" <?= isset($category) && $category['Status'] ? 'selected' : ''; ?>>Hiển thị</option>
        <option value="0" <?= isset($category) && !$category['Status'] ? 'selected' : ''; ?>>Ẩn</option>
    </select>
    <button type="submit" style=" background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;">Lưu</button>
</form>
