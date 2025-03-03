<main>
    <div class="slideshow-container">
        <?php foreach ($Slide_Banner as $Banner) { ?>
            <div class="mySlides fade">
                <img src="<?= $Banner['Image'] ?>" style="width: 100%">
            </div><?php } ?>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <div class="aboutUs">
        <div class="col25">
            <h4>SHIP COD TOÀN QUỐC</h4>
            <p>Thanh toán khi nhận hàng</p>
        </div>
        <div class="col25">
            <h4>MIỄN PHÍ ĐỔI HÀNG</h4>
            <p>Trong vòng 7 ngày</p>
        </div>
        <div class="col25">
            <h4>GIAO HÀNG TRONG NGÀY</h4>
            <p>Đối với đơn trong nội thành Hồ Chí Minh</p>
        </div>
        <div class="col25">
            <h4>ĐẶT HÀNG TRỰC TIẾP</h4>
            <p>Hotline: 09999999999</p>
        </div>
    </div>

    <div class="banner-section">
        <h2 class="banner-title">Mua sắm theo giống thú cưng</h2>
        <div class="banner-container">
            <!-- Banner dành cho chó -->
            <div class="banner-left">
                <?php if (!empty($banner_cho)) : ?>
                    <a href="index.php?Page=tim_kiem&Search=chó">
                        <img src="<?= htmlspecialchars($banner_cho['Image']) ?>" alt="Dog Banner">
                    </a>
                <?php endif; ?>
            </div>

            <!-- Banner dành cho mèo -->
            <div class="banner-right">
                <?php if (!empty($banner_meo)) : ?>
                    <a href="index.php?Page=tim_kiem&Search=mèo">
                        <img src="<?= htmlspecialchars($banner_meo['Image']) ?>" alt="Cat Banner">
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="categories-section">
        <h2 class="category-title">Bộ Sưu Tập Cho Mèo Và Chó</h2>
        <div class="category-container">
            <?php foreach ($dm_arr as $dm): ?>
                <div class="cate-item">
                    <a href="index.php?Page=san_pham_dm&id=<?php echo $dm['ID']; ?>">
                        <img src="<?php echo $dm['Image']; ?>" alt="<?php echo $dm['Name']; ?>"><br>
                        <?php echo $dm['Name']; ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="main-container">
        <!-- Phần hiển thị tất cả sản phẩm -->
        <div class="all-products">
            <h2 class="title_product">HÀNG MỚI VỀ</h2>
            <div class="products">
                <?php foreach ($moi_arr as $sp): ?>
                    <div class="product-item">
                        <a href="index.php?Page=chi_tiet&id=<?php echo $sp['ID']; ?>">
                            <img src="<?php echo $sp['Image']; ?>" alt="<?php echo $sp['Name']; ?>">
                        </a>
                        <div class="item-name">
                            <h3><a href="index.php?Page=chi_tiet&id=<?php echo $sp['ID']; ?>"><?php echo $sp['Name']; ?></a></h3>
                        </div>
                        <div class="item-price">
                            <span><?php echo number_format($sp['Discount'], 0, ',', '.'); ?> Đ</span>
                            <del><?php echo number_format($sp['Price'], 0, ',', '.'); ?> Đ</del>
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

        <div class="all-products">
            <h2 class="title_product">SẢN PHẨM XEM NHIỀU</h2>
            <div class="products">
                <?php foreach ($xn_arr as $sp): ?>
                    <div class="product-item">
                        <a href="index.php?Page=chi_tiet&id=<?php echo $sp['ID']; ?>">
                            <img src="<?php echo $sp['Image']; ?>" alt="<?php echo $sp['Name']; ?>">
                        </a>
                        <div class="item-name">
                            <h3><a href="index.php?Page=chi_tiet&id=<?php echo $sp['ID']; ?>"><?php echo $sp['Name']; ?></a></h3>
                        </div>
                        <div class="item-price">
                            <span><?php echo number_format($sp['Discount'], 0, ',', '.'); ?> Đ</span>
                            <del><?php echo number_format($sp['Price'], 0, ',', '.'); ?> Đ</del>
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

            <div class="all-products">
                <h2 class="title_product">ĐỒ CHO MÈO</h2>
                <div class="products">
                    <?php foreach ($sp_meo_arr as $sp): ?>
                        <div class="product-item">
                            <a href="index.php?Page=chi_tiet&id=<?php echo $sp['ID']; ?>">
                                <img src="<?php echo $sp['Image']; ?>" alt="<?php echo $sp['Name']; ?>">
                            </a>
                            <div class="item-name">
                                <h3><a href="index.php?Page=chi_tiet&id=<?php echo $sp['ID']; ?>"><?php echo $sp['Name']; ?></a></h3>
                            </div>
                            <div class="item-price">
                                <span><?php echo number_format($sp['Discount'], 0, ',', '.'); ?> Đ</span>
                                <del><?php echo number_format($sp['Price'], 0, ',', '.'); ?> Đ</del>
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
                <img src="<?= htmlspecialchars($banner_meo_2['Image']) ?>" style="width: 90%; height: auto; margin: 20px 20px;" alt="Banner Mèo">
                <div class="all-products">
                    <h2 class="title_product">ĐỒ CHO CHÓ</h2>
                    <div class="products">
                        <?php foreach ($sp_cho_arr as $sp): ?>
                            <div class="product-item">
                                <a href="index.php?Page=chi_tiet&id=<?php echo $sp['ID']; ?>">
                                    <img src="<?php echo $sp['Image']; ?>" alt="<?php echo $sp['Name']; ?>">
                                </a>
                                <div class="item-name">
                                    <h3><a href="index.php?Page=chi_tiet&id=<?php echo $sp['ID']; ?>"><?php echo $sp['Name']; ?></a></h3>
                                </div>
                                <div class="item-price">
                                    <span><?php echo number_format($sp['Discount'], 0, ',', '.'); ?> Đ</span>
                                    <del><?php echo number_format($sp['Price'], 0, ',', '.'); ?> Đ</del>
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
                    <img src="<?= htmlspecialchars($banner_cho_2['Image']) ?>" style="width: 90%; height: auto; margin: 20px 20px;" alt="Banner Chó">
                </div>
            </div>
        </div>
    </div>

    <div class="home-news-container">
        <h2 class="title_product">Tin Tức Nhanh</h2>
        <div class=" news ">
            <?php foreach ($this->Database->Bai_Viet_Ngau_Nhien(3) as $row) {  ?>
                <div class="bv article-item" id="data" class="article-item">
                    <a href="#" class="image">
                        <img src="<?php if (substr($row['Image'], 0, 4) == "http") echo $row['Image'];
                                    else echo $row['Image']; ?>" />
                    </a>
                    <h3 class="blog-title">
                        <a href="index.php?Page=bv&ID=<?php echo $row['ID'] ?>">
                            <?php echo $row['Name']; ?>
                        </a>
                    </h3>
                    <div class="btn-date-create">
                        <a href="index.php?Page=bv&ID=<?php echo $row['ID'] ?>" class="button blog-btn link">
                            <span class="text">Đọc thêm</span> </a>
                        <div class="date-create-new"><?= $row['Create_Date']; ?></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
