<div class="all-products">
        <h2 class="title_product">Sản Phẩm Tương Tự</h2>
        <div class="products">
                <?php foreach ($lienquan_arr as $sp): ?>
                    <div class="product-item">
                        <a href="index.php?Page=chi_tiet&id=<?php echo $sp['ID']; ?>">
                            <img src="<?php echo $sp['Image']; ?>" alt="<?php echo $sp['Name']; ?>">
                        </a>
                        <h3><a href="index.php?Page=chi_tiet&id=<?php echo $sp['ID']; ?>"><?php echo $sp['Name']; ?></a></h3>
                        <div class="item-price">
                            <span><?php echo number_format($sp['Discount'], 0, ',', '.'); ?> Đ</span>
                            <?php if ($sp['Discount'] > 0): ?>
                                <del><?php echo number_format($sp['Price'], 0, ',', '.'); ?> Đ</del>
                            <?php endif; ?>
                        </div>
                        <button><a href="index.php?Page=chi_tiet&id=<?php echo $sp['ID']; ?>">Chọn mua<i class="fa-solid fa-cart-shopping"></i></a></button>
                    </div>
                <?php endforeach; ?>
        </div>

    </div>