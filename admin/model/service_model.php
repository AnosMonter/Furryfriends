<?php
class Services_Model
{
    public $DB;
    public function __construct()
    {
        $this->DB = new Database();
    }

    public function Insert_New_Service()
    {
        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $time = $_POST['time'];
            $category_ID = $_POST['category_id'];
            $status = 1;
            if (empty($name)) {
                $error = " Tên dịch vụ không được để trống ";
            } else if (empty($description)) {
                $error = " Mô tả dịch vụ không được để trống ";
            } else if (empty($price)) {
                $error = " Giá dịch vụ không được để trống ";
            } else if (empty($time)) {
                $error = " Thi gian dịch vụ không được để trống ";
            } else if (empty($category_ID)) {
                $error = " Danh mục dịch vụ không được để trống";
            } else {
                $Dir_Service = 'public/img/Service/';
                $New_Name_IMG_Service = $Dir_Service . $name . strrchr($_FILES['image']['name'], '.');
                if (file_exists($New_Name_IMG_Service)) {
                    $error = "Ảnh đã tồn tại";
                }
                if (move_uploaded_file($_FILES['image']['tmp_name'], $New_Name_IMG_Service)) {
                    $this->DB->Insert_Service($name, $New_Name_IMG_Service, $price, $description, $time, $category_ID, $status);
                }
                header("Location: admin.php?Page=quan_ly_dich_vu");
            }
        }
    }

    public function Update_Service($id)
    {
        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
            $name = isset($_POST['name'])? $_POST['name']:'Rỗng';
            $description = $_POST['description'];
            $price = $_POST['price'];
            $time = $_POST['time'];
            $category_ID = $_POST['category_id'];
            $status = $_POST['status'];
            if (empty($name)) {
                $error = " Tên dịch vụ không được để trống ";
            } else if (empty($description)) {
                $error = " Mô tả dịch vụ không được để trống ";
            } else if (empty($price)) {
                $error = " Giá dịch vụ không được để trống ";
            } else if (empty($time)) {
                $error = " Thời gian dịch vụ không được để trống ";
            } else if (empty($category_ID)) {
                $error = " Danh mục dịch vụ không được để trống";
            } else {
                if (!empty($_FILES['image']['name'])) {
                    $old_image = $this->DB->Get_Service_By_ID($id)['Image'];
                    unlink($old_image);
                    $Dir_Service = 'public/img/Service/';
                    $New_Name_IMG_Service = $Dir_Service . $name . strrchr($_FILES['image']['name'], '.');
                    move_uploaded_file($_FILES['image']['tmp_name'], $New_Name_IMG_Service);
                } else {
                    $New_Name_IMG_Service = $this->DB->Get_Service_By_ID($id)['Image'];
                }
                $this->DB->Update_Service($id, $name, $New_Name_IMG_Service, $price, $description, $time, $category_ID, $status);
                header("Location: admin.php?Page=quan_ly_dich_vu");
            }
        }
    }
}
