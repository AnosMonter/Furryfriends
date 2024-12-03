<main>
    <div class="container1">
        <div class="sidebar">
            <div class="side-bar-sticky">
                <div class="sidebarBlock sidebar-post">
                    <h3 class="sidebarBlock-header">Sự Kiện Mới</h3>
                    <?php foreach ($random_articles as $row) { ?>
                        <div class="siderbarBlock-content">
                            <div class="postlist">
                                <div class="postlist-item">
                                    <h6 class="title">
                                        <a href="index.php?Page=bv&ID=<?php echo $row['ID'] ?>" class="link link-underline">
                                            <span><?php echo $row['Name']; ?></span>
                                        </a>
                                    </h6>
                                    <p class="date"><?php echo date('d/m/Y', strtotime($row['Create_Date'])) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <div class="sidebarBlock siderbar-image">
                    <h3 class="sidebarBlock-heading">
                        Royal Canin Giảm 20%
                    </h3>
                    <div class="sidebarBlock-content">
                        <div class="ad-image">
                            <a class="image" href="#" aria-label="link">
                                <img src="./public/img/1.webp" alt="hinhsale" loading="lazy">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="sidebarBlock siderbar-image">
                    <h3 class="sidebarBlock-heading">
                        Royal Canin Mua 1 Tặng 1
                    </h3>
                    <div class="sidebarBlock-content">
                        <div class="ad-image">
                            <a class="image" href="#" aria-label="link">
                                <img src="./public/img/2.webp" alt="hinhsa" loading="lazy">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="sidebarBlock sidebar-custom-text">
                    <h3 class="sidebarBlock-heading">
                        About Furry Friends
                    </h3>
                    <div class="sidebarBlock-content">
                        <div class="ad-text halo-text-format">
                            <p>Furry Friends Pet Shop chuyên cung cấp các sản phẩm chất lượng cao cho thú cưng.</p>
                            <br>
                            <p> Cửa Hàng Phụ Kiện Thú Cưng Uy Tín - Ship Hàng Nhanh Toàn Quốc.</p>
                            <br>
                            <p> Mua thức ăn mèo tốt nhất hiện nay. Hạt khô, pate, snack, súp thưởng, sữa, vitamin, gel dinh dưỡng.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=" news ">
            <?php foreach ($data_arr as $row) {  ?>
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

    <div id="pagination" class="form-container">
        <?php
        for ($i = 1; $i <= $so_trang; $i++) {
            echo "<a href='index.php?Page=bai_viet&page_num=$i'> $i </a>";
        }
        ?>
    </div>
</main>