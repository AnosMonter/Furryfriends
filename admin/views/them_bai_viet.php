<style>
    form {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    input[type="file"] {
        margin-bottom: 10px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .Error {
        color: red;
        font-size: 12px;
        margin-bottom: 10px;
    }
</style>
<main>
    <h1>Thêm Bài Viết</h1>
    <form action="admin.php?Page=them_bai_viet" method="post" enctype="multipart/form-data">
        <h1>Thêm Bài Viết</h1>
        <label for="name">Tên Bài Viết:</label>
        <input type="text" id="name" name="name" required>
        <?= isset($nameError) ? '<p class="Error">' . $nameError . '</p>' : '' ?>


        <label for="image">Hình ảnh:</label>
        <input type="file" id="image" name="image">
        <?= isset($imageError) ? '<p class="Error">' . $imageError . '</p>' : '' ?>

        <label for="content">Nội dung:</label>
        <textarea id="content" name="content"></textarea>
        <?= isset($contentError) ? '<p class="Error">' . $contentError . '</p>' : '' ?>


        <label for="status">Trạng thái:</label>
        <select id="status" name="status">
            <option value="0">Ẩn</option>
            <option value="1">Hiển thị</option>
        </select>
        <?= isset($statusError) ? '<p class="Error">' . $statusError . '</p>' : '' ?>

        <label for="category_id">Danh mục:</label>
        <select id="category_id" name="category_id">
            <?php
            foreach ($Category as $Category) {
                echo '<option value="' . $Category['ID'] . '">' . $Category['Name'] . '</option>';
            }

            ?>
        </select>
        <?= isset($categoryError) ? '<p class="Error">' . $categoryError . '</p>' : '' ?>

        <input type="submit" value="Thêm Bài Viết">
    </form>
</main>