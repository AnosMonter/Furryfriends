<?php
class Dang_Nhap_Dang_Ky
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function DangNhap()
{
    $errors = [];

    if (isset($_POST['dangnhap']) && !empty($_POST['dangnhap'])) {
        $email = $_POST['Email'];
        $pass = $_POST['Pass'];

        $validationErrors = $this->Validate_DN(['Email' => $email, 'Mat_khau' => $pass]);
        if (!empty($validationErrors)) {
            return $validationErrors;
        }

        $db = new Database();
        $sql = "SELECT * FROM users WHERE Email = :email";
        $stmt = $db->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($pass, $row['Password'])) {
                if ($row['Status'] == 1) {
                    $user = ['ID' => $row['ID'], 'Name' => $row['Name'], 'Email' => $row['Email'], 'Role' => $row['Role']];
                    $_SESSION['User_login'] = $user;
                    header("Location: index.php");
                    exit();
                } else {
                    $errors['Status'] = "Tài khoản đã bị khoá!";
                }
            } else {
                $errors['Credentials'] = "Sai email hoặc mật khẩu!";
            }
        } else {
            $errors['Credentials'] = "Sai email hoặc mật khẩu!";
        }
    }
    return $errors;
}

    public function Validate_DN($user) {
        $loi1 = [];

        if ($user['Email'] == "") {
            $loi1['Email'] = "Chưa nhập Email";
        }

        if ($user['Mat_khau'] == "") {
            $loi1['Mat_khau'] = "Chưa nhập mật khẩu";
        }
        return $loi1;
    }
    public function DangKy()
    {
        if (isset($_POST['dangky']) && !empty($_POST['dangky'])) {
            $username = $_POST['Ten'];
            $tenhienthi = $_POST['Ten_hien_thi'];
            $sdt = $_POST['So_dien_thoai'];
            $email = $_POST['Email'];
            $pass = $_POST['Mat_khau']; 
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT); 
            $role = 0;
            $status = 1;

            if (empty($username) || empty($sdt) || empty($email) || empty($pass) || empty($tenhienthi)) {
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('Email không hợp lệ! Vui lòng nhập lại email đúng định dạng.')</script>";
                return;
            }

            if (strlen($username) < 3) {
                echo "<script>alert('Tên người dùng phải có ít nhất 3 ký tự!')</script>";
                return;
            }

            if (strlen($tenhienthi) < 3) {
                echo "<script>alert('Tên hiển thị phải có ít nhất 3 ký tự!')</script>";
                return;
            }

            if (strlen($pass) < 8) {
                echo "<script>alert('Mật khẩu phải có ít nhất 8 ký tự!')</script>";
                return;
            }

            $db = new Database();

            // Kiểm tra nếu username hoặc email đã tồn tại
            $sql_check_username = "SELECT * FROM users WHERE Username = :username";
            $stmt_check_username = $db->pdo->prepare($sql_check_username);
            $stmt_check_username->bindParam(':username', $username);
            $stmt_check_username->execute();

            $sql_check_email = "SELECT * FROM users WHERE Email = :email";
            $stmt_check_email = $db->pdo->prepare($sql_check_email);
            $stmt_check_email->bindParam(':email', $email);
            $stmt_check_email->execute();

            if ($stmt_check_username->rowCount() > 0) {
                echo "<script>alert('Tên người dùng đã tồn tại!')</script>";
            } elseif ($stmt_check_email->rowCount() > 0) {
                echo "<script>alert('Email đã tồn tại!')</script>";
            } else {
                $code = rand(100000, 999999);
                setcookie('Code_Register', $code, time() + 300); 
                setcookie('Register_Data', json_encode(compact('username', 'tenhienthi', 'sdt', 'email', 'hashed_pass', 'role', 'status')), time() + 300);

                include_once 'system/lib/master/Sent_Mail.php';
                Sent_Emal($email, 'Xác nhận đăng ký tài khoản', "
                                    Furry Friends
                                    <br>
                                    Xin chào,
                                    <br>
                                    Cảm ơn bạn đã đăng ký tài khoản tại Furry Friends!
                                    <br>    
                                    Mã xác nhận của bạn là: $code
                                    <br>                                    
                                    Mã này có hiệu lực trong 5 phút. Vui lòng sử dụng mã để hoàn tất quá trình xác nhận tài khoản của bạn.
                                    <br>
                                    Nếu bạn không yêu cầu đăng ký tài khoản, vui lòng bỏ qua email này.
                                    <br>
                                    Trân trọng,
                                    Đội ngũ Furry Friends
                                    ");

                echo "<script>alert('Mã xác nhận đã được gửi đến email của bạn. Vui lòng kiểm tra!');</script>";
                header("Location: index.php?Page=dangky_step2"); 
            }
        }
    }

    public function Validate_DK($user) {
        $loi = [];
    
        if ($user['Ten'] == "") {
            $loi['Ten'] = "Chưa nhập tên người dùng";
        }
    
        if ($user['Ten_hien_thi'] == "") {
            $loi['Ten_hien_thi'] = "Chưa nhập tên hiển thị";
        }
    
        if ($user['So_dien_thoai'] == "") {
            $loi['So_dien_thoai'] = "Chưa nhập số điện thoại";
        }
    
        if ($user['Email'] == "") {
            $loi['Email'] = "Chưa nhập email";
        } else if (!filter_var($user['Email'], FILTER_VALIDATE_EMAIL)) {
            $loi['Email'] = "Email không hợp lệ";
        }
    
        if ($user['Mat_khau'] == "") {
            $loi['Mat_khau'] = "Chưa nhập mật khẩu";
        } else if (strlen($user['Mat_khau']) < 8) {
            $loi['Mat_khau'] = "Mật khẩu phải có ít nhất 8 ký tự";
        }    
        return $loi;
    }
    
    public function DangKyStep2()
    {
        if (isset($_POST['xacnhan']) && !empty($_POST['xacnhan'])) {
            $ma_xac_nhan = $_POST['Ma_xac_nhan'];
            if (isset($_COOKIE['Code_Register']) && $_COOKIE['Code_Register'] == $ma_xac_nhan) {
                $register_data = json_decode($_COOKIE['Register_Data'], true);
                $db = new Database();
                $sql_insert = "INSERT INTO users (Username, Password, Name, Phone, Email, Role, Status) 
                           VALUES (:username, :pass, :name, :phone, :email, :role, :status)";
                $stmt_insert = $db->pdo->prepare($sql_insert);

                $stmt_insert->bindValue(':username', $register_data['username']);
                $stmt_insert->bindValue(':pass', $register_data['hashed_pass']);
                $stmt_insert->bindValue(':name', $register_data['tenhienthi']);
                $stmt_insert->bindValue(':phone', $register_data['sdt']);
                $stmt_insert->bindValue(':email', $register_data['email']);
                $stmt_insert->bindValue(':role', $register_data['role']);
                $stmt_insert->bindValue(':status', $register_data['status']);
                $stmt_insert->execute();
                setcookie('Code_Register', '', time() - 3600);
                setcookie('Register_Data', '', time() - 3600);

                echo "<script>alert('Đăng ký thành công!')</script>";
                header("refresh: 2; url=index.php?Page=dang_nhap");
            } else {
                echo "<script>alert('Mã xác nhận không đúng hoặc đã hết hạn!')</script>";
            }
        }
    }
    public function cap_nhat_thong_tin($id, $name, $username, $phone, $email)
    {
        if (empty($name) || empty($username) || empty($phone) || empty($email)) {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
            return false;
        }

        $query = "UPDATE users SET Name = :name, Username = :username, Phone = :phone, Email = :email WHERE ID = :id";
        $stmt = $this->db->pdo->prepare($query);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function Validate_CN($user){
        $loi3 = [];
    
        if ($user['Ten'] == "") {
            $loi3['Ten'] = "Không được bỏ trống tên";
        }
        
        if ($user['Email'] == "") {
            $loi3['Email'] = "Chưa nhập email";
        } else if (!filter_var($user['Email'], FILTER_VALIDATE_EMAIL)) {
            $loi3['Email'] = "Email không hợp lệ";
        }
    
        if ($user['So_dien_thoai'] == "") {
            $loi3['So_dien_thoai'] = "Chưa nhập số điện thoại";
        }
    
        if ($user['Ten_hien_thi'] == "") {
            $loi3['Ten_hien_thi'] = "Không được bỏ trống tên hiển thị";
        }
    
        if ($user['Mat_khau'] == "") {
            $loi3['Mat_khau'] = "Chưa nhập mật khẩu";  
        }
        return $loi3;
    }

    public function cap_nhat_mat_khau($ID, $new_password)
    {
        $query = "UPDATE users SET Password = :password WHERE ID = :ID";
        $stmt = $this->db->pdo->prepare($query);
        $stmt->bindValue(':password', $new_password);
        $stmt->bindValue(':ID', $ID);
        return $stmt->execute();
    }
    public function Validate_TDMK($user) {
        $loi2 = [];
    
        if (empty($user['old_password'])) {
            $loi2['old_password'] = "Chưa nhập mật khẩu cũ";
        }
    
        if (empty($user['new_password'])) {
            $loi2['new_password'] = "Chưa nhập mật khẩu mới";
        } elseif (strlen($user['new_password']) < 8) {
            $loi2['new_password'] = "Mật khẩu mới phải có ít nhất 8 ký tự";
        }
    
        if (empty($user['confirm_password'])) {
            $loi2['confirm_password'] = "Chưa nhập xác nhận mật khẩu";
        } elseif ($user['new_password'] !== $user['confirm_password']) {
            $loi2['confirm_password'] = "Xác nhận mật khẩu không khớp";
        }
    
        return $loi2;
    }
    
}
