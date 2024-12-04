<?php
class Admin_Controller
{
    public $Import_Database;
    public function __construct()
    {
        include_once 'system/core/Database.php';
        $this->Import_Database = new Database();
    }
    public function thong_ke_doanh_thu()
    {
        $All_Order = $this->Import_Database->Get_All_Orders();
        $Total = 0;
        $Count_Order = 0;
        $Order_Suc = 0;
        $xuly = 0;
        foreach ($All_Order as $Order) {
            if ($Order['Status_Order'] == 3) {
                $Total += $Order['Total'];
                $Order_Suc++;
            }
            if ($Order['Status_Order'] == 0) {
                $xuly++;
            }
            $Count_Order++;
        }
        $TitlePage = 'Thống Kê Doanh Thu';
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/thong_ke.php';
    }
    public function quan_ly_san_pham()
    {
        $TitlePage = 'Quản Lý Sản Phẩm';
        $Limit = 5;
        $Page_num = isset($_GET['Page_Num']) ? $_GET['Page_Num'] : 1;
        $All_Products = $this->Import_Database->Get_Product_By_Page($Limit, $Page_num);
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/quan_ly_san_pham.php';
    }

    public function them_san_pham()
    {
        $TitlePage = 'Thêm Sản Phẩm';
        $Category = $this->Import_Database->Get_All_Category();
        include_once 'admin/model/product_model.php';
        $product_Action = new Product_Model();
        $product_Action->Add_Table_Product();
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/them_san_pham.php';
    }

    public function sua_san_pham()
    {
        if (isset($_GET['ID']) && !empty($_GET['ID'])) {
            $TitlePage = 'Sửa Sản Phẩm';
            $product = $this->Import_Database->Get_Product_By_ID($_GET['ID']);
            $Category = $this->Import_Database->Get_All_Category();
            include_once 'admin/model/product_model.php';
            $product_Action = new Product_Model();
            $product_Action->Edit_Product($_GET['ID']);
            include_once 'admin/views/header.php';
            include_once 'admin/views/nav.php';
            include_once 'admin/views/sua_san_pham.php';
        }
    }

    public function an_hien()
    {
        if (isset($_GET['ID']) && !empty($_GET['ID'])) {
            $this->Import_Database->Show_Hide_Products($_GET['ID']);
            header('location: admin.php?Page=quan_ly_san_pham');
        }
    }

    public function xoa_san_pham()
    {
        if (isset($_GET['ID']) && !empty($_GET['ID'])) {
            $this->Import_Database->Delete_Product($_GET['ID']);
            header('location: admin.php?Page=quan_ly_san_pham');
        }
    }

    public function quan_ly_tai_khoan()
    {
        $TitlePage = 'Quản Lý Tài Khoản';
        $Limit = 5;
        $Page_num = isset($_GET['Page_Num']) ? $_GET['Page_Num'] : 1;
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/quan_ly_tai_khoan.php';
    }

    public function an_hien_tai_khoan()
    {
        if (isset($_GET['ID']) && !empty($_GET['ID'])) {
            $this->Import_Database->Show_Hide_User($_GET['ID']);
            header('location: admin.php?Page=quan_ly_tai_khoan');
        }
    }

    public function quan_ly_don_hang()
    {
        $limit = 10;
        $page = isset($_GET['Page_Num']) && !empty($_GET['Page_Num']) ? $_GET['Page_Num'] : 1;
        $TitlePage = 'Quản Lý Đơn Hàng';
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/don_hang.php';
    }

    public function cap_nhat_don_hang()
    {
        $id = isset($_GET['ID']) && !empty($_GET['ID']) ? $_GET['ID'] : $Error = 'Không Có Giá Trị ID';
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $status = $_POST['Status_Order_Update'];
            if ($this->Import_Database->Change_Status_Odder($id, $status)) {
                header('location: admin.php?Page=quan_ly_don_hang');
            } else {
                echo '<script> alert("Cập nhật không thành công!") </script>';
                header('location: admin.php?Page=quan_ly_don_hang');
                exit();
            }
        }
    }

    public function quan_ly_dich_vu()
    {
        $TitlePage = 'Quản Lý Dịch Vụ';
        $limit = 10;
        $page = isset($_GET['Page_Num']) && !empty($_GET['Page_Num']) ? $_GET['Page_Num'] : 1;
        $All_Service = $this->Import_Database->Get_Service_By_Page($page, $limit);
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/quan_ly_dich_vu.php';
    }

    public function them_dich_vu()
    {
        $TitlePage = 'Thêm Dịch Vụ';
        include_once 'admin/model/service_model.php';
        $Model_Service = new Services_Model();
        $Model_Service->Insert_New_Service();
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/them_dich_vu.php';
    }

    public function sua_dich_vu()
    {
        if (isset($_GET['ID']) && !empty($_GET['ID'])) {
            $TitlePage = 'Sửa Dịch Vụ';
            $service = $this->Import_Database->Get_Service_By_ID($_GET['ID']);
            $category_sv = $this->Import_Database->Get_Category_By_Like_Name('Dịch Vụ');
            include_once 'admin/model/service_model.php';
            $model_service = new Services_Model;
            $model_service->Update_Service($_GET['ID']);
            include_once 'admin/views/header.php';
            include_once 'admin/views/nav.php';
            include_once 'admin/views/sua_dich_vu.php';
        }
    }

    public function xoa_dich_vu()
    {
        if (isset($_GET['ID']) && !empty($_GET['ID'])) {
            $this->Import_Database->Delete_Service($_GET['ID']);
            header('location: admin.php?Page=quan_ly_dich_vu');
        }
    }

    public function an_hien_dich_vu()
    {
        if (isset($_GET['ID']) && !empty($_GET['ID'])) {
            $this->Import_Database->Show_Hide_Service($_GET['ID']);
            header('location: admin.php?Page=quan_ly_dich_vu');
        }
    }

    public function quan_ly_danh_muc()
    {
        $TitlePage = 'Quản Lý Danh Mục';
        $limit = 5;
        $page = isset($_GET['Page_Num']) && !empty($_GET['Page_Num']) ? $_GET['Page_Num'] : 1;
        $list_categories = $this->Import_Database->Get_All_Category_By_Page($limit, $page);
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/quan_ly_danh_muc.php';
    }

    public function them_danh_muc()
    {
        include_once 'admin/model/category_model.php';
        $Model_Cat = new Category_Model;
        $Model_Cat->Add_Category();
        $TitlePage = 'Thêm Danh Mục';
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/them_danh_muc.php';
    }

    public function sua_danh_muc()
    {
        include_once 'admin/model/category_model.php';
        $Model_Cat = new Category_Model;
        if (isset($_GET['ID'])) {
            $category = $this->Import_Database->Get_Category_By_ID($_GET['ID']);
        }
        $Model_Cat->Edit_Category($_GET['ID']);
        $TitlePage = 'Sửa Danh Mục';
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/sua_danh_muc.php';
    }

    public function xoa_danh_muc()
    {
        include_once 'admin/model/category_model.php';
        $Model_Cat = new Category_Model;
        $Model_Cat->Delete_Category();
        header('location: admin.php?Page=quan_ly_danh_muc');
    }


    public function quan_ly_danh_muc_bai_viet()
    {
        $TitlePage = 'Quản Lý Danh Mục Bài Viết';
        $list_categories = $this->Import_Database->Get_All_News_Categories();
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/quan_ly_danh_muc_bai_viet.php';
    }

    public function them_danh_muc_bai_viet()
    {
        include_once 'admin/model/news_category_model.php';
        $Model_Cat = new News_Category_Model;
        $Model_Cat->Add_News_Category();
        $TitlePage = 'Thêm Danh Mục Bài Viết';
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/them_danh_muc_bai_viet.php';
    }

    public function sua_danh_muc_bai_viet()
    {
        include_once 'admin/model/news_category_model.php';
        $Model_Cat = new News_Category_Model;
        if (isset($_GET['ID'])) {
            $category = $this->Import_Database->Get_News_Category_By_ID($_GET['ID']);
        }
        $Model_Cat->Edit_News_Category($_GET['ID']);
        $TitlePage = 'Sửa Danh Mục Bài Viết';
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/sua_danh_muc_bai_viet.php';
    }

    public function xoa_danh_muc_bai_viet()
    {
        include_once 'admin/model/news_category_model.php';
        $Model_Cat = new News_Category_Model;
        $Model_Cat->Delete_News_Category();
        header('location: admin.php?Page=quan_ly_danh_muc_bai_viet');
    }
    public function quan_ly_bai_viet()
    {
        $TitlePage = 'Quản Lý Tin Tức';
        $Limit = 5;
        $Page_num = isset($_GET['Page_Num']) ? $_GET['Page_Num'] : 1;
        $offset = ($Page_num - 1) * $Limit;
        $All_News = $this->Import_Database->Get_News_By_Page($Limit, $offset);
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/quan_ly_tin_tuc.php';
    }

    public function them_bai_viet()
    {
        $TitlePage = 'Thêm Bài Viết';
        $Category = $this->Import_Database->Get_All_News_Categories();
        include_once 'admin/model/news_model.php';
        $News_Action = new News_Model();
        $News_Action->Add_Table_News();
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/them_bai_viet.php';
    }


    public function sua_bai_viet()
    {
        if (isset($_GET['ID']) && !empty($_GET['ID'])) {
            $TitlePage = 'Sửa Tin Tức';
            $news = $this->Import_Database->Get_News_By_ID($_GET['ID']);
            $Category = $this->Import_Database->Get_All_News_Categories();
            include_once 'admin/model/news_model.php';
            $news_Action = new News_Model();
            $news_Action->Edit_News($_GET['ID']);
            include_once 'admin/views/header.php';
            include_once 'admin/views/nav.php';
            include_once 'admin/views/sua_bai_viet.php';
        }
    }


    public function an_hien_bai_viet()
    {
        if (isset($_GET['ID']) && !empty($_GET['ID'])) {
            $this->Import_Database->Show_Hide_News($_GET['ID']);
            header('location: admin.php?Page=quan_ly_bai_viet');
        }
    }
    public function xoa_bai_viet()
    {
        if (isset($_GET['ID']) && !empty($_GET['ID'])) {
            $this->Import_Database->Delete_News($_GET['ID']);
            header('location: admin.php?Page=quan_ly_bai_viet');
        }
    }


    public function quan_ly_binh_luan_tin_tuc()
    {
        $TitlePage = 'Quản Lý Bình Luận Tin Tức';
        $comments = $this->Import_Database->Get_All_Comments();
        include_once 'admin/views/header.php';
        include_once 'admin/views/nav.php';
        include_once 'admin/views/quan_ly_binh_luan_tin_tuc.php';
    }

    public function xoa_binh_luan_tin_tuc()
    {
        $comment_id = isset($_GET['ID']) ? $_GET['ID'] : 0;
        if ($this->Import_Database->Delete_Comment($comment_id)) {
            header("location: admin.php?Page=quan_ly_binh_luan_tin_tuc");
        } else {
            echo "Xóa bình luận thất bại";
        }
    }
}
