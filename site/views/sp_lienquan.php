<div class="all-products">
        <h2 class="title_product">Sản Phẩm Tương Tự</h2>
        <div class="products">
                <?php foreach ($lienquan_arr as $sp): ?>
                    <div class="product-item">
                        <a href="index.php?Page=chi_tiet&id=<?php echo $sp['ID']; ?>">
                            <img src="<?php echo $sp['Image']; ?>" alt="<?php echo $sp['Name']; ?>">
                        </a>
                        <div class="item-name"><h3><a href="index.php?Page=chi_tiet&id=<?php echo $sp['ID']; ?>"><?php echo $sp['Name']; ?></a></h3></div>
                        <div class="item-price">
                            <span><?php echo number_format($sp['Discount'], 0, ',', '.'); ?> Đ</span>
                            <?php if ($sp['Discount'] > 0): ?>
                                <del><?php echo number_format($sp['Price'], 0, ',', '.'); ?> Đ</del>
                            <?php endif; ?>
                        </div>
                        <form action="index.php?Page=gio_hang" method="post">
                            <input type="hidden" name="ID" value="<?php echo $sp['ID']; ?>">
                            <input type="hidden" name="Name" value="<?php echo $sp['Name']; ?>">
                            <input type="hidden" name="Image" value="<?php echo $sp['Image']; ?>">
                            <input type="hidden" name="Discount" value="<?php echo $sp['Discount']; ?>">
                            <input type="hidden" name="Price" value="<?php echo $sp['Price']; ?>">
                            <input type="hidden" name="Quantity" value="1">
                            <button type="submit" class="btn-add-cart">Chọn Mua<i class="fa-solid fa-cart-shopping"></i></button></p>
                        </form>
                    </div>
                <?php endforeach; ?>
        </div>

    </div>
