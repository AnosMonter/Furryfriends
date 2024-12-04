<style>
    .Thong-Ke-SP-BV-Moi {
        width: 100%;
        padding: 20px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr .8fr;
        grid-gap: 10px;
    }

    .box-product-new,
    .box-comment-product-new,
    .box-post-new {
        width: 100%;
        height: 50vh;
        display: flex;
        justify-content: center;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
        background-color: rgba(240, 240, 240, 0.7);
        padding: 20px;
        overflow-y: auto;
        border-radius: 10px;
    }

    .box-product-new h3,
    .box-comment-product-new h3,
    .box-post-new h3 {
        width: 100%;
        font-size: 25px;
        margin: 10px auto;
    }

    .product-new-item,
    .post-new-item {
        width: 100%;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        padding: 10px;
        display: flex;
        gap: 10px;
    }

    .product-new-item img,
    .post-new-item img {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }

    .product-new-item-info,
    .post-new-item-info {
        text-align: left;
    }

    .product-new-item-info h3,
    .post-new-item-info h3 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .product-new-item-info p,
    .post-new-item-info p {
        font-size: 14px;
        color: #666;
    }

    .comment-new-item {
        width: 100%;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        padding: 10px;
    }

    .comment-new-item-info {
        margin-bottom: 10px;
    }

    .comment-new-item-info h3 {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
    }

    .comment-new-item-info p {
        margin: 5px 0;
        font-size: 14px;
        line-height: 1.5;
    }

    .comment-new-item-info span {
        font-size: 12px;
        color: #888;
    }
</style>
<main>
    <h1 class="Title-Page-Main">Dashboard</h1>
    <div class="Thong-Ke-SP-BV-Moi">
        <div class="box-product-new">
            <h3>Danh Sách Sản Phẩm Mới</h3>
            <?php
            foreach ($this->Import_Database->Get_Product_Limit_New(10) as $product) {
            ?>
                <a href="index.php?Page=chi_tiet&id=<?= $product['ID'] ?>" class="product-new-item">
                    <img src="<?= $product['Image'] ?>" alt="">
                    <div class="product-new-item-info">
                        <h3><?= $product['Name'] ?></h3>
                        <p><?= $product['Discount'] ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
        <div class="box-post-new">
            <h3>Danh Sách Bài Viết Mới</h3>
            <?php
            foreach ($this->Import_Database->Get_News_Limit_New(10) as $new) {
            ?>
                <a href="index.php?Page=bv&ID=<?= $new['ID'] ?>" class="post-new-item">
                    <img src="<?= $new['Image'] ?>" alt="">
                    <div class="post-new-item-info">
                        <h3><?= $new['Name'] ?></h3>
                        <p><?= $new['Create_Date'] ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
        <div class="box-comment-product-new">
            <h3>Danh Sách Đánh Giá Mới</h3>
            <?php
            foreach ($this->Import_Database->Get_Comment_Product_Limit_New(10) as $comment) {
            ?>
                <a href="index.php?Page=chi_tiet&id=<?= $comment['ID_Product'] ?>" class="comment-new-item">
                    <div class="comment-new-item-info">
                        <h3><?= $comment['Name'] ?></h3>
                        <p><?= $comment['Review'] ?></p>
                        <span><?= $comment['Date'] ?></span>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="Thong-ke-tren-tong-don-hang">
        <div class="Tong-doanh-thu">
            <h2>Tổng Doanh Thu</h2>
            <div class="box-item-thong-ke">
                <p><?= number_format($Total, 0, ',', ',') . 'VNĐ' ?></p>
                <i class="fa-solid fa-money-bill"></i>
            </div>
        </div>
        <div class="Tong-don-hang">
            <h2>Tổng Số Lượng Đơn Hàng</h2>
            <div class="box-item-thong-ke">
                <p><?= $Count_Order; ?></p>
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
        </div>
        <div class="Tong-san-pham">
            <h2>Đơn Hàng Thành Công</h2>
            <div class="box-item-thong-ke">
                <p><?= $Order_Suc; ?></p>
                <i class="fa-brands fa-dropbox"></i>
            </div>
        </div>
        <div class="Tong-san-pham">
            <h2>Đơn Hàng Chưa Xác Nhận</h2>
            <div class="box-item-thong-ke">
                <p><?= $xuly; ?></p>
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
        </div>
        <div class="Tong-san-pham">
            <h2>Tổng Số Sản Phẩm</h2>
            <div class="box-item-thong-ke">
                <p><?= count($this->Import_Database->Get_All_Products()) ?></p>
                <i class="fa-solid fa-times-circle"></i>
            </div>
        </div>
        <div class="Tong-san-pham">
            <h2>Tổng Số Bài Viết</h2>
            <div class="box-item-thong-ke">
                <p><?= count($this->Import_Database->Get_All_News()) ?></p>
                <i class="fa-solid fa-box-open"></i>
            </div>
        </div>
    </div>
</main>