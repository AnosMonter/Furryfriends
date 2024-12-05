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
<main>
    <form action="admin.php?Page=them_danh_muc" method="post" enctype="multipart/form-data">
        <h2>Thêm Danh Mục</h2>
        <label for="ten_danh_muc">Tên Danh Mục:</label>
        <input type="text" id="ten_danh_muc" name="name" required>
        <?= isset($nameError) && !empty($nameError)? $nameError:'' ?>

        <label for="anh_danh_muc">Ảnh Danh Mục:</label>
        <input type="file" id="anh_danh_muc" name="image">
        <?= isset($imageError) &&!empty($imageError)? $imageError:''?>

        <label for="trang_thai_danh_muc">Trạng Thái Danh Mục</label>
        <select id="trang_thai_danh_muc" name="status">
            <option value="0">Ẩn</option>
            <option value="1">Hiển Thị</option>
        </select>
        <input type="submit" value="Thêm">
    </form>
</main>