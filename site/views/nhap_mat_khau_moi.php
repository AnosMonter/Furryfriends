<div class="Container">
    <form id="reset-password-form" action="index.php?Page=nhap_mat_khau_moi" method="post">
    <h2>Đặt lại mật khẩu</h2>
    <label for="new-password">Mật khẩu mới:</label>
        <input type="password" id="new-password" name="new_password" required>

        <label for="confirm-password">Xác nhận mật khẩu:</label>
        <input type="password" id="confirm-password" name="confirm_password" required>

        <label for="verification-code">Mã xác minh:</label>
        <input type="text" id="verification-code" name="verification-code" required>
        <input type="submit" name="RS_Pass" value="Đặt Lại Mật Khẩu">
    </form>
</div>