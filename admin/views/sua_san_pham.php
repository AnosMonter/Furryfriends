<style>
    form {
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
    <form action="admin.php?Page=sua_san_pham&ID=<?php echo $product['ID']; ?>" method="post" enctype="multipart/form-data">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" value="<?php echo $product['Name']; ?>" required>
        <?= isset($nameError) ? '<p class="Error">' . $nameError . '</p>' : '' ?>

        <label for="price">Giá:</label>
        <input type="number" id="price" name="price" value="<?php echo $product['Price']; ?>" required>
        <?= isset($priceError) ? '<p class="Error">' . $priceError . '</p>' : '' ?>

        <label for="discount">Giảm giá:</label>
        <input type="number" id="discount" name="discount" value="<?php echo $product['Discount']; ?>">
        <?= isset($discountError) ? '<p class="Error">' . $discountError . '</p>' : '' ?>

        <label for="image">Hình ảnh hiện tại:</label>
        <img src="<?php echo substr($product['Image'], 0, 4) == 'http' ? $product['Image'] : 'public/img/Products/' . $product['Image']; ?>" alt="Hình ảnh sản phẩm" style="max-width: 200px;">
        <br>
        <label for="image">Chọn hình ảnh mới:</label>
        <input type="file" id="image" name="image">
        <?= isset($imageError) ? '<p class="Error">' . $imageError . '</p>' : '' ?>

        <label for="description">Mô tả ngắn:</label>
        <textarea id="description" name="description"><?php echo $product['Description']; ?></textarea>
        <?= isset($descriptionError) ? '<p class="Error">' . $descriptionError . '</p>' : '' ?>

        <label for="detail">Mô tả chi tiết:</label>
        <textarea id="detail" name="detail"><?php echo $product['Detail']; ?></textarea>
        <?= isset($detailError) ? '<p class="Error">' . $detailError . '</p>' : '' ?>

        <label for="quantity">Số lượng:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $product['Quantity']; ?>" required>
        <?= isset($quantityError) ? '<p class="Error">' . $quantityError . '</p>' : '' ?>

        <label for="status">Trạng thái:</label>
        <select id="status" name="status">
            <option value="0" <?php if ($product['Status'] == 0) echo 'selected'; ?>>Ẩn</option>
            <option value="1" <?php if ($product['Status'] == 1) echo 'selected'; ?>>Hiển thị</option>
            <option value="2" <?php if ($product['Status'] == 2) echo 'selected'; ?>>Còn Hàng</option>
            <option value="3" <?php if ($product['Status'] == 3) echo 'selected'; ?>>Hết Hàng</option>
        </select>
        <?= isset($statusError) ? '<p class="Error">' . $statusError . '</p>' : '' ?>

        <label for="category_id">Danh mục:</label>
        <select id="category_id" name="category_id">
            <?php
            foreach ($Category as $Category) {
                if ($Category['ID'] == $product['Category_ID']) {
                    echo '<option value="' . $Category['ID'] . '" selected>' . $Category['Name'] . '</option>';
                } else {
                    echo '<option value="' . $Category['ID'] . '">' . $Category['Name'] . '</option>';
                }
            }
            ?>
        </select>
        <?= isset($categoryError) ? '<p class="Error">' . $categoryError . '</p>' : '' ?>
        <input type="submit" value="Sửa Sản Phẩm">
    </form>
</main>