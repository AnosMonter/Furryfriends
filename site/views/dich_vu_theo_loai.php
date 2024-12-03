<style>
    .page-service-site {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    .page-service-site form {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-width: 400px;
    }

    .page-service-site select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .page-service-site button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }

    .service-detail-site {
        display: grid;
        grid-template-columns: 1fr 2fr;
        grid-gap: 20px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 10px;
    }

    .service-detail-site h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
        transition: color 0.3s ease-in-out;
    }

    .service-detail-site h2:hover {
        color: #007bff;
    }

    .service-detail-price {
        font-size: 20px;
        font-weight: bold;
    }
    .service-detail-price p {
        color: red;
    }

    .service-detail-content {
        font-size: 18px;
        line-height: 1.5;
        font-weight: bold;
    }

    .service-detail-site img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }
</style>
<main>
    <div class="page-service-site">
        <form action="index.php?Page=dich_vu&ID=<?= $_GET['ID'] ?>" method="post">
            Chọn Loại:
            <select name="Service" id="">
                <?php
                $List_DV ='';
                foreach ($Service as $ser) {
                    if (isset($Detail_Service) && !empty($Detail_Service) && $Detail_Service['ID'] == $ser['ID']) {
                        $List_DV .= $ser['Status'] != 0 ? '<option value="' . $ser['ID'] . '" selected>' . $ser['Name'] . '</option>' : '';
                    } else {
                        $List_DV .= $ser['Status'] != 0 ? '<option value="' . $ser['ID'] . '">' . $ser['Name'] . '</option>' : '';
                    }
                }
                echo !empty($List_DV)? $List_DV:'<option value="">Không Có Dịch Vụ Nào</option>';
                ?>
            </select>
            <button>Xem Chi Tiết Dịch Vụ</button>
        </form>
    </div>
    <?php
    if (isset($Detail_Service) && !empty($Detail_Service)) {
    ?>
        <div class="service-detail-site">
            <h2><?= $Detail_Service['Name'] ?> </h2>
            <div class="service-detail-price">Giá Dịch Vụ: <br><p><?= number_format($Detail_Service['Price'], 0, '.', '.') . 'VNĐ/' . $Detail_Service['Time_Service'] ?></p></div>
            <div class="service-detail-content"><?= nl2br($Detail_Service['Detail']) ?></div>
            <img src="<?= $Detail_Service['Image'] ?>" alt="<?= $Detail_Service['Name'] ?>">
        </div>
        </div>
    <?php
    } ?>
</main>