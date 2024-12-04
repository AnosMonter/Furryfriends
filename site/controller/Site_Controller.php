<?php
class Site_Controller
{
    public $Database;
    public function __construct()
    {
        $this->Database = new Database();
    }
    public function trang_chu()
    {
        $banner_cho = $this->Database->getBannerById(3);
        $banner_cho_2 = $this->Database->getBannerById(2);
        $banner_meo = $this->Database->getBannerById(4);
        $banner_meo_2 = $this->Database->getBannerById(1);
        $moi_arr = $this->Database->sp_moi(8);
        $km_arr = $this->Database->sp_km(8);
        $sp_cho_arr = $this->Database->sp_cho(8);
        $sp_meo_arr = $this->Database->sp_meo(8);
        $dm_arr = $this->Database->danh_muc(6);
        $TitlePage = 'Trang chủ';
        $Views = 'site/views/main.php';
        include_once 'site/views/layout.php';
    }

    public function gioi_thieu()
    {
        $TitlePage = 'Giới Thiệu';
        $Views = 'site/views/gioi_thieu.php';
        include_once 'site/views/layout.php';
    }

    public function lien_he()
    {
        $TitlePage = 'Liên Hệ';
        include_once 'site/model/contact_Model.php';
        $Contact = new Contact();
        $Contact->Contact_Admin();
        $Views = 'site/views/lien_he.php';
        include_once 'site/views/layout.php';
    }

    public function quen_mat_khau()
    {
        $TitlePage = 'Quên Mật Khẩu';
        include_once 'site/model/quen_mat_khau_model.php';
        $Forgot_Pass = new Quen_Mat_Khau();
        $Forgot_Pass->sentCode();
        $Views = 'site/views/quen_mat_khau.php';
        include_once 'site/views/layout.php';
    }

    public function nhap_mat_khau_moi()
    {
        $TitlePage = 'Nhập Mật Khẩu Mới';
        include_once 'site/model/quen_mat_khau_model.php';
        $Forgot_Pass = new Quen_Mat_Khau();
        $Forgot_Pass->Nhap_mat_khau_moi();
        $Views = 'site/views/nhap_mat_khau_moi.php';
        include_once 'site/views/layout.php';
    }

    public function dang_nhap()
    {
        $TitlePage = 'Đăng Nhập';
        include_once 'site/model/dangnhap_dangky.php';
        $Log = new Dang_Nhap_Dang_Ky();

        $loi1 = [];

        if (isset($_POST['dangnhap'])) {
            $loi1 = $Log->DangNhap();
        }

        $Views = 'site/views/login_register.php';
        include_once 'site/views/layout.php';
    }


    public function dang_ky()
    {
        $TitlePage = 'Đăng Ký';
        include_once 'site/model/dangnhap_dangky.php';
        $Register = new Dang_Nhap_Dang_Ky();

        $loi = $Register->Validate_DK($_POST);

        if (empty($loi)) {
            $Register->DangKy();
        }

        $Views = 'site/views/login_register.php';
        include_once 'site/views/layout.php';
    }


    public function dangky_step2()
    {
        include_once 'site/model/dangnhap_dangky.php';
        $model = new Dang_Nhap_Dang_Ky;
        $model->dangKyStep2();
        include_once 'site/views/header.php';
        include_once 'site/views/nav.php';
        include_once 'site/views/dangky_step2.php';
        include_once 'site/views/footer.php';
    }

    public function chinh_sua_thong_tin()
    {
        $TitlePage = 'Chỉnh Sửa Thông Tin';
        $Infor_User = $this->Database->Get_Infor_User($_SESSION['User_login']['ID']);
        $errors = [];

        if (isset($_POST['submit'])) {
            $id = $_POST['id_user'];
            $username = $_POST['username'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            include_once 'site/model/dangnhap_dangky.php';
            $update = new Dang_Nhap_Dang_Ky();

            $errors = $update->cap_nhat_thong_tin($id, $name, $username, $phone, $email);

            if (empty($errors) && isset($Infor_User['Password']) && password_verify($password, $Infor_User['Password'])) {
                $result = $update->cap_nhat_thong_tin($id, $name, $username, $phone, $email);
                if ($result) {
                    unset($_SESSION['User_login']);
                    $User = $this->Database->Get_Infor_User($Infor_User['ID']);
                    $_SESSION['User_login'] = ['ID' => $User['ID'], 'Name' => $User['Name'], 'Email' => $User['Email'], 'Role' => $User['Role']];
                    echo "<script>alert('Cập nhật thông tin thành công!');</script>";
                } else {
                    echo "<script>alert('Cập nhật thông tin thất bại!');</script>";
                }
            } else {
                echo "<script>alert('Mật khẩu không đúng!');</script>";
            }
        }

        $Views = 'site/views/thaydoithongtin.php';
        include_once 'site/views/layout.php';
    }

    public function doi_mat_khau()
    {
        $TitlePage = 'Đổi Mật Khẩu';
        $Infor_User = $this->Database->Get_Infor_User($_SESSION['User_login']['ID']);
        $errors = [];

        if (isset($_POST['submitdoimk'])) {
            include_once 'site/model/dangnhap_dangky.php';
            $validate = new Dang_Nhap_Dang_Ky();
            $errors = $validate->Validate_TDMK($_POST);

            if (empty($errors)) {
                $old_password = $_POST['old_password'];
                $new_password = $_POST['new_password'];

                if (password_verify($old_password, $Infor_User['Password'])) {
                    $result = $validate->cap_nhat_mat_khau($_SESSION['User_login']['ID'], password_hash($new_password, PASSWORD_DEFAULT));

                    if ($result) {
                        echo "<script>alert('Đổi mật khẩu thành công!');</script>";
                    } else {
                        echo "<script>alert('Đổi mật khẩu thất bại!');</script>";
                    }
                } else {
                    $errors['old_password'] = "Mật khẩu cũ không đúng!";
                }
            }
        }

        $Views = 'site/views/thaydoithongtin.php';
        include_once 'site/views/layout.php';
    }

    public function bai_viet()
    {
        $limit = 9;
        $page = isset($_GET['page_num']) ? $_GET['page_num'] : 1;
        $so_trang = ceil(count($this->Database->Get_All_News()) / $limit);
        $offset = ($page - 1) * $limit;
        $random_articles = $this->Database->Bai_Viet_Ngau_Nhien(3);
        $data_arr = $this->Database->Get_News_By_Page($limit, $offset);
        $titlePage = "Bài viết";
        $Views = 'site/views/bai_viet.php';
        include_once 'site/views/layout.php';
    }
    function bv()
    {
        if (isset($_GET['ID']) == false) die("Thiếu id bài viết rồi");
        $ID = $_GET['ID'];
        $this->Database = new Database;
        $row = $this->Database->Get_News_By_ID($ID);
        $this->Database->Up_View_News($ID);
        $random_articles = $this->Database->Bai_Viet_Ngau_Nhien(3);
        if ($row == null) die("Không tồn tại bài viết $ID ");
        $comments = $this->Database->Lay_Binh_Luan($ID);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Comment = $_POST['Comment'] ? $_POST['Comment'] : null;
            if (!empty($Comment)) {
                $this->Database->Them_Binh_Luan($_SESSION['User_login']['ID'], $ID, $Comment);
                header("Location: index.php?Page=bv&ID=$ID");
                exit();
            }
        }
        $titlePage = $row['Name'];
        $Views = 'site/views/chi_tiet_bai_viet.php';
        include_once 'site/views/layout.php';
    }

    public function dang_xuat()
    {
        unset($_SESSION['User_login']);
        header('location: index.php');
    }

    public function kiemtra()
    {
        echo "<h2>Thông tin Session</h2>";
        print_r($_SESSION);
        echo "<h2>Thông tin Cookie</h2>";
        print_r($_COOKIE);

        echo date('Y-m-d', strtotime('now'));
    }

    public function san_pham_dm()
    {
        if (isset($_GET['id']) == false) die("Thiếu id danh mục");
        $id = $_GET['id'];
        $page_size = 8;
        $page_num = 1;
        if(isset($_GET['page_num']) == true) $page_num = $_GET['page_num'];
        $dm_sp_arr = $this->Database->sp_dm($id, $page_size, $page_num);
        $so_record = $this->Database->dm_dem($id);
        $so_trang = ceil($so_record/$page_size);
        $TitlePage = 'Sản phẩm theo danh mục';
        $Views = 'site/views/sp_danh_muc.php';
        include_once 'site/views/layout.php';
    }
    public function chi_tiet()
    {
        if (isset($_GET['id']) == false) die("Thiếu id sản phẩm");
        $id = $_GET['id'];
        $this->Database->Up_View_Product($id);
        $row = $this->Database->Chi_Tiet($id);
        $lienquan_arr = $this->Database->sp_lien_quan($id, 4);
        $binhluan_arr = $this->Database->binhluan_sp($id);
        if ($row == null) die("Không tồn tại sản phẩm $id");
        $TitlePage = 'Chi tiết Sản Phẩm';
        $Views = 'site/views/chi_tiet.php';
        include_once 'site/views/layout.php';
    }
    public function tim_kiem()
    {
        if (isset($_GET['Search']) && !empty($_GET['Search'])) {
            $keyword = $_GET['Search'];
            $page_size = 8;
            $page_num = 1;
            if(isset($_GET['page_num'])==true) $page_num = $_GET['page_num'];
            $min_price = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
            $max_price = isset($_GET['max_price']) ? (float)$_GET['max_price'] : PHP_INT_MAX;
            $sort_price = isset($_GET['sort_price']) ? $_GET['sort_price'] : 'ASC';
    
            $results = $this->Database->tim_kiem_sp($keyword, $min_price, $max_price, $page_size, $page_num, $sort_price);
            $so_record = $this->Database->tim_kiem_dem($keyword, $min_price, $max_price);
            $so_trang = ceil($so_record / $page_size);
            $TitlePage = "Kết quả cho '$keyword'";
            $Views = 'site/views/timkiem.php';
            include_once 'site/views/layout.php';
        } else {
            echo "Vui lòng nhập từ khóa tìm kiếm!";
        }
    }

    public function xem_don_hang()
    {
        include_once 'site/model/xem_don_hang.php';
        $model = new XemDonHang();
        $donHang = $model->layDonHangTheoIDUser($_SESSION['User_login']['ID']);
        $Views = 'site/views/lich_su_hang.php';
        include_once 'site/views/layout.php';
    }

    public function huy_don_hang(){
        if ($_GET['ID'] != null || $_GET['Status'] != null) {
            $id = $_GET['ID'];
            $status = $_GET['Status'];
        } else {
            die("Thiếu Id hoặc trạng thái");
            exit();
        }
        if ($this->Database->Change_Status_Odder($id,$status)){
            header('location: index.php?Page=xem_don_hang');
            exit();
        } else {
            echo '<script> alert("Hủy Đơn Hàng Thất Bại")';
            header('refresh:2s, url=index.php?Page=xem_don_hang');
        }

    }

    public function xem_so_luong()
    {
        if ($_GET['ID'] != null) {
            $id = $_GET['ID'];
        } else {
            die("Thiếu Id ");
            exit();
        }

        $CTDH = $this->Database->xem_chi_tietdh($id);
        $Check_Status = $this->Database->Check_Status_Order($id);
        $Get_Order = $this->Database->Get_Order_Detail_By_ID($id);
        $total_price = 0;
        if ($CTDH) {
            foreach ($CTDH as $item) {
                $total_price += $item['Price'] * $item['Quantity'];
            }
        }
        $Views = 'site/views/xem_so_luong.php';
        include_once 'site/views/layout.php';
    }
    public function danh_gia()
    {
        include_once 'site/model/xem_don_hang.php';
        $Model = new XemDonHang();
        $Model->Danh_Gia_San_Pham();
        $Views = 'site/views/danh_gia.php';
        include_once 'site/views/layout.php';
    }



    function gio_hang()
    {
        if (!isset($_SESSION['myCart'])) {
            $_SESSION['myCart'] = [
                'listCart' => [],
                'inforOrder' => []
            ];
        }
        unset($_SESSION['myCart']['infoOrder']);
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['ID'] != null){
            $ID = $_POST['ID'];
            $Name = $_POST['Name'];
            $Image = $_POST['Image'];
            $Price = $_POST['Price'];
            $Discount = $_POST['Discount'];
            $Quantity = $_POST['Quantity'];
            (int) $ttien = $Quantity * $Discount;
            $found = false;
            foreach ($_SESSION['myCart']['listCart'] as $item) {
                if ($item[0] === $ID) {
                    $item[4] += $Quantity;
                    $item[5] = $item[4] * (int)$Discount;
                    $found = true;
                }
            }

            if ($found) {
                $item[4] += $Quantity;
                $item[5] = $item[4] * $Discount;
                echo "<script type='text/javascript'>alert('Sản phẩm này đã có trong giỏ hàng.');</script>";
            } else {
                $addToCart = [$ID, $Name, $Image, $Price, $Quantity, $ttien, (int) $Discount];
                $_SESSION['myCart']['listCart'][] = $addToCart;
                echo "<script type='text/javascript'>alert('Sản phẩm đã được thêm vào giỏ hàng.');</script>";
            }
        }
        if (isset($_POST['update_quantity']) && $_POST['update_quantity']) {
            $idcart = $_POST['idcart'];
            $newQuantity = $_POST['newQuantity'];

            if ($newQuantity > 0) {
                $_SESSION['myCart']['listCart'][$idcart][4] = $newQuantity;
                $_SESSION['myCart']['listCart'][$idcart][5] = $newQuantity * $_SESSION['myCart']['listCart'][$idcart][6];
            } else {
                unset($_SESSION['myCart']['listCart'][$idcart]);
                $_SESSION['myCart']['listCart'] = array_values($_SESSION['myCart']['listCart']);
            }
        }
        if (isset($_GET['Page']) && $_GET['Page'] == 'delcart' && isset($_GET['idcart'])) {
            $idcart = $_GET['idcart'];
            unset($_SESSION['myCart']['listCart'][$idcart]);
            $_SESSION['myCart']['listCart'] = array_values($_SESSION['myCart']['listCart']);
        }
        $totalPrice = 0;
        foreach ($_SESSION['myCart']['listCart'] as $item) {
            $totalPrice += $item[5];
        }
        $_SESSION['totalPrice'] = $totalPrice;
        $Views = 'site/views/gio_hang.php';
        include_once 'site/views/layout.php';
    }


    function delcart()
    {
        if (isset($_GET['idcart']) && ($_GET['idcart'] >= 0)) {
            array_splice($_SESSION['myCart']['listCart'], $_GET['idcart'], 1);
            header('location:index.php?Page=gio_hang');
        }
    }
    public function kiem_tra_thanh_toan()
    {
        if (!isset($_SESSION['User_login'])) {
        }
        if (!isset($_SESSION['User_login'])) {
            echo "<script type='text/javascript'>alert('Bạn cần phải đăng nhập trước');</script>";
            header('location:index.php?Page=dang_nhap');
            $name = "";
            $email = "";
        } else {

            $name = $_SESSION['User_login']['Name'];
            $email = $_SESSION['User_login']['Email'];
        }
        $Views = 'site/views/bill.php';
        include_once 'site/views/layout.php';
    }
    public function bill_confirm()
    {
        if (isset($_POST['dongydathang']) && $_POST['dongydathang']) {

            $username = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $ngaydathang = date('h:i:sa d/m/Y');
            $pttt = $_POST['pttt'];
            $tongdonhang = $_POST['tong'];
            $email = $_POST['email'];
            $ghi_chu = $_POST['ghi_chu_don_hang'];

            if (!isset($_SESSION['myCart']['infoOrder']) || empty($_SESSION['myCart']['infoOrder'])) {
                $addToOrder = [$username, $address, $phone, $ngaydathang, $pttt, $tongdonhang, $email, $ghi_chu];
                $_SESSION['myCart']['infoOrder'][] = $addToOrder;
            } else {
                echo "<script type='text/javascript'>alert('Thông tin đơn hàng đã được thêm trước đó!');</script>";
            }
        }
        $Views = 'site/views/bill_confirm.php';
        include_once 'site/views/layout.php';
    }
    function xoa_thong_tin_don_hang()
    {
        unset($_SESSION['myCart']['infoOrder']);
        header('location:index.php?Page=kiem_tra_thanh_toan');
    }
    function xac_nhan_dat_hang()
    {
        if (isset($_POST['xacnhandathang']) && $_POST['xacnhandathang']) {
            require_once 'site/model/cart.php';
            $this->Database = new Database;
            if (function_exists('insertOrder')) {
                insertOrder($this->Database);
                header('location:index.php?Page=dat_hang_thanh_cong');
            } else {
                echo "Hàm insertOrder chưa được định nghĩa!";
            }
            $Views = 'site/views/xac_nhan_dat_hang.php';
            include_once 'site/views/layout.php';
        }
    }
    public function dat_hang_thanh_cong()
    {
        $Views = 'site/views/dat_hang_thanh_cong.php';
        include_once 'site/views/layout.php';
    }

    public function dich_vu()
    {
        if (isset($_GET['ID']) && !empty($_GET['ID'])) {
            $id = $_GET['ID'];
        } else {
            die("Thiếu ID ");
        }
        $Service = $this->Database->Get_Service_By_ID_Category($id);
        $titlePage = $this->Database->Get_Category_By_ID($id)['Name'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Service_Detail = $_POST['Service'];
            $Detail_Service = $this->Database->Get_Service_By_ID($Service_Detail);
        } else {
            $Service_Detail = $Service[0]['ID'];
            $Detail_Service = $this->Database->Get_Service_By_ID($Service_Detail);
        }
        $Views = 'site/views/dich_vu_theo_loai.php';
        include_once 'site/views/layout.php';
    }
}
