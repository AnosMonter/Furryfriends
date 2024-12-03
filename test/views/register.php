<form action="index.php?action=register" method="POST" enctype="multipart/form-data">
    <input type="text" name="username" placeholder="Tên đăng nhập" required>
    <input type="password" name="password" placeholder="Mật khẩu" required>
    <input type="text" name="name" placeholder="Họ và tên" required>
    <input type="text" name="phone" placeholder="Số điện thoại" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="file" name="image" accept="image/*">
    <button type="submit">Đăng ký</button>
</form>
