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
            if (empty($Email)) {
                $Error_Email = 'Không Được Bỏ Trống Email';
                header('location: index.php?Page=quen_mat_khau&Error=' . $Error_Email);
                exit();
            } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                $Error_Email = 'Email Không Hợp Lệ';
                header('location: index.php?Page=quen_mat_khau&Error=' . $Error_Email);
                exit();
            } else if (!empty($this->DB->Get_User_By_Email($Email)) && empty($Error_Email)) {
                echo "<script>alert('Mã Đã Được Gửi Đến Email Của Bạn')</script>";
                setcookie('User_RS_Pass', $this->DB->Get_User_By_Email($Email)['ID'], time() + 300);
                setcookie("Code_Reset_Pass", $Code, time() + 300);
                $Content_Mail = '
                                <body style="box-sizing: border-box; width: 100%; display: flex; background-color: rgb(230,230,230);">
                    <div style="border-radius: 10px; width: 40%; margin: 50px auto; display: block; box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); background-color: white; padding: 10px;"
                        id="mail-forgot-password">
                        <div style="border-radius: 10px 10px 100% 100%; background-color: #F7941D; padding: 0 100px 50px 100px;"
                            class="bg-logo">
                            <h1
                                style="width: 100%; text-align: center; margin: 0; padding: 10px; font-weight: bold; font-size: 40px; margin-bottom: 20px; color: white;">
                                Quên mật khẩu</h1>
                            <div style="width: 100%; display: flex; justify-content: center; align-items: center;" class="logo">
                                <img style="width: 100%; margin: 0 auto; border-radius: 50%;" src="https://i.pinimg.com/736x/cd/c5/35/cdc5359e05829e22c8ecb9b3c6cd04ab.jpg" alt="">
                            </div>
                        </div>
                        <h1 style="width: 100%; text-align: center; font-size: 30px; font-weight: bolder; margin: 10px; padding: 0;">Thông Tin Chi Tiết</h1>
                        <div style="padding: 20px; font-size: 20px; font-weight: bolder;" class="content-mail-forgot-password">
                            Chào '. $this->DB->Get_User_By_Email($Email)['Name'] .',
                            <br>
                            Bạn vừa yêu cầu đặt lại mật khẩu cho tài khoản <a style="text-decoration: none; color: #F7941D;" href="http://furryfriends.io.vn/">Furry Friends</a>.
                            <br>
                            Mã xác thực của bạn là: '. $Code .'
                            <br>
                            Vui lòng nhập mã này vào trang đặt lại mật khẩu để tạo mật khẩu mới.
                            <br>
                            Lưu ý: Mã này chỉ có hiệu lực trong vòng 5 phút.
                            <br>
                            Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này.
                            <br>
                            Trân trọng,<br>
                            <a style="text-decoration: none; color: #F7941D;" href="http://furryfriends.io.vn/">Furry Friends</a>
                        </div>
                    </div>
                </body>
                ';
                Sent_Emal($Email, 'Quên Mật Khẩu', $Content_Mail);
                header('location: index.php?Page=nhap_mat_khau_moi');
            } else {
                $Error_Email = "Email Chưa Được Đăng Ký";
                header('location: index.php?Page=quen_mat_khau&Error=' . $Error_Email);
                exit();
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
