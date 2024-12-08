<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="public/img/logo.png" type="image/x-icon">
    <title><?php echo !empty($TitlePage) ? $TitlePage : 'Furry Friends' ?></title>
    <link rel="stylesheet" href="public/css/all.css">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/js/javascript.js"></script>
</head>

<body>
    <header>
        <div class="header-container">
            <a href="index.php?Page=trang_chu"><img src="public/img/logo.png" width="100px" height="100px" alt="Logo Furry Friend" id="Logo"></a>
            <form action="index.php" id="Search" method="GET">
                <input type="hidden" name="Page" value="tim_kiem">
                <input type="text" name="Search" placeholder="Tìm kiếm sản phẩm..." autocomplete="off" value="<?php echo isset($_GET['Search']) ? htmlspecialchars($_GET['Search']) : ''; ?>">
                <button type="submit"><i class="fa-solid fa-magnifying-glass fa-xl"></i></button>
            </form>
            <div id="Right_Header">
                <a href="#" id="Phone">
                    <i class="fa-solid fa-square-phone brand-color fa-4x"></i>
                    <span class="brand-color">090 5151 999</span>
                </a>
                <a href="<?= isset($_SESSION['User_login']) && !empty($_SESSION['User_login']) ? 'index.php?Page=chinh_sua_thong_tin' : 'index.php?Page=dang_nhap'; ?>"
                    id="User" <?= isset($_SESSION['User_login']) ? 'onmouseover="ShowDropdown()"' : '' ?>>
                    <i class="fa-solid fa-user brand-color fa-4x"></i>
                    <span class="brand-color"><?php echo isset($_SESSION['User_login']['Name']) ? $_SESSION['User_login']['Name'] : 'Đăng Nhập'; ?></span>
                    <ul style="z-index: 99;" class="dropdown" onmouseleave="HideDropdown()">
                        <li><a href="index.php?Page=dang_xuat">Đăng Xuất</a></li>
                        <li><a href="index.php?Page=chinh_sua_thong_tin">Thay Đổi Thông Tin</a></li>
                        <li><a href="index.php?Page=xem_don_hang">Xem Đơn Hàng</a></li>
                        <?= isset($_SESSION["User_login"]["ID"]) && $_SESSION["User_login"]["Role"] == 1 ? '<li><a href="admin.php">Đi Đến Trang Quản Trị</a></li>' : '' ?>
                    </ul>
                </a>
                <a href="index.php?Page=gio_hang" id="Cart">
                    <i class="fa-brands fa-opencart brand-color fa-4x"></i>
                    <span class="brand-color">Giỏ hàng</span>
                </a>
            </div>
        </div>
    </header>