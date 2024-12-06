<style>
    .serve_general{
        display: flex;
        /* justify-content: space-around; */
        margin: 20px 100px;
        padding: 20px;
    }
    .page-service-site {
        /* display: flex; */
        flex-direction: column;
        align-items: center;
        padding: 0 20px;
        width: 40%;
    }

    .page-service-site form {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-width: 300px;
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
    .service-detail-site h2 {
        margin: 20px 0;
    }
    .service-detail-price {
        font-size: 20px;
        font-weight: bold;
        margin: 10px 10px;
        color: red;
    }
    .service-detail-content {
        font-size: 16px;
        line-height: 1.5;
        font-weight:none;
        margin: 10px 20px;
    }
    .service-detail-site img {
        width: 70%;
        height: auto;
        border-radius: 10px;
        margin: 20px 50px;
    } 
    .server-intro{
        margin: 20px 20px;
    }
    .server-intro h1{
        text-align: center;
        margin: 10px 0;
    }
    
    
</style>
<main>
    <div class="serve_general">
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
        <div class="server-intro">
            <h1>Dịch vụ Furry Friends</h1>
            <span>Tại Furry Friends, chúng tôi hiểu rằng thú cưng không chỉ là những người bạn đồng hành, mà còn là một phần quan trọng trong gia đình bạn. 
            Vì vậy, chúng tôi tự hào mang đến các dịch vụ chăm sóc thú cưng toàn diện và chuyên nghiệp, giúp các bé luôn khỏe mạnh, hạnh phúc và được yêu thương.</span>
            
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
        </div>
    </div>
</main>
