<style>
    .container {

        width: 1440px;
        margin: 0 auto;
    }

    .cart-process {
        width: 100%;
        padding: 10px 200px;
        display: flex;
        flex-wrap: wrap;
    }

    .cart-process-child {
        border-radius: 100%;
        width: 200px;
        text-align: center;
        padding: 20px;
        margin: 0 auto;
    }

    .cart-process-child i {
        border-radius: 100%;
        width: 80px;
        height: 80px;
        background-color: #707070;
        font-size: 38px;
        line-height: 80px;
    }

    .cart-process-child p {
        width: 100px;
        margin: 0 auto;
        font-size: 20px;
        line-height: 40px;
    }

    .cam_on_dat_hang {
        text-align: center;
        border: 1px black solid;
        border-radius: 7px;
        padding: 40px;
    }

    .cam_on_dat_hang img {
        width: 500px;
        margin: 0 auto;
    }
</style>
<?php


?>
<main>
    <div class="container">
        <div class="cart-process">
            <div class="cart-process-child"><i class="fa-solid fa-cart-shopping" style="color: #ffffff; background-color: #066EFF;"></i>
                <p>Kiểm tra</p>
            </div>
            <div class="cart-process-child"><i class="fa-regular fa-credit-card" style="color: #ffffff; background-color: #066EFF;"></i>
                <p>Thanh toán</p>
            </div>
            <div class="cart-process-child"><i class="fa-solid fa-check" style="color: #ffffff; background-color: #066EFF;"></i></i>
                <p>Xác nhận</p>
            </div>
        </div>
        <div class="cam_on_dat_hang">
            <img src="public/img/ty.jpg" alt="thank you for your order">
            <h1>Đơn hàng của bạn đã được ghi nhận. Shop sẽ liên lạc với bạn trong thời gian sớm nhất.</h1>
        </div>
    </div>
</main>

<script>
    alert('Đơn hàng đã được ghi nhận! Bạn sẽ được chuyển về trang chủ sau 10 giây.');
    setTimeout(function() {
        window.location.href = 'index.php';
    }, 10000);
</script>