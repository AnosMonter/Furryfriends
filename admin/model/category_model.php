<?php
class Category_Model
{
    public $DB;
    public function __construct()
    {
        $this->DB = new Database();
    }

    public function Add_Category()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $image_name = $_FILES['image']['name'];
            $All_Cat = $this->DB->Get_All_Category();
            foreach ($All_Cat as $Cat) {
                if ($Cat['name'] == $name) {
                    $errorName = "Tên thể loại đã tồn tại";
                    break;
                }
            }
            if (empty($errorName)) {
                $image_tmp_name = $_FILES['image']['tmp_name'];
                $image_dir = 'public/img/Categories/';
                $New_Name_Image = $image_dir . $name . strrchr($_FILES['image']['name'], '.');
                if (move_uploaded_file($image_tmp_name, $New_Name_Image)) {
                    $errorImage = "Tải Ảnh Thất Bại";
                };

                if ($this->DB->Add_Category($name, $New_Name_Image, 1)) {
                    header("location: admin.php?Page=quan_ly_danh_muc");
                } else {
                    echo "Thêm mới thể loại thất bại";
                }
            }
        }
    }

    public function Edit_Category($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $status = $_POST['status'];
            $image_name = $_FILES['image']['name'];
            $All_Cat = $this->DB->Get_All_Category();
            foreach ($All_Cat as $Cat) {
                if ($Cat['Name'] == $name && $Cat['ID'] != $id) {
                    $errorName = "Tên thể loại đã tồn tại";
                    break;
                }
            }
            if (empty($errorName)) {
                $image_tmp_name = $_FILES['image']['tmp_name'];
                $image_dir = 'public/img/Categories/';
                $New_Name_Image = $image_dir . $name . strrchr($_FILES['image']['name'], '.');
                if (file_exists($New_Name_Image) && $image_name != '') {
                    unlink($image_dir . $this->DB->Get_Category_By_ID($id)['image']);
                }
                if (move_uploaded_file($image_tmp_name, $New_Name_Image)) {
                    $errorImage = "Tải Ảnh Thất Bại";
                };

                if ($this->DB->Edit_Category($id, $name, $New_Name_Image, $status)) {
                    $Noti = 'Cập Nhật Thành Công';
                    header('Location: admin.php?Page=quan_ly_danh_muc&Noti=' . $Noti);
                } else {
                    echo "Sửa thể loại thất bại";
                }
            }
        }
    }

    public function Delete_Category()
    {
        if (isset($_GET['ID'])) {
            $id = $_GET['ID'];
            $category = $this->DB->Get_Category_By_ID($id);
            if (count($this->DB->Get_Product_By_Category($id)) >= 1) {
                $Noti = 'Có Sản Phẩm Trong Danh Mục';
                header('Location: admin.php?Page=quan_ly_danh_muc&Noti=' . $Noti);
            }
            if (file_exists('public/img/Categories/' . $category['Image']) && $category['Image'] != '') {
                unlink('public/img/Categories/' . $category['Image']);
            }
            if ($this->DB->Delete_Category($id)) {
                $Noti = 'Xóa Danh Mục Thành Công';
                header('Location: admin.php?Page=quan_ly_danh_muc&Noti=' . $Noti);
            } else {
                echo "<script>alert('Xóa Sản Phẩm Thất Bại')</script>";
            }
        } else {
            die('Không tồn tại mã danh mục này');
        }
    }
}
