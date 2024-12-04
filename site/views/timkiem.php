<main>
    <div class="kq-timkiem">
        <h2><?php echo $TitlePage; ?></h2>
        <div class="filter-bar">
            <form method="GET" action="">
                <input type="hidden" name="Page" value="tim_kiem">
                <input type="hidden" name="Search" value="<?php echo isset($_GET['Search']) ? $_GET['Search'] : ''; ?>">

                <label for="sort_price">Sắp xếp:</label>
                <select id="sort_price" name="sort_price">
                    <option value="ASC" <?php echo (isset($_GET['sort_price']) && $_GET['sort_price'] == 'ASC') ? 'selected' : ''; ?>>Giá thấp đến cao</option>
                    <option value="DESC" <?php echo (isset($_GET['sort_price']) && $_GET['sort_price'] == 'DESC') ? 'selected' : ''; ?>>Giá cao đến thấp</option>
                </select>
                <button type="submit">Lọc</button>
            </form>
        </div>

        <div class="products">
            <?php foreach ($results as $product): ?>
                <div class="product-item">
                    <a href="index.php?Page=chi_tiet&id=<?php echo $product['ID']; ?>">
                        <img src="<?php echo $product['Image']; ?>" alt="<?php echo $product['Name']; ?>">
                    </a>
                    <h3><a href="index.php?Page=chi_tiet&id=<?php echo $product['ID']; ?>"><?php echo $product['Name']; ?></a></h3>
                    <div class="item-price">
                        <productan><?php echo number_format($product['Price'], 0, ',', '.'); ?> Đ</productan>
                        <?php if ($product['Discount'] > 0): ?>
                            <del><?php echo number_format($product['Discount'], 0, ',', '.'); ?> Đ</del>
                        <?php endif; ?>
                    </div>
                    <form action="index.php?Page=gio_hang" method="post">
                            <input type="hidden" name="ID" value="<?php echo $product['ID']; ?>">
                            <input type="hidden" name="Name" value="<?php echo $product['Name']; ?>">
                            <input type="hidden" name="Image" value="<?php echo $product['Image']; ?>">
                            <input type="hidden" name="Discount" value="<?php echo $product['Discount']; ?>">
                            <input type="hidden" name="Price" value="<?php echo $product['Price']; ?>">
                            <input type="hidden" name="Quantity" value="1">
                            <button type="submit" class="btn-add-cart">Chọn Mua<i class="fa-solid fa-cart-shopping"></i></button></p>
                        </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div id="so_trang">
        <?php
            $from = $page_num - 2;
            $to = $page_num + 2;
            if ($from <= 0) $from = 1;
            if ($to >= $so_trang) $to = $so_trang;
            for ($i = $from; $i <= $to; $i++) {
                // Thêm class 'active' cho trang hiện tại
                $active_class = ($i == $page_num) ? 'active' : '';
                echo "<a href='index.php?Page=tim_kiem&Search=$keyword&page_num=$i' class='$active_class'>$i</a>";
            }
        ?>
    </div>
</main>