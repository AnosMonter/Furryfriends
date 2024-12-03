<?php
class News_Category_Model
{
    public $DB;

    public function __construct()
    {
        $this->DB = new Database();
    }

    public function Add_News_Category()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $All_Cat = $this->DB->Get_All_News_Categories();
            foreach ($All_Cat as $Cat) {
                if ($Cat['Name'] == $name) {
                    $errorName = "Tên danh mục đã tồn tại";
                    break;
                }
            }
            if (empty($errorName)) {
                if ($this->DB->Add_News_Category($name, 1)) {
                    header("location: admin.php?Page=quan_ly_danh_muc_bai_viet");
                } else {
                    echo "Thêm mới danh mục thất bại";
                }
            }
        }
    }

    public function Edit_News_Category($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $status = $_POST['status'];
            $All_Cat = $this->DB->Get_All_News_Categories();
            foreach ($All_Cat as $Cat) {
                if ($Cat['Name'] == $name && $Cat['ID'] != $id) {
                    $errorName = "Tên danh mục đã tồn tại";
                    break;
                }
            }
            if (empty($errorName)) {
                if ($this->DB->Edit_News_Category($id, $name, $status)) {
                    header('Location: admin.php?Page=quan_ly_danh_muc_bai_viet');
                } else {
                    echo "Sửa danh mục thất bại";
                }
            }
        }
    }

    public function Delete_News_Category()
    {
        if (isset($_GET['ID'])) {
            $id = $_GET['ID'];
            if ($this->DB->Delete_News_Category($id)) {
                header('Location: admin.php?Page=quan_ly_danh_muc_bai_viet');
            } else {
                echo "Xóa danh mục thất bại";
            }
        }
    }
}
