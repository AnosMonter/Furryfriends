<main>
    <div class="sp-dm">
        <h2><?php echo $TitlePage; ?></h2>
        <div class="products">
            <?php foreach ($dm_sp_arr as $dm_sp): ?>
                <div class="product-item">
                    <a href="index.php?Page=chi_tiet&id=<?php echo $dm_sp['ID']; ?>">
                        <img src="<?php echo $dm_sp['Image']; ?>" alt="<?php echo $dm_sp['Name']; ?>">
                    </a>
                    <div class="item-name"><h3><a href="index.php?Page=chi_tiet&id=<?php echo $dm_sp['ID']; ?>"><?php echo $dm_sp['Name']; ?></a></h3></div>
                    <div class="item-price">
                        <span><?php echo number_format($dm_sp['Price'], 0, ',', '.'); ?> Đ</span>
                        <?php if ($dm_sp['Discount'] > 0): ?>
                            <del><?php echo number_format($dm_sp['Discount'], 0, ',', '.'); ?> Đ</del>
                        <?php endif; ?>
                    </div>
                    <form action="index.php?Page=gio_hang" method="post">
                            <input type="hidden" name="ID" value="<?php echo $dm_sp['ID']; ?>">
                            <input type="hidden" name="Name" value="<?php echo $dm_sp['Name']; ?>">
                            <input type="hidden" name="Image" value="<?php echo $dm_sp['Image']; ?>">
                            <input type="hidden" name="Discount" value="<?php echo $dm_sp['Discount']; ?>">
                            <input type="hidden" name="Price" value="<?php echo $dm_sp['Price']; ?>">
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
                echo "<a href='index.php?Page=san_pham_dm&id=$id&page_num=$i' class='$active_class'>$i</a>";
            }
        ?>
    </div>
</main>
