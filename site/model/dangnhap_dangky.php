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
        if (isset($_POST['dangnhap']) && !empty($_POST['dangnhap'])) {
            $email = $_POST['Email'];
            $pass = $_POST['Pass'];
            if (empty($email) || empty($pass)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
                return;
            }
            $db = new Database();
            $sql = "SELECT * FROM users WHERE Email = :email";
            $stmt = $db->pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($pass, $row['Password'])) {
                    $User = ['ID' => $row['ID'], 'Name' => $row['Name'], 'Email' => $row['Email'], 'Role' => $row['Role']];
                    $_SESSION['User_login'] = $User;
                    echo "<script>alert('Đăng nhập thành công')</script>";
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<script>alert('Sai email hoặc mật khẩu')</script>";
                }
            } else {
                echo "<script>alert('Sai email hoặc mật khẩu')</script>";
            }
        }
    }

    public function DangKy()
    {
        if (isset($_POST['dangky']) && !empty($_POST['dangky'])) {
            $username = $_POST['Ten'];
            $tenhienthi = $_POST['Ten_hien_thi'];
            $sdt = $_POST['So_dien_thoai'];
            $email = $_POST['Email'];
            $pass = $_POST['Mat_khau']; // Lưu mật khẩu gốc để kiểm tra
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT); // Mã hóa mật khẩu
            $role = 0;
            $status = 1;

            // Kiểm tra nếu thông tin không rỗng
            if (empty($username) || empty($sdt) || empty($email) || empty($pass) || empty($tenhienthi)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
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
                // Tạo mã xác nhận
                $code = rand(100000, 999999);
                setcookie('Code_Register', $code, time() + 300); // Lưu mã vào cookie 5 phút
                setcookie('Register_Data', json_encode(compact('username', 'tenhienthi', 'sdt', 'email', 'hashed_pass', 'role', 'status')), time() + 300);

                // Gửi email
                include_once 'system/lib/master/Sent_Mail.php';
                Sent_Emal($email, 'Xác nhận đăng ký tài khoản', "Mã xác nhận của bạn là: $code. Mã có hiệu lực trong 5 phút.");
                echo "<script>alert('Mã xác nhận đã được gửi đến email của bạn. Vui lòng kiểm tra!');</script>";
                header("Location: index.php?Page=dangky_step2"); // Chuyển sang form nhập mã xác nhận
            }
        }
    }


    public function DangKyStep2()
    {
        if (isset($_POST['xacnhan']) && !empty($_POST['xacnhan'])) {
            $ma_xac_nhan = $_POST['Ma_xac_nhan'];
            if (isset($_COOKIE['Code_Register']) && $_COOKIE['Code_Register'] == $ma_xac_nhan) {
                // Nếu mã xác nhận đúng, đăng ký tài khoản
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
        $query = "UPDATE users SET Name = :name, Username = :username, Phone = :phone, Email = :email WHERE ID = :id";
        $stmt = $this->db->pdo->prepare($query);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
    public function cap_nhat_mat_khau($ID, $new_password)
    {
        $query = "UPDATE users SET Password = :password WHERE ID = :ID";
        $stmt = $this->db->pdo->prepare($query);
        $stmt->bindValue(':password', $new_password);
        $stmt->bindValue(':ID', $ID);
        return $stmt->execute();
    }
}
