<?php
class Quen_Mat_Khau
{
    public $DB;
    public function __construct()
    {
        $this->DB = new Database();
    }

    public function sentCode()
    {
        if (isset($_POST['Sent_Code']) && !empty($_POST['Sent_Code'])) {
            include_once 'system/lib/master/Sent_Mail.php';
            setcookie('Code_Reset_Pass', '', time() - 3600);
            setcookie('User_RS_Pass', '', time() - 3600);
            $Code = rand(100000, 999999);
            $Email = $_POST['email'];
            $User = $this->DB->Get_User_By_Email($Email);
            if (!empty($User)) {
                echo "<script>alert('Mã Đã Được Gửi Đến Email Của Bạn')</script>";
                setcookie('User_RS_Pass', $User['ID'], time() + 300);
                setcookie("Code_Reset_Pass", $Code, time() + 300);
                Sent_Emal($Email, 'Quên Mật Khẩu', 'Mã Đặt Lại Mật Khẩu Của Bạn Là: ' . $Code . '<br>Mã Có Hiệu Lực Trong 5 Phút');
                header('location: index.php?Page=nhap_mat_khau_moi');
            } else {
                echo "<script>alert('Email Chưa Được Đăng Ký')</script>";
            }
        }
    }
    public function Nhap_mat_khau_moi()
    {
        if (isset($_POST['RS_Pass']) && !empty($_POST['RS_Pass'])) {
            $New_Pass = $_POST['new_password'];
            $Confirm_Pass = $_POST['confirm_password'];
            $Verification_Code = $_POST['verification-code'];
            $Veri_Code = $_COOKIE['Code_Reset_Pass'];
            $ID_User_RS_Pass = $_COOKIE['User_RS_Pass'];
            if ($Verification_Code == $Veri_Code) {
                if ($New_Pass == $Confirm_Pass) {
                    $Pass_Change = password_hash($New_Pass, PASSWORD_DEFAULT);
                    $DB = new Database();
                    $query = "UPDATE users SET password = :pass WHERE id = :id";
                    $stmt = $DB->pdo->prepare($query);
                    $stmt->bindParam(':pass', $Pass_Change);
                    $stmt->bindParam(':id', $ID_User_RS_Pass);
                    $stmt->execute();
                    setcookie('Code_Reset_Pass', '', time() - 3600);
                    setcookie('User_RS_Pass', '', time() - 3600);
                    echo '<script>alert("Mật Khẩu Đã Được Đổi Thành Công Vui Lòng Đăng Nhập Lại")</script>';
                    header('refresh: 2s, url= index.php?Page=dang_nhap');
                    exit();
                } else {
                    echo '<script>alert("Mật Khẩu Không Khớp Nhau")</script>';
                }
            } else {
                echo '<script>alert("Mã Xác Minh Không Khớp")</script>';
            }
        }
    }
}
