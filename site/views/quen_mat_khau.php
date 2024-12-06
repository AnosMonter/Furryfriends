<main>
    <div class="Center_Object">
        <div class="box-page-forgot-password">
            <h2>Quên Mật Khẩu</h2>
            <img src="public/img/logo.png" alt="">
            <div class="Forgot-Pass-Log">
                <span>Có tài khoản? <a href="index.php?Page=dang_nhap">Đăng Nhập</a></span>
                <span>Chưa có tài khoản? <a href="index.php?Page=dang_nhap&D=1">Đăng Ký</a></span>
            </div>
            <form action="index.php?Page=quen_mat_khau" method="post">
                <label>Vui Lòng Điền Email Đã Đăng Ký Với Chúng Tôi:</label>
                <input type="text" name="email" placeholder="Điền Email Đã Đăng Ký" required>
                <span class="error"><?= isset($_GET['Error']) && !empty($_GET['Error'])? $_GET['Error'] :'';?></span>
                <input type="submit" name="Sent_Code" value="Gửi Mã">
            </form>
        </div>
    </div>
</main>