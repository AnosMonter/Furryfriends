<main>
    <div class="container1">
        <div class="sidebar">
            <div class="side-bar-sticky">
                <div class="sidebarBlock sidebar-post">
                    <h3 class="sidebarBlock-header">Sự Kiện Mới</h3>
                    <?php foreach ($random_articles as $row1) { ?>
                        <div class="siderbarBlock-content">
                            <div class="postlist">
                                <div class="postlist-item">
                                    <h6 class="title">
                                        <a href="index.php?Page=bv&ID=<?php echo $row1['ID'] ?>" class="link link-underline">
                                            <span><?php echo $row1['Name']; ?></span>
                                        </a>
                                    </h6>
                                    <p class="date"><?php echo date('d/m/Y', strtotime($row1['Create_Date'])) ?></p>
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
            <div id="chitiet_bai_viet">
                <h1> <?php echo $row['Name']; ?>
                </h1>
                <span class="ngay">Cập nhật: <?php echo date('d/m/Y', strtotime($row['Create_Date'])) ?></span>
                <div id="noi_dung"> <?php echo $row['Content'] ?> </div>
            </div>

        </div>
    </div>


    <!-- Form thêm bình luận -->
    <div class="form-container">
        <?= isset($_SESSION['User_login']) && !empty($_SESSION['User_login'])? '<form class="news-comment-form" action="" method="POST">
            <textarea name="Comment" placeholder="Nhập bình luận của bạn" class="form-control" required></textarea>
            <button type="submit" class="btn btn-primary">Gửi</button>
        </form>' : 'Bạn Cần Đăng Nhập Để Có Thể Bình Luận'?>
    </div>
    <!-- Hiển thị danh sách bình luận -->
    <div class="comment-list1">
        <?php if (!empty($comments)) { ?>
            <ul class="comment-list">
                <?php foreach ($comments as $comment) { ?>
                    <li>
                        <strong><?php echo htmlspecialchars($comment['User_Name']); ?></strong> -
                        <span><?php echo date('d/m/Y H:i', strtotime($comment['Sent_Date'])); ?></span>
                        <p style="color: black;" ><?php echo nl2br(htmlspecialchars($comment['Comment'])); ?></p>
                    </li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p>Chưa có bình luận nào.</p>
        <?php } ?>
    </div>
</main>