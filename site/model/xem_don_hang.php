<?php
class XemDonHang {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function layDonHangTheoIDUser($id_user) {
        $sql = "SELECT * FROM orders WHERE ID_User = :id_user";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Danh_Gia_San_Pham() {
        if (isset($_POST['Sub_Rate']) && !empty($_POST['Sub_Rate'])){
            $id_user = $_SESSION['User_login']['ID'];
            $id_product = $_POST['ID_DG'];
            $id_order_detail = $_POST['ID_Order_Detail'];
            $date = date('Y-m-d H:i:s');
            $status = 1;
            $rating = $_POST['Rate'];
            $review = $_POST['Review'];
            if (empty($rating)){
                echo 'Không được bỏ trống đánh giá mức độ hài lòng';
                exit();
            } else {
                if ($this->db->Rating_Product_By_ID_Product($id_user, $id_product,$id_order_detail, $date, $status, $rating, $review)){
                    echo '<script>alert("Cám ơn bạn đã đánh giá sản phẩm này")</script>';
                    header('refresh: 2s, url=index.php?Page=chi_tiet&id='.$id_product);
                } else {
                    echo '<script>alert("Đánh giá sản phẩm thất bại")</script>';
                }
            }
        }
    }
}
?>
