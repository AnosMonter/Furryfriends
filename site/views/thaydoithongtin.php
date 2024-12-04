<main>
    <div class="Container">
    <input type="checkbox" id="Log-Reg" <?= !empty($errors) ? 'checked' : '' ?>>
        <div class="box-login">
            <img width="400px"
                src="public/img/Log_reg.jpg"
                alt="">
            <div class="form-action">
                <div class="form-login">
                    <form action="index.php?Page=chinh_sua_thong_tin" method="post">
                        <div class="dangnhap">
                            <div class="Register" style="font-weight: bolder;">Thay Đổi Thông Tin</div>
                            <label for="Log-Reg">
                                <div class="Login">Đổi Mật Khẩu</div>
                            </label>
                        </div>
                        <p>Tên Người Dùng</p>
                        <input type="text" placeholder="Nhập tên người dùng:" name="username" value="<?= isset($Infor_User['Username']) && !empty($Infor_User['Username']) ? $Infor_User['Username'] : '' ?>" required> <br>
                        <p>EMAIL</p>
                        <input type="email" name="email" placeholder="Nhập email" value="<?= isset($Infor_User['Email']) && !empty($Infor_User['Email']) ? $Infor_User['Email'] : '' ?>" required><br>
                        <p>SỐ ĐIỆN THOẠI</p>
                        <input type="text" name="phone" placeholder="Số điện thoại" value="<?= isset($Infor_User['Phone']) && !empty($Infor_User['Phone']) ? $Infor_User['Phone'] : '' ?>" required><br>
                        <p>TÊN HIỂN THỊ</p>
                        <input type="text" name="name" placeholder="Tên hiển thị" value="<?= isset($Infor_User['Name']) && !empty($Infor_User['Name']) ? $Infor_User['Name'] : '' ?>" required><br>
                        <p>MẬT KHẨU CHO TÀI KHOẢN</p>
                        <input type="password" name="password" placeholder="Nhập mật khẩu"><br>
                        <input type="hidden" name="id_user" value="<?= isset($Infor_User['ID']) && !empty($Infor_User['ID']) ? $Infor_User['ID'] : '' ?>">
                        <button type="submit" name="submit">CẬP NHẬT THÔNG TIN</button> <br>
                    </form>
                </div>
                <div class="form-register">
                    <form action="index.php?Page=doi_mat_khau" method="post">
                        <div class="dangnhap">
                            <label for="Log-Reg">
                                <div class="Register">Thay Đổi Thông Tin</div>
                            </label>
                            <div class="Login" style="font-weight: bolder;">Đổi Mật Khẩu</div>
                        </div>
                        <p>MẬT KHẨU CŨ</p>
                        <input type="password" name="old_password" placeholder="Nhập mật khẩu cũ:">
                        <span class="error"><?php echo $errors['old_password'] ?? ''; ?></span><br>

                        <p>MẬT KHẨU MỚI</p>
                        <input type="password" name="new_password" placeholder="Mật Khẩu Mới:">
                        <span class="error"><?php echo $errors['new_password'] ?? ''; ?></span><br>

                        <p>XÁC NHẬN MẬT KHẨU MỚI</p>
                        <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu mới:">
                        <span class="error"><?php echo $errors['confirm_password'] ?? ''; ?></span><br>

                        <button type="submit" name="submitdoimk">XÁC NHẬN</button><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>