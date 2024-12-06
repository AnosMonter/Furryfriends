<style>
    .form-group {
        margin-bottom: 10px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-group img {
        max-width: 100%;
        margin-top: 5px;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
<main>
    <h1 class="Title-Page-Main">Sửa Dịch Vụ</h1>

    <form action="admin.php?Page=sua_dich_vu&ID=<?php echo $service['ID']; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên dịch vụ:</label>
            <input type="text" id="name" name="name" value="<?php echo $service['Name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả dịch vụ:</label>
            <textarea id="description" name="description" required><?php echo $service['Detail']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="price">Giá dịch vụ:</label>
            <input type="number" id="price" name="price" value="<?php echo $service['Price']; ?>" required>
        </div>

        <div class="form-group">
            <label for="time">Thời gian dịch vụ:</label>
            <input type="text" id="time" name="time" value="<?php echo $service['Time_Service']; ?>" required>
        </div>

        <div class="form-group">
            <label for="category_id">Danh mục dịch vụ:</label>
            <select id="category_id" name="category_id" required>
                <?php foreach ($category_sv as $category) { ?>
                    <option value="<?php echo $category['ID']; ?>" <?php if ($category['ID'] == $service['Category_ID']) echo 'selected'; ?>><?php echo $category['Name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái:</label>
            <select id="status" name="status" required>
                <option value="1" <?php if ($service['Status'] == 1) echo 'selected'; ?>>Hiển thị</option>
                <option value="0" <?php if ($service['Status'] == 0) echo 'selected'; ?>>Ẩn</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Ảnh dịch vụ:</label>
            <input type="file" id="image" name="image">
            <img src="<?php echo $service['Image']; ?>" alt="<?php echo $service['Name']; ?>" width="100">
        </div>

        <button type="submit">Cập nhật dịch vụ</button>
    </form>
</main>