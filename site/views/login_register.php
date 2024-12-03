<main>
    <div class="Container">
        <input type="checkbox" id="Log-Reg">
        <div class="box-login">
            <img width="400px"
                src="public/img/Log_reg.jpg"
                alt="">
            <div class="form-action">
                <div class="form-register">
                    <form action="index.php?Page=dang_ky" method="post">
                        <div class="dangnhap">
                            <label for="Log-Reg">
                                <div class="Login">Đăng Nhập</div>
                            </label>
                            <div class="Register" style="font-weight: bolder;">Đăng Ký</div>
                        </div>
                        <p>TÊN NGƯỜI DÙNG</p>
                        <input type="text" placeholder="Nhập tên người dùng:" name="Ten" required>
                        <p>TÊN HIỂN THỊ</p>
                        <input type="text" placeholder="Nhập tên hiển thị:" name="Ten_hien_thi" required>
                        <p>SỐ ĐIỆN THOẠI</p>
                        <input type="text" placeholder="SDT:" name="So_dien_thoai" required><br>
                        <p>EMAIL</p>
                        <input type="text" placeholder="Email:" name="Email" required>
                        <p>MẬT KHẨU</p>
                        <input type="password" placeholder="Mật Khẩu:" name="Mat_khau" required>
                        <button type="submit" value="dangky" name="dangky">Đăng ký</button><br>
                    </form>

                    <br>
                    ------------------------hoặc đăng nhập qua----------------------
                    <div class="social-login">
                        <button class="facebook">Đăng nhập Facebook</button>
                        <button class="google">Đăng nhập Google</button>
                    </div>
                </div>

                <div class="form-login">
                    <form action="index.php?Page=dang_nhap" method="post">
                        <div class="dangnhap">
                            <div class="Login" style="font-weight: bolder;">Đăng Nhập</div>
                            <label for="Log-Reg">
                                <div class="Register">Đăng Ký</div>
                            </label>
                        </div>
                        <p>EMAIL</p>
                        <input type="text" placeholder="Email:" name="Email">
                        <p>MẬT KHẨU</p>
                        <input type="password" placeholder="Mật Khẩu:" name="Pass"> <br>
                        <a href="index.php?Page=quen_mat_khau">Quên mật khẩu</a><br>
                        <button type="submit" value="dangnhap" name="dangnhap">Đăng nhập</button> <br>
                    </form>
                    <br>
                    -----------------hoặc đăng nhập qua-----------------
                    <div class="social-login">
                        <button class="facebook">Đăng nhập Facebook</button>
                        <button class="google">Đăng nhập Google</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>