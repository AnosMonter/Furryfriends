<main>
    <div class="sp-dm">
        <h2><?php echo $TitlePage; ?></h2>
        <div class="products">
            <?php foreach ($dm_sp_arr as $dm_sp): ?>
                <div class="product-item">
                    <a href="index.php?Page=chi_tiet&id=<?php echo $dm_sp['ID']; ?>">
                        <img src="<?php echo $dm_sp['Image']; ?>" alt="<?php echo $dm_sp['Name']; ?>">
                    </a>
                    <h3><a href="index.php?Page=chi_tiet&id=<?php echo $dm_sp['ID']; ?>"><?php echo $dm_sp['Name']; ?></a></h3>
                    <div class="item-price">
                        <span><?php echo number_format($dm_sp['Price'], 0, ',', '.'); ?> Đ</span>
                        <?php if ($dm_sp['Discount'] > 0): ?>
                            <del><?php echo number_format($dm_sp['Discount'], 0, ',', '.'); ?> Đ</del>
                        <?php endif; ?>
                    </div>
                    <button><a href="index.php?Page=chi_tiet&id=<?php echo $dm_sp['ID']; ?>">Chọn mua<i class="fa-solid fa-cart-shopping"></i></a></button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>