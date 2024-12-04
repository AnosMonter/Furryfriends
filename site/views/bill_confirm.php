<style>

</style>
<main>
    <div class="Container">
        <div class="Box-bill-confirm" >
            <div class="cart-process">
                <div class="cart-process-child"><i class="fa-solid fa-cart-shopping" style="color: #ffffff; background-color: #066EFF;"></i>
                    <p>Kiểm tra</p>
                </div>
                <div class="cart-process-child"><i class="fa-regular fa-credit-card" style="color: #ffffff;background-color: #066EFF;"></i>
                    <p>Thanh toán</p>
                </div>
                <div class="cart-process-child"><i class="fa-solid fa-check" style="color: #ffffff;"></i></i>
                    <p>Xác nhận</p>
                </div>
            </div>
            <div class="col6">

                <form action="index.php?Page=xac_nhan_dat_hang" method="post" id="thong_tin_nguoi_nhan">
                    <h2 style="margin-bottom: 20px;">Thông tin người nhận</span></h2>


                    <table border="1" >
                        <?php foreach ($_SESSION['myCart']['infoOrder'] as $info) {
                            echo '<tr>
                            <td class="left">Họ và tên:</td>
                            <td>' . $info[0] . '</td>
                        </tr>
                        <tr>
                            <td class="left">Số điện thoại:</td>
                            <td>' . $info[2] . '</td>
                        </tr>
                        <tr>
                            <td class="left">Email:</td>
                            <td>' . $info[6] . '</td>
                        </tr>
                        <tr>
                            <td class="left">Địa chỉ:</td>
                            <td>' . $info[1] . '</td>
                        </tr>
                        <?php if (!empty($info[7])): ?>
                        <tr>
                            <td class="left">Ghi chú:</td>
                            <td><?php echo htmlspecialchars($info[7]); ?></td>
                        </tr>
                        <?php endif; ?>
                </table>';
                        }

                        ?>

            </div>
            <div class="col4">
                <div id="chi_tiet_don_hang">
                    <h2 style="margin-bottom: 20px;">Thông tin đơn hàng</span></h2>
                    <table border=”1” style="text-align: left;">
                        <?php
                        $tong = 0;

                        foreach ($_SESSION['myCart']['listCart'] as $cart) {
                            $ttien = $cart[3] * $cart[4];
                            $tong += $ttien;
                            echo '<tr>
                <td >Tên sản phẩm</td>
                <td>' . $cart[1] . '<br><span>' . $cart[4] . ' x ' . number_format($cart[3], 0, "", ".") . '</span></td>
            </tr>';
                        }
                        echo '
            <tr>
            <td>Ngày mua hàng</td>
            <td>' . $info[3] . '</td>
            </tr>
                    
            ';


                        echo '
            <tr>
                <td style="border-bottom: 0; font-weight: bold;">Tổng cộng:</td>
                <td id="tongtien" style="border-bottom: 0; font-weight: bold;" >' . number_format($tong, 0, "", ".") . 'đ</td>
            </tr><input type="text" hidden name="tong" value="' . $tong . '">
            <tr ><td colspan="3"><input type="submit" value="Xác nhận đặt hàng" id="checkout" name="xacnhandathang" ></td></tr>
            </form>
            ';

                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>