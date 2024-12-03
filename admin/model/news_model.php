<?php
class News_Model
{
    private $DB;

    public function __construct()
    {
        $this->DB = new Database();
    }
    public function Add_Table_News()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $content = $_POST['content'];
        $create_date = $_POST['create_date'];
        $status = $_POST['status'];
        $category_id = $_POST['category_id'];
        $image = $_FILES['image'];

        // Kiểm tra lỗi nhập liệu
        if (empty($name)) {
            $nameError = "Không Được Bỏ Trống Tên Tin Tức";
        }
        if (empty($content)) {
            $contentError = "Không Được Bỏ Trống nội dung";
        }
        if (empty($create_date)) {
            $create_dateError = "Không Được Bỏ Trống Ngày";
        }
        if (empty($status)) {
            $statusError = "Không Được Bỏ Trống Trạng Thái";
        }
        if (empty($category_id)) {
            $categoryError = "Không Được Bỏ Trống Danh Mục";
        }

        $image_dir = 'public/img/News/';
        $new_image_name = 'News_' . uniqid() . strrchr($image['name'], '.');
        if (!move_uploaded_file($image['tmp_name'], $image_dir . $new_image_name)) {
            $imageError = "Tải ảnh thất bại";
        }

        if (empty($nameError) && empty($imageError)) {
            $result = $this->DB->Add_News($name, $new_image_name, $content, $create_date, $category_id, $status);
            if ($result) {
                header('Location: admin.php?Page=quan_ly_bai_viet');
                exit();
            } else {
                return ['error' => 'Thêm bài viết thất bại.'];
            }
        }
    }
}



   
    public function Edit_News($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $image = $_FILES['image'];
            $image_url = isset($_POST['image_url']) ? trim($_POST['image_url']) : null;
            $create_date = $_POST['create_date'];
            $content = $_POST['content'];

            $status = $_POST['status'];
            $category_id = $_POST['category_id'];

            if (empty($name)) {
                $nameError = "Không Được Bỏ Trống Tên Tin Tức";
            } 
            if (empty($image)) {
                $imageError = "Không Được Bỏ Trống Hình Ảnh Tin Tức";
            }
            if (empty($create_date)) {
                $create_dateError = "Không Được Bỏ Trống Ngày";
            }
             if (empty($content)) {
                $contentError = "Không Được Bỏ Trống Nội Dung Tin Tức";
            }

            if (empty($status)) {
                $statusError = "Không Được Bỏ Trống Trạng Thái Tin Tức";
            }
            if (empty($category_id)) {
                $category_idError = "Không Được Bỏ Trống Danh Mục Tin Tức";
            }
            if (!empty($create_date) && !DateTime::createFromFormat('Y-m-d\TH:i', $create_date)) {
                $create_dateError = "Ngày không đúng định dạng.";
            }
    
            // Chuyển đổi ngày thành định dạng phù hợp cho database
            $create_date = date('Y-m-d H:i:s', strtotime($create_date));

            $old_image = $this->DB->Get_News_By_ID($id)['Image'];
            $File_Dir = 'public/img/News/';
            $New_Image_Path = $old_image;

            // Kiểm tra nếu người dùng tải lên file ảnh mới
            if (!empty($image['name'])) {
                $New_Image_Name = 'News_' . uniqid() . strrchr($image['name'], '.');
                if (move_uploaded_file($image['tmp_name'], $File_Dir . $New_Image_Name)) {
                    $New_Image_Path = $New_Image_Name;
                } else {
                    $imageError = "Tải ảnh thất bại.";
                }
            } elseif (!empty($image_url)) {
                // Nếu người dùng nhập link URL
                if (filter_var($image_url, FILTER_VALIDATE_URL)) {
                    $New_Image_Path = $image_url;
                } else {
                    $imageUrlError = "Link URL không hợp lệ.";
                }
            }

            // Cập nhật vào cơ sở dữ liệu
            if (empty($imageError) && empty($imageUrlError)) {
                if ($this->DB->Update_News($id, $name, $New_Image_Path, $create_date, $content, $status, $category_id)) {
                    header('Location: admin.php?Page=quan_ly_bai_viet');
                    exit();
                } else {
                    echo "<script>alert('Cập nhật tin tức thất bại');</script>";
                }
            }
        }
    }

    public function Delete_Product($id)
    {
        $this->DB->Delete_Product($id);
    }
}

?>
