<?php
class Product_Model
{
    public $DB;
    public function __construct()
    {
        $this->DB = new Database();
    }

    public function Add_Table_Product()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $discount = $_POST['discount'];
            $description = $_POST['description'];
            $detail = $_POST['detail'];
            $quantity = $_POST['quantity'];
            $status = $_POST['status'];
            $category_id = $_POST['category_id'];

            if (empty($name)) {
                $nameError = "Không Được Bỏ Trống Tên Sản Phẩm";
            }
            if (empty($price)) {
                $priceError = "Không Được Bỏ Trống Giá Sản Phẩm";
            }
            if (empty($discount)) {
                $discountError = "Không Được Bỏ Trống Giảm Giá";
            }
            if (empty($description)) {
                $descriptionError = "Không Được Bỏ Trống Mô Tả Sản Phẩm";
            }
            if (empty($detail)) {
                $detailError = "Không Được Bỏ Trống Thông Tin Chi Tiết Sản Phẩm";
            }
            if (empty($quantity)) {
                $quantityError = "Không Được Bỏ Trống Số Lượng Trong Kho";
            }
            if (empty($status)) {
                $statusError = "Không Được Bỏ Trống Trạng Thái Sản Phẩm";
            }
            if (empty($category_id)) {
                $category_idError = "Không Được Bỏ Trống Danh Mục Sản Phẩm";
            }

            $File_Dir = 'public/img/Products/';
            $New_Name_Image = 'Products' . $name . strrchr($_FILES['image']['name'], '.');
            if (file_exists($File_Dir . basename($New_Name_Image))) {
                $ImageError = "Ảnh đã tồn tại";
            }
            if (move_uploaded_file($_FILES['image']['tmp_name'], $File_Dir . $New_Name_Image) == false) {
                $ImageError = "Tải ảnh thất bại";
            }

            if ($this->DB->Add_Product($name, $price, $discount, $New_Name_Image, $description, $detail, $quantity, $status, $category_id)) {
                header('Location: admin.php?Page=quan_ly_san_pham');
            };
        }
    }

    public function Edit_Product($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $discount = $_POST['discount'];
            $description = $_POST['description'];
            $detail = $_POST['detail'];
            $quantity = $_POST['quantity'];
            $status = $_POST['status'];
            $category_id = $_POST['category_id'];

            if (empty($name)) {
                $nameError = "Không Được Bỏ Trống Tên Sản Phẩm";
            } 
            if (empty($price)) {
                $priceError = "Không Được Bỏ Trống Giá Sản Phẩm";
            }
            if (empty($discount)) {
                $discountError = "Không Được Bỏ Trống Giảm Giá";
            }
            if (empty($quantity)) {
                $quantityError = "Không Được Bỏ Trống Số Lượng Trong Kho";
            }
            if (empty($status)) {
                $statusError = "Không Được Bỏ Trống Trạng Thái Sản Phẩm";
            }
            if (empty($category_id)) {
                $category_idError = "Không Được Bỏ Trống Danh Mục Sản Phẩm";
            }

            $old_image = $this->DB->Get_Product_By_ID($id)['Image'];
            $File_Dir = 'public/img/Products/';
            $New_Name_Image = $old_image; 
            if (!empty($_FILES['image']['name'])) {
                if (file_exists($File_Dir . $old_image)) {
                    unlink($File_Dir . $old_image);
                }
                $New_Name_Image = 'Products' . $name . strrchr($_FILES['image']['name'], '.');
                if (move_uploaded_file($_FILES['image']['tmp_name'], $File_Dir . $New_Name_Image) == false) {
                    $ImageError = "Tải ảnh thất bại";
                }
            }
            if ($this->DB->Update_Product($id, $name, $price, $discount, $New_Name_Image, $description, $detail, $quantity, $status, $category_id)) {
                header('Location: admin.php?Page=quan_ly_san_pham');
            } else {
                echo "<script>alert('Cập nhật sản phẩm thất bại')</script>";
            }
        }
    }

    public function Delete_Product($id)
    {
        $this->DB->Delete_Product($id);
    }
}
