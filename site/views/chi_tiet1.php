<main>
    <div id="chi-tiet">
        <div id="row1">
            <div id="left">
                <img src="<?php echo $row['Image']; ?>" alt="<?php echo htmlspecialchars($row['Name']); ?>" />
            </div>
            <div id="right">
                <h1><?php echo $row['Name']; ?></h1>
                <ul class="tt1">
                    <li>Mã sản phẩm: <?php echo $row['ID']; ?></li>
                    <li>Thương Hiệu: Furry Friends</li>
                    <li>Tình trạng:
                        <?php if ($row['Quantity'] > 0): ?>
                            <span class="in-stock">Còn hàng</span>
                        <?php else: ?>
                            <span class="out-stock">Hết hàng</span>
                        <?php endif; ?>
                    </li>
                </ul>
                <p>
                    <span style="font-weight: 800; font-size: 22px;">Giá bán: </span>
                    <span class="price-current" style="font-size: 22px;"><?php echo number_format($row['Discount'], 0, ',', '.'); ?> Đ</span>
                    <?php if ($row['Discount'] > 0): ?>
                        <span class="price-old"><?php echo number_format($row['Price'], 0, ',', '.'); ?> Đ</span>
                    <?php endif; ?>
                </p>
                <p><span style="font-weight: 800; font-size: 22px;">Mô tả: </span><?php echo $row['Description']; ?></p>
                <hr>
                <div id="quantity-container">
                    <button id="btn-decrease" class="btn" onclick="updateQuantity(-1)">-</button>
                    <input type="text" id="quantity" value="1" readonly>
                    <button id="btn-increase" class="btn" onclick="updateQuantity(1)">+</button>
                    <form action="index.php?Page=gio_hang" method="post">
                        <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                        <input type="hidden" name="Name" value="<?php echo $row['Name']; ?>">
                        <input type="hidden" name="Image" value="<?php echo $row['Image']; ?>">
                        <input type="hidden" name="Discount" value="<?php echo $row['Discount']; ?>">
                        <input type="hidden" name="Price" value="<?php echo $row['Price']; ?>">
                        <input type="hidden" name="Quantity" value="1">
                        <button type="submit" class="btn-add-cart-detail" name>Chọn Mua<i class="fa-solid fa-cart-shopping"></i></button></p>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div id="product-detail" class="collapsed">
            <span style="font-weight: 800;">Chi tiết sản phẩm: </span><br>
            <p>
                <?php echo nl2br($row['Detail']); ?>
            </p>
            <span class="toggle-btn">Xem thêm</span>
        </div>
        <div id="binh-luan">
            <h2 class="title_product">Đánh giá</h2>
            <div class="comm-container">
                <?php if (!empty($binhluan_arr)): ?>
                    <?php foreach ($binhluan_arr as $binhluan): ?>
                        <div class="comment">
                            <p><strong><?= htmlspecialchars($binhluan['UserName']); ?></strong> (<?= $binhluan['Date']; ?>):</p>
                            <p>Rating: <?= $binhluan['Rating']; ?> ⭐</p>
                            <p><?= htmlspecialchars($binhluan['Review']); ?></p>
                            <hr>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Chưa có bình luận nào cho sản phẩm này.</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row2"><?php include_once 'site/views/sp_lienquan.php'; ?></div>
    </div>
</main>

<script>
    function toggleDetails() {
        const details = document.getElementById('product-detail');
        details.classList.toggle('collapsed');
    }
</script>