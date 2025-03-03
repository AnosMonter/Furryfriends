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
                    <li>Lượt xem: <?php echo $row['Views']; ?></li>
                </ul>
                <p>
                    <span style="font-weight: 800; font-size: 22px;">Giá bán: </span>
                    <span class="price-current" style="font-size: 22px;"><?php echo number_format($row['Discount'], 0, ',', '.'); ?> Đ</span>
                    <?php if ($row['Discount'] > 0): ?>
                        <span class="price-old"><?php echo number_format($row['Price'], 0, ',', '.'); ?> Đ</span>
                    <?php endif; ?>
                </p>
                <p><span style="font-weight: 800; font-size: 22px;">Mô tả: </span><?php echo nl2br($row['Description']); ?></p>
                <div id="quantity-container">
                    <form action="index.php?Page=gio_hang" method="post">
                    <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                    <input type="hidden" name="Name" value="<?php echo $row['Name']; ?>">
                    <input type="hidden" name="Image" value="<?php echo $row['Image']; ?>">
                    <input type="hidden" name="Discount" value="<?php echo $row['Discount']; ?>">
                    <input type="hidden" name="Price" value="<?php echo $row['Price']; ?>">
                    <button id="btn-decrease" class="btn" onclick="updateQuan(event, -1)">-</button>
                    <input type="text" id="quantity" value="1" name="Quantity" readonly>
                    <button id="btn-increase" class="btn" onclick="updateQuan(event, 1)">+</button>
                    <button type="submit" class="btn-add-cart-detail" name="submit">Thêm vào giỏ hàng<i class="fa-solid fa-cart-shopping"></i></button>
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
            <h2 class="title_comment">Đánh giá</h2>
            <div class="comm-container <?= empty($binhluan_arr) ? 'no-comments' : ''; ?>">
                <?php if (!empty($binhluan_arr)): ?>
                    <ul class="comment-list">
                        <?php foreach ($binhluan_arr as $binhluan): ?>
                            <li class="comment">
                                <p><strong><?= htmlspecialchars($binhluan['UserName']); ?></strong> (<?= $binhluan['Date']; ?>):</p>
                                <p>Rating: <?= $binhluan['Rating']; ?> ⭐</p>
                                <p><?= htmlspecialchars($binhluan['Review']); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="notCmt">Chưa có đánh giá nào cho sản phẩm này.</p>
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

    function updateQuan(event, change) {
        event.preventDefault();
        const quantityInput = document.getElementById('quantity');
        let currentQuantity = parseInt(quantityInput.value);

        currentQuantity += change;

        if (currentQuantity < 1) {
            currentQuantity = 1;
        }
        quantityInput.value = currentQuantity;
    }
</script>
