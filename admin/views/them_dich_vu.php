<style>
    .form-them-dich-vu {
        width: 100%;
        margin: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f8f8f8;

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type='file'],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0062cc;
        }
    }
</style>

<main>
<h1 class="Title-Page-Main">Thêm Dịch Vụ</h1>

    <form class="form-them-dich-vu" action="admin.php?Page=them_dich_vu" method="post" enctype="multipart/form-data">
        <label for="name">Tên dịch vụ:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Mô tả dịch vụ:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="price">Giá dịch vụ:</label>
        <input type="number" id="price" name="price" required>

        <label for="time">Thời gian dịch vụ:</label>
        <input type="text" id="time" name="time" required> <label for="category_id">Danh mục dịch vụ:</label>
        <select id="category_id" name="category_id" required>
            <?php
            foreach ($this->Import_Database->Get_Category_By_Like_Name('Dịch Vụ') as $category) {
                echo '<option value="' . $category['ID'] . '">' . $category['Name'] . '</option>';
            }
            ?>
        </select>

        <label for="image">Ảnh dịch vụ:</label>
        <input type="file" id="image" name="image" required>

        <button type="submit">Thêm dịch vụ</button>
    </form>
</main>