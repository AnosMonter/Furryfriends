<main>
    <div class="Container">
        <div class="Box-Cart">
            <h1 style="margin: 20px 0;">Giỏ Hàng Của Bạn</h1>
            <div class="col7">
                <div id="product-cart">
                    <table border="1">
                        <?php
                        $tong = 0;
                        if (!isset($_SESSION['myCart']['listCart']) || empty($_SESSION['myCart']['listCart'])) {
                            echo '<h2 style="text-align: center; line-height: 80px;">Giỏ hàng của bạn đang trống</h2>';
                            echo '<style>.cart-col-product, .cart-name-product, #tongtien{display: none;}</style>';
                        } else {
                            echo '<tr>
                                    <td colspan="2" class="cart-name-product">Sản Phẩm</td>
                                    <td class="cart-col-product">Giá</td>
                                    <td class="cart-col-product">Số lượng</td>
                                    <td class="cart-col-product">Thành tiền</td>
                                    <td class="cart-col-product"></td>
                                </tr>';

                            $i = 0;
                            foreach ($_SESSION['myCart']['listCart'] as $cart) {
                                $ttien = $cart[5];
                                $tong += $ttien;
                                $delCart = '<a href="index.php?Page=delcart&idcart=' . $i . '"><input type="button" class="btn-del-cart" value="Xóa"></a>';
                                echo '<tr>
                                        <td class="cart-col-product"><img src="' . $cart[2] . '" height="80px"></td>
                                        <td class="cart-name-product">' . $cart[1] . '</td><td class="cart-col-product"><span style="text-decoration: line-through; color: rgba(206, 203, 203, 1)">' . number_format($cart[3], 0, "", ".") . '</span><br>' . number_format($cart[6], 0, "", ".") . 'đ</td>
                                        <td class="cart-col-product">
                                            <button class="btn-change-quantity" onclick="updateQuantity(' . $i . ', -1)">-</button>
                                            <span id="quantity-' . $i . '">' . $cart[4] . '</span>
                                            <input type="hidden" id="max-quantity-in-product-'.$i.'" value="'. $this->Database->Get_Product_By_ID($cart[0])['Quantity'] .'">
                                            <button class="btn-change-quantity" onclick="updateQuantity(' . $i . ', 1)">+</button>
                                        </td>
                                        <td class="cart-col-product"><span id="total-' . $i . '">' . number_format($ttien, 0, "", ".") . 'đ</span></td>
                                        <td class="cart-col-product">' . $delCart . '</td>
                                    </tr>';
                                $i += 1;
                            }

                            echo '<tr>
                                    <td colspan="4"><a style="color:white; background-color: green; padding: 5px; border-radius: 3px;" href="index.php?Page=gio_hang">Cập nhật giỏ hàng</a></td>
                                    <td style="white-space: nowrap;" id="tongtien">Tổng: ' . number_format($tong, 0, "", ".") . 'đ</td></tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="col4">
                <table border="1">
                    <tr>
                        <td colspan="2">
                            <h2>Thông tin đơn hàng</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 25px">Tổng tiền:</td>

                        <td style="color: #ff0000; font-size: 25px"><?php echo number_format($tong, 0, "", ".") ?>đ</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 20px 60px;">
                            <p>Miễn phí vận chuyển cho đơn hàng từ 399.000đ
                                -Giao hàng hỏa tốc trong vòng 4 giờ, áp dụng tại khu vực nội thành Hồ Chí Minh</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?= (!isset($_SESSION['myCart']['listCart']) || empty($_SESSION['myCart']['listCart']))? '<button id="checkout" name="">Không Có Sản Phẩm</button>':'<button id="checkout" name=""><a style="color:white;" href="index.php?Page=kiem_tra_thanh_toan">Thanh toán</a></button>' ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script>
        var Cart = <?php echo json_encode($_SESSION['myCart']['listCart']); ?>;

    </script>​
</main>