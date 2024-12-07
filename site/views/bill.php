<main>
    <div class="Container">
        <div class="Box-bill">
            <div class="cart-process">
                <div class="cart-process-child"><i class="fa-solid fa-cart-shopping" style="color: #ffffff; background-color: #066EFF;"></i>
                    <p>Kiểm tra</p>
                </div>
                <div class="cart-process-child"><i class="fa-regular fa-credit-card" style="color: #ffffff;"></i>
                    <p>Thanh toán</p>
                </div>
                <div class="cart-process-child"><i class="fa-solid fa-check" style="color: #ffffff;"></i></i>
                    <p>Xác nhận</p>
                </div>
            </div>
            <div class="col6">

                <form action="index.php?Page=bill_confirm" method="post" id="thanh_toan">
                    <h2 style="margin-bottom: 20px;">Điền thông tin thanh toán<span style="float: right; font-size: 18px; padding-top: 5px; font-weight: 100;">
                            <a style="color: red;" href="index.php?Page=xoa_thong_tin_don_hang">Xóa thông tin</a></span></h2>
                    <label for="">Họ và tên *</label> <br>
                    <input type="text" name="name" value="<?php echo $name; ?>" required><br>
                    <label for="">Địa chỉ email *</label> <br>
                    <input type="text" name="email" value="<?php echo $email; ?>" required> <br>
                    <label for="">Số điện thoại *</label> <br>
                    <input type="text" name="phone" value=""> <br>
                    <label for="">Địa chỉ nhận hàng *</label> <br>
                    <input type="text" name="address" required> <br>
                    <label for="">Quốc gia *</label> <br>
                    <input type="text" name="country" value="Việt Nam" required> <br>
                    <label for="">Ghi chú (tùy chọn)</label> <br>
                    <textarea name="ghi_chu_don_hang" id="notecart" value="<?php echo $NoteCart; ?>"></textarea>
            </div>

            <div class="col3">
                <div id="product-cart">
                    <table border=”1”>
                        <?php

                        $tong = 0;
                        $i = 0;

                        if (!isset($_SESSION['myCart']['listCart']) || empty($_SESSION['myCart']['listCart'])) {
                            echo '<h2 style="text-align: center; line-height: 80px;">
                    Giỏ hàng của bạn đang trống</h2>';

                            echo '<style>
                    .cart-col-product, .cart-name-product, #tongtien{display: none;}
                    </style>';
                        }
                        echo '
                            <tr><td colspan="3" style="border-bottom: 0;"><h2>ĐƠN HÀNG CỦA BẠN</h2></td></tr>
                            <tr>
                            <td class="cart-col-product" style="display: none;"></td>
                            <td class="cart-name-product">Tên Sản Phẩm</td>
                            <td class="cart-col-product">Giá</td>
                            <td class="cart-col-product">Số lượng</td>
                            <td class="cart-col-product" style="display: none;">Thành tiền<?td>
                            <td style="display: none;"> </td>
                        </tr>';
                        foreach ($_SESSION['myCart']['listCart'] as $cart) {
                            $ttien = $cart[3] * $cart[4];
                            $tong += $ttien;
                            $delCart = '<a href="index.php?Page=delcart&idcart=' . $i . '"><input type="button" class="btn-del-cart" value="Xóa"></a>';
                            echo '<tr>
                                <td class="cart-col-product" style="display: none;"><img src="' . $cart[2] . '" height="80px"></td>
                                <td class="cart-name-product">' . $cart[1] . '</td>
                                <td class="cart-col-product">' . number_format($cart[3], 0, "", ".") . 'đ</td>
                                <td class="cart-col-product">' . $cart[4] . '</td>
                                <td class="cart-col-product" style="display: none;">' . number_format($ttien, 0, "", ".") . 'đ<?td>
                                <td class="cart-col-product" style="display: none;">' . $delCart . '</td>
                            </tr>';
                            $i += 1;
                        }

                        echo '
                        <tr>
                            <td style="border-bottom: 0;">Tổng cộng:</td>
                            <td style="border-bottom: 0;"></td>
                            <td id="tongtien" style="border-bottom: 0;">' . number_format($tong, 0, "", ".") . 'đ</td>
                        </tr><input type="text" hidden name="tong" value="' . $tong . '">
                        <tr ><td colspan="3"><input type="submit" value="Đặt hàng" id="checkout" name="dongydathang" ></td></tr>
                        </form>
                        ';
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>