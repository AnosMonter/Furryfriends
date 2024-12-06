<main>
    <div class="Container">
        <input type="checkbox" id="Log-Reg"<?= isset($_GET['D']) == 1? 'checked':'' ?> <?= !empty($loi) ? 'checked' : '' ?>>
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

                        <!-- TÊN NGƯỜI DÙNG -->
                        <p>TÊN NGƯỜI DÙNG</p>
                        <input type="text" placeholder="Nhập tên người dùng:" name="Ten" value="<?= isset($_POST['Ten']) ? $_POST['Ten'] : '' ?>">
                        <?php if (isset($loi['Ten'])): ?>
                            <div class="error"><?= $loi['Ten'] ?></div>
                        <?php endif; ?>

                        <!-- TÊN HIỂN THỊ -->
                        <p>TÊN HIỂN THỊ</p>
                        <input type="text" placeholder="Nhập tên hiển thị:" name="Ten_hien_thi" value="<?= isset($_POST['Ten_hien_thi']) ? $_POST['Ten_hien_thi'] : '' ?>">
                        <?php if (isset($loi['Ten_hien_thi'])): ?>
                            <div class="error"><?= $loi['Ten_hien_thi'] ?></div>
                        <?php endif; ?>

                        <!-- SỐ ĐIỆN THOẠI -->
                        <p>SỐ ĐIỆN THOẠI</p>
                        <input type="text" placeholder="SDT:" name="So_dien_thoai" value="<?= isset($_POST['So_dien_thoai']) ? $_POST['So_dien_thoai'] : '' ?>">
                        <?php if (isset($loi['So_dien_thoai'])): ?>
                            <div class="error"><?= $loi['So_dien_thoai'] ?></div>
                        <?php endif; ?>

                        <!-- EMAIL -->
                        <p>EMAIL</p>
                        <input type="text" placeholder="Email:" name="Email" value="<?= isset($_POST['Email']) ? $_POST['Email'] : '' ?>">
                        <?php if (isset($loi['Email'])): ?>
                            <div class="error"><?= $loi['Email'] ?></div>
                        <?php endif; ?>

                        <!-- MẬT KHẨU -->
                        <p>MẬT KHẨU</p>
                        <input type="password" placeholder="Mật Khẩu:" name="Mat_khau" value="<?= isset($_POST['Mat_khau']) ? $_POST['Mat_khau'] : '' ?>">
                        <?php if (isset($loi['Mat_khau'])): ?>
                            <div class="error"><?= $loi['Mat_khau'] ?></div>
                        <?php endif; ?>

                        <button type="submit" value="dangky" name="dangky">Đăng ký</button><br>
                    </form>

                    <br>

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
                        <input type="text" placeholder="Email:" name="Email" value="<?= isset($_POST['Email']) ? $_POST['Email'] : '' ?>">
                        <?php if (isset($loi1['Email'])): ?>
                            <div class="error"><?= $loi1['Email'] ?></div>
                        <?php endif; ?>

                        <p>MẬT KHẨU</p>
                        <input type="password" placeholder="Mật Khẩu:" name="Pass">
                        <?php if (isset($loi1['Mat_khau'])): ?>
                            <div class="error"><?= $loi1['Mat_khau'] ?></div>
                        <?php endif; ?>

                        <?php if (isset($loi1['Credentials'])): ?>
                            <div class="error"><?= $loi1['Credentials'] ?></div>
                        <?php endif; ?>

                        <?php if (isset($loi1['Status'])): ?>
                            <div class="error"><?= $loi1['Status'] ?></div>
                        <?php endif; ?>

                        <br>
                        <a href="index.php?Page=quen_mat_khau">Quên mật khẩu</a><br>
                        <button type="submit" value="dangnhap" name="dangnhap">Đăng nhập</button><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>