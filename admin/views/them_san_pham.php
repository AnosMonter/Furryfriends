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

    button[type="submit"] {
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
    <form action="admin.php?Page=them_san_pham" method="post" enctype="multipart/form-data">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" required>
        <?= isset($nameError) ? '<p class="Error">' . $nameError . '</p>' : '' ?>

        <label for="price">Giá:</label>
        <input type="number" id="price" name="price" required>
        <?= isset($priceError) ? '<p class="Error">' . $priceError . '</p>' : '' ?>

        <label for="discount">Giảm giá:</label>
        <input type="number" id="discount" name="discount">
        <?= isset($discountError) ? '<p class="Error">' . $discountError . '</p>' : '' ?>

        <label for="image">Hình ảnh:</label>
        <input type="file" id="image" name="image">
        <?= isset($imageError) ? '<p class="Error">' . $imageError . '</p>' : '' ?>

        <label for="description">Mô tả ngắn:</label>
        <textarea id="description" name="description"></textarea>
        <?= isset($descriptionError) ? '<p class="Error">' . $descriptionError . '</p>' : '' ?>

        <label for="detail">Mô tả chi tiết:</label>
        <textarea id="detail" name="detail" id="mota">
            <p></p>
        </textarea>
        <?= isset($detailError) ? '<p class="Error">' . $detailError . '</p>' : '' ?>

        <label for="quantity">Số lượng:</label>
        <input type="number" id="quantity" name="quantity" required>
        <?= isset($quantityError) ? '<p class="Error">' . $quantityError . '</p>' : '' ?>

        <label for="status">Trạng thái:</label>
        <select id="status" name="status">
            <option value="0">Ẩn</option>
            <option value="1">Hiển thị</option>
            <option value="2">Còn Hàng</option>
            <option value="3">Hết Hàng</option>
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

        <input type="submit" value="Thêm Sản Phẩm">
    </form>
    <script src="system/lib/ckeditor5-44.0.0/ckeditor5/ckeditor5.js"></script>
    <script>
        const {
            ClassicEditor,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font
        } = CKEDITOR;
        ClassicEditor.create(document.querySelector('#mota'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor.create(document.querySelector('#mota'), {
                language: 'vi'
            })
            .then(editor => {})
            .catch(error => {
                console.error(error)
            });
        ClassicEditor.create(document.querySelector('#mota'), {
                language: 'vi',
                ckfinder: {
                    uploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                },
                toolbar: {
                    items: [
                        'fontfamily', 'fontsize', '|',
                        'heading', '|',
                        'alignment', '|',
                        'fontColor', 'fontBackgroundColor', '|',
                        'bold', 'italic', 'underline', 'subscript', 'superscript', '|',
                        'link', '|',
                        'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'code', 'codeBlock', '|',
                        'insertTable', '|',
                        'uploadImage', '|',
                        'ckfinder',
                        'undo', 'redo'
                    ],
                    shouldNotGroupWhenFull: true
                }
            })
            .then(editor => {})
            .catch(error => {
                console.error(error)
            });
    </script>
</main>