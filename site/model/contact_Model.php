<?php
class Contact {
    public function Contact_Admin() {
        include_once 'system/lib/master/Sent_Mail.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $message = $_POST['message'];
            if (empty($name)) {
                $errorName = "Vui lòng nhập họ tên";
            } else if (empty($email)) {
                $errorEmail = "Vui lòng nhập email";
            } else if (empty($phone)) {
                $errorPhone = "Vui lòng nhập số điện thoại";
            } else if (empty($message)) {
                $errorMessage = "Vui lòng nhập nội dung";
            } else {
                $Subject = '
                <div
                    style="color: black; font-weight: bolder; width: 600px; background-color: rgba(247, 148, 29,0.3); border: 5px dashed #F7941D; border-radius: 20px; display: grid; grid-template-columns: 1fr; padding: 20px; box-sizing: border-box;">
                    <h1>Cảm Ơn Bạn Đã Liên Hệ Với Chúng Tôi</h1>
                    <p style="font-size: 20px; width: calc(100% - 10px); text-align: left;">Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất
                        có thể</p>
                    <div class="Infor-Mail" style="width: calc(100% - 10px); display: grid; grid-template-columns: 1fr; justify-content: center; grid-gap: 10px;">
                        <fieldset style="width: calc(100% - 10px); border: 1px solid rgba(0,0 ,0,1); border-radius: 10px;">
                            <legend>Họ Và Tên</legend>
                            <p>'. $name .'</p>
                        </fieldset>
                        <fieldset style="width: calc(100% - 10px); border: 1px solid rgba(0,0 ,0,1); border-radius: 10px;">
                            <legend>Email</legend>
                            <p>'. $email .'</p>
                        </fieldset>
                        <fieldset style="width: calc(100% - 10px); border: 1px solid rgba(0,0 ,0,1); border-radius: 10px;">
                            <legend>Số Điện Thoại</legend>
                            <p>'. $phone .'</p>
                        </fieldset>
                        <fieldset
                            style="width: calc(100% - 10px); display: flex; flex-wrap: wrap; border: 1px solid rgba(0,0 ,0,1); border-radius: 10px;">
                            <legend>Nội Dung</legend>
                            <textarea
                                style="font-size: 18px; min-height: 100px; resize: none; outline: none; font-weight: bolder; width: calc(100% - 10px); background-color: rgba(255,255,255,0); border: none;"
                                name="" id=""
                                readonly>'. $message .'</textarea>
                        </fieldset>
                    </div>
                </div>';

                $Subject_Admin = '
                <div
                    style="color: black; font-weight: bolder; width: 600px; background-color: rgba(247, 148, 29,0.3); border: 5px dashed #F7941D; border-radius: 20px; display: grid; grid-template-columns: 1fr; padding: 20px; box-sizing: border-box;">
                    <h1>Liên Hệ Với '. $name .' Sớm Nhất Nhé</h1>
                    <p style="font-size: 20px; width: calc(100% - 10px); text-align: left;">Vui lòng liên hệ lại với '. $name .' trong thời gian sớm nhất
                        có thể</p>
                    <div class="Infor-Mail" style="width: calc(100% - 10px); display: grid; grid-template-columns: 1fr; justify-content: center; grid-gap: 10px;">
                        <fieldset style="width: calc(100% - 10px); border: 1px solid rgba(0,0 ,0,1); border-radius: 10px;">
                            <legend>Họ Và Tên</legend>
                            <p>'. $name .'</p>
                        </fieldset>
                        <fieldset style="width: calc(100% - 10px); border: 1px solid rgba(0,0 ,0,1); border-radius: 10px;">
                            <legend>Email</legend>
                            <p>'. $email .'</p>
                        </fieldset>
                        <fieldset style="width: calc(100% - 10px); border: 1px solid rgba(0,0 ,0,1); border-radius: 10px;">
                            <legend>Số Điện Thoại</legend>
                            <p>'. $phone .'</p>
                        </fieldset>
                        <fieldset
                            style="width: calc(100% - 10px); display: flex; flex-wrap: wrap; border: 1px solid rgba(0,0 ,0,1); border-radius: 10px;">
                            <legend>Nội Dung</legend>
                            <textarea
                                style="font-size: 18px; min-height: 100px; resize: none; outline: none; font-weight: bolder; width: calc(100% - 10px); background-color: rgba(255,255,255,0); border: none;"
                                name="" id=""
                                readonly>'. $message .'</textarea>
                        </fieldset>
                    </div>
                </div>';
                Sent_Emal($email,'Cảm Ơn Đã Liên Hệ Với Chúng Tôi', $Subject);
                Sent_Emal('furryfriendscontactad@gmail.com','Bạn Nhận Được Tin Nhắn Từ '. $name, $Subject_Admin);
            }
        }
    }
}