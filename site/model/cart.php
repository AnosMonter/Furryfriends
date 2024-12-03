<?php
function insertOrder($db) {
    if (isset($_SESSION['myCart']['infoOrder']) && !empty($_SESSION['myCart']['infoOrder'])) {
        $infoOrder = $_SESSION['myCart']['infoOrder'][0];
        $cartItems = $_SESSION['myCart']['listCart'];
        $ID_User = $_SESSION['User_login']['ID'] ?? null;
        $Name = $infoOrder[0];
        $Phone = $infoOrder[2];
        $Address = $infoOrder[1];
        $Payment_Method = $infoOrder[4];
        $Total = $infoOrder[5];

        if (!$ID_User) {
            echo "Không thể tạo đơn hàng vì thiếu ID người dùng.";
            return null;
        }

        try {
            $db->pdo->beginTransaction();
            $sql = "INSERT INTO orders (ID_User, Name, Phone, Address, Create_Date, Payment_Method, Total) 
                    VALUES (:ID_User, :Name, :Phone, :Address, NOW(), :Payment_Method, :Total)";
            $stmt = $db->pdo->prepare($sql);

            $stmt->bindParam(':ID_User', $ID_User, PDO::PARAM_INT);
            $stmt->bindParam(':Name', $Name, PDO::PARAM_STR);
            $stmt->bindParam(':Phone', $Phone, PDO::PARAM_STR);
            $stmt->bindParam(':Address', $Address, PDO::PARAM_STR);
            $stmt->bindParam(':Payment_Method', $Payment_Method, PDO::PARAM_INT);
            $stmt->bindParam(':Total', $Total, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $orderID = $db->pdo->lastInsertId();
                $sqlDetails = "INSERT INTO order_details (ID_Order, ID_Product, Price, Quantity) 
                               VALUES (:ID_Order, :ID_Product, :Price, :Quantity)";
                $stmtDetails = $db->pdo->prepare($sqlDetails);

                foreach ($cartItems as $item) {
                    $stmtDetails->bindParam(':ID_Order', $orderID, PDO::PARAM_INT);
                    $stmtDetails->bindParam(':ID_Product', $item[0], PDO::PARAM_INT);
                    $stmtDetails->bindParam(':Price', $item[5], PDO::PARAM_STR);
                    $stmtDetails->bindParam(':Quantity', $item[4], PDO::PARAM_INT);
                    $stmtDetails->execute();
                }

                unset($_SESSION['myCart']);

                $db->pdo->commit();

                header('location:index.php?Page=dat_hang_thanh_cong');

                return $orderID;
            } else {
                throw new Exception("Đã xảy ra lỗi khi thêm đơn hàng.");
            }
        } catch (Exception $e) {
            $db->pdo->rollBack();
            echo "Lỗi: " . $e->getMessage();
            return null;
        }
    }
}