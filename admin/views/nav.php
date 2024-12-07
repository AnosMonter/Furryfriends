<div class="container">
    <nav>
        <div class="nav-grid">
            <li style="display:flex; justify-content: center; background-color: rgb(240,240,240);"><a href="index.php"><img width="200px" height="200px" src="public/img/logo.png" alt=""></a></li>
            <li id="<?php echo (isset($TitlePage) && $TitlePage == 'Thống Kê Doanh Thu') ? 'Select' : ''; ?>"><a href="admin.php?Page=thong_ke_doanh_thu"> Thống Kê Doanh Thu</a></li>
            <li id="<?php echo (isset($TitlePage) && $TitlePage == 'Quản Lý Tài Khoản') ? 'Select' : ''; ?>"><a href="admin.php?Page=quan_ly_tai_khoan"> Quản Lý Tài Khoản</a></li>
            <li id="<?php echo (isset($TitlePage) && $TitlePage == 'Quản Lý Danh Mục') ? 'Select' : ''; ?>"><a href="admin.php?Page=quan_ly_danh_muc">Quản Lý Danh Mục</a></li>
            <li id="<?php echo (isset($TitlePage) && $TitlePage == 'Quản Lý Sản Phẩm') ? 'Select' : ''; ?>"><a href="admin.php?Page=quan_ly_san_pham">Quản Lý Sản Phẩm</a></li>
            <li id="<?php echo (isset($TitlePage) && $TitlePage == 'Quản Lý Danh Mục Bài Viết')? 'select' :'' ?>"> <a href="admin.php?Page=quan_ly_danh_muc_bai_viet">Quản Lý Danh Mục Bài Viết</a></li>
            <li id="<?php echo (isset($TitlePage) && $TitlePage == 'Quản Lý Bài Viết') ? 'Select' : ''; ?>"><a href="admin.php?Page=quan_ly_bai_viet">Quản Lý Bài Viết</a></li>
            <li id="<?php echo (isset($TitlePage) && $TitlePage == 'Quản Lý Bình Luận Bài Viết') ? 'Select' : ''; ?>"><a href="admin.php?Page=quan_ly_binh_luan_bai_viet">Quản Lý Bình Luận Bài Viết</a></li>
            <li id="<?php echo (isset($TitlePage) && $TitlePage == 'Quản Lý Đơn Hàng') ? 'Select' : ''; ?>"><a href="admin.php?Page=quan_ly_don_hang">Quản Lý Đơn Hàng</a></li>
            <li id="<?php echo (isset($TitlePage) && $TitlePage == 'Quản Lý Dịch Vụ') ? 'Select' : ''; ?>"><a href="admin.php?Page=quan_ly_dich_vu">Quản Lý Dịch Vụ</a></li>
        </div>
    </nav>