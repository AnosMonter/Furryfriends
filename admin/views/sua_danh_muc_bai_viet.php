<style>
    .Sua-Danh-Muc-Bai-Viet {
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

        img {
            max-width: 100%;
            margin-bottom: 10px;
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

        button {
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
    <form class="Sua-Danh-Muc-Bai-Viet" method="POST" action="admin.php?Page=sua_danh_muc_bai_viet&ID=<?php echo $category['ID']; ?>">
        <h2>Sửa Danh Mục Bài Viết</h2>

        <label for="name">Tên Danh Mục:</label>
        <input type="text" name="name" id="name" value="<?= $category['Name']; ?>" required>
        <label for="status">Trạng Thái:</label>
        <select name="status" id="status">
            <option value="1" <?= $category['Status'] == 1 ? 'selected' : ''; ?>>Hiển thị</option>
            <option value="0" <?= $category['Status'] == 0 ? 'selected' : ''; ?>>Ẩn</option>
        </select>
        <button type="submit" style=" background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;">Lưu</button>
    </form>
</main>