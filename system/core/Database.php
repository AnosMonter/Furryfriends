<?php
class Database
{
    public $pdo;
    public function __construct()
    {
        require_once 'config.php';
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME.";charset=utf8";
            $this->pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }

    public function check()
    {
        return $this->pdo == true ? 'Success' : 'Error';
    }
    /* ====================== Hóa Đơn ============================ */
    public function Select_All_Order()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM orders");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Change_Status_Odder($id, $status)
    {
        if ($status == 3) {
            $sql = "UPDATE orders SET Status_Order = :status, Payment_Date = NOW() WHERE ID = :id";
        } else {
            $sql = "UPDATE orders SET Status_Order = :status WHERE ID = :id";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Get_Order_By_Page($page, $limit)
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->pdo->prepare("SELECT * FROM orders LIMIT :offset, :limit");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_Total_Order_By_Date($date)
    {
        $stmt = $this->pdo->prepare("SELECT SUM(Total) AS 'Doanh Thu' FROM orders WHERE Date(Payment_Date) = :date");
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Check_Status_Order($id)
    {
        $stmt = $this->pdo->prepare("SELECT Status_Order FROM orders WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['Status_Order'];
    }

    public function Get_Order_Detail_By_ID($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Get_All_Orders()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM orders");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_Revenue_On_Day($date)
    {
        $stmt = $this->pdo->prepare("SELECT SUM(Total) AS 'Doanh Thu' FROM orders WHERE Date(Created_At) = :date");
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* ====================== Người Dùng ============================ */

    public function Get_Infor_User($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Get_User_By_Email($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE Email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Get_All_User()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_User_By_ID($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE ID = :id");
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Get_User_By_Page($limit, $Page)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users LIMIT :limit OFFSET :offset");
        $Page_User = ($Page - 1) * $limit;
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $Page_User, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Show_Hide_User($ID)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET Status = :status WHERE ID = :id");
        $status = $this->Get_Infor_User($ID)['Status'] == 1 ? 0 : 1;
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
        return $stmt->execute();
    }
    /* ====================== Sản Phẩm ============================ */

    public function Get_Product_By_Name_Category($name, $limit)
    {
        $stmt = $this->pdo->prepare("SELECT p.*
        FROM products p
        INNER JOIN categories c ON p.Category_ID = c.ID
        WHERE c.Name LIKE :name limit :number;");
        $Name = '%' . $name . '%';
        $stmt->bindParam(':name', $Name, PDO::PARAM_STR);
        $stmt->bindParam(':number', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_Product_Limit_New($limit = 5)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products ORDER BY ID DESC LIMIT :number");
        $stmt->bindParam(':number', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_Comment_Product_Limit_New($limit = 5)
    {
        $stmt = $this->pdo->prepare("SELECT 
            r.ID, 
            u.Name,
            r.Date,
            r.ID_Product,
            r.Status, 
            r.Rating, 
            r.Review
        FROM 
            rating_product r
        INNER JOIN users u ON r.ID_User = u.ID
        ORDER BY r.Date DESC LIMIT :number");
        $stmt->bindParam(':number', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_All_Products()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_Product_By_Category($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE Category_ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Delete_Product($ID)
    {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE ID = :id");
        $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Get_Product_By_ID($ID)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE ID = :id");
        $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Show_Hide_Products($ID)
    {
        $stmt = $this->pdo->prepare("UPDATE products SET Status = :status WHERE ID = :id");
        $status = $this->Get_Product_By_ID($ID)['Status'] == 1 ? 0 : 1;
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Get_Product_By_Page($Limit, $Page)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products LIMIT :limit OFFSET :offset");
        $Page_Product = $Page * $Limit;
        $stmt->bindParam(':limit', $Limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $Page_Product, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Add_Product($name, $price, $discount, $target_file, $description, $detail, $quantity, $status, $category_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO products (Name, Price, Discount, Image, Description, Detail, Quantity, Status, Category_ID) 
        VALUES (:name, :price, :discount, :image, :description, :detail, :quantity, :status, :category_id)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':discount', $discount, PDO::PARAM_INT);
        $stmt->bindParam(':image', $target_file, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':detail', $detail, PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Delete_Product_By_ID($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Update_Product($id, $name, $price, $discount, $image, $description, $detail, $quantity, $status, $category_id)
    {
        $stmt = $this->pdo->prepare("UPDATE products SET Name = :name, Price = :price, Discount = :discount, Image = :image , Description = :description, Detail = :detail, 
        Quantity = :quantity, Status = :status, Category_ID = :category_id WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':discount', $discount, PDO::PARAM_INT);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':detail', $detail, PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Rating_Product_By_ID_Product($id_user, $id_product, $id_order_detail, $date, $status, $rating, $review)
    {
        $stmt = $this->pdo->prepare("INSERT INTO rating_product (ID_User, ID_Product,ID_Order_Detail, Date, Status, Rating, Review) 
        VALUES (:id_user, :id_product,:id_order_detail , :date, :status, :rating, :review)");
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindParam(':id_product', $id_product, PDO::PARAM_INT);
        $stmt->bindParam(':id_order_detail', $id_order_detail, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt->bindParam(':review', $review, PDO::PARAM_STR);
        return $stmt->execute();
    }
    /* ====================== Danh Mục ============================ */

    public function Get_All_Category()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_Category_By_Page($page, $limit)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories LIMIT :limit OFFSET :offset");
        $offset = $limit * ($page - 1);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_Category_By_ID($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Get_All_Category_By_Page($limit, $page)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories LIMIT :limit OFFSET :offset");
        $Page_Category = $page * $limit;
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $Page_Category, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Add_Category($name, $image, $status)
    {
        $stmt = $this->pdo->prepare("INSERT INTO categories (Name, Image, Status) VALUES (:name, :image, :status)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Edit_Category($id, $name, $image, $status)
    {
        $stmt = $this->pdo->prepare("UPDATE categories SET Name = :name, Image = :image, Status = :status WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Delete_Category_By_ID($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Update_Category($id, $name, $image, $status)
    {
        $stmt = $this->pdo->prepare("UPDATE categories SET Name = :name, Image = :image, Status = :status WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Delete_Category($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Get_Category_By_Like_Name($name)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE Name LIKE :name");
        $Name = '%' . $name . '%';
        $stmt->bindParam(':name', $Name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /* ====================== Danh Mục Bài Viết ============================ */
    public function Get_All_News_Categories()
    {
        $query = "SELECT * FROM news_categories";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_News_Category_By_Page($page, $limit){
        $offset = $limit * ($page - 1);
        $query = "SELECT * FROM news_categories LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_News_Category_By_ID($id)
    {
        $query = "SELECT * FROM news_categories WHERE ID = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Add_News_Category($name, $status)
    {
        $query = "INSERT INTO news_categories (Name, Status) VALUES (:name, :status)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Edit_News_Category($id, $name, $status)
    {
        $query = "UPDATE news_categories SET Name = :name, Status = :status WHERE ID = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Delete_News_Category($id)
    {
        $query = "DELETE FROM news_categories WHERE ID = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Show_Hide_News_Category($id){
        $status = ($this->Get_News_Category_By_ID($id)['Status'] == 1)? 0 : 1;
        $query = "UPDATE news_categories SET Status = :status WHERE ID = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        return $stmt->execute();
    }


    /* ====================== Bài Viết ============================ */

    public function Get_All_News()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM news");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function Get_News_Limit_New($limit)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM news ORDER BY Create_Date DESC LIMIT :limit");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function Get_News_By_Page($limit, $offset)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM news ORDER BY Create_Date DESC LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function Add_News($name, $content, $image_path, $category_id, $status)
    {
        try {
            $this->pdo->beginTransaction();
            $query = "INSERT INTO news (Name, Content, Image, Category_ID, Status, Create_Date) 
                  VALUES (:name, :content, :image, :category_id, :status, NOW())";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->bindParam(':image', $image_path, PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);

            $stmt->execute();
            $this->pdo->commit();

            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return ['error' => $e->getMessage()];
        }
    }
    public function Edit_News($id, $name, $content, $image_path, $category_id, $status)
    {
        try {
            $this->pdo->beginTransaction();

            $query = "UPDATE news 
                      SET Name = :name, Content = :content, Image = :image, 
                          Category_ID = :category_id, Status = :status 
                      WHERE ID = :id";
            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->bindParam(':image', $image_path, PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
            $this->pdo->commit();

            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return ['error' => $e->getMessage()];
        }
    }
    public function Delete_News($ID)
    {
        $stmt = $this->pdo->prepare("DELETE FROM news WHERE ID = :id");
        $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Delete_News_By_ID($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM news WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Get_News_By_ID($ID)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM news WHERE ID = :id");
        $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function Show_Hide_News($ID)
    {
        $stmt = $this->pdo->prepare("UPDATE news SET Status = :status WHERE ID = :id");
        $status = $this->Get_News_By_ID($ID)['Status'] == 1 ? 0 : 1;
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Update_News($id, $name, $image, $create_date, $content, $status, $category_id)
    {
        $sql = "UPDATE news 
            SET Name = :name, Image = :image, Create_Date = :create_date, Content = :content, Status = :status, Category_ID = :category_id 
            WHERE ID = :id";
        $params = [
            ':id' => $id,
            ':name' => $name,
            ':image' => $image,
            ':create_date' => $create_date,
            ':content' => $content,
            ':status' => $status,
            ':category_id' => $category_id,
        ];

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }


    function Bai_Viet_Ngau_Nhien($soluong)
    {
        $soluong = intval($soluong);
        $sql = "SELECT * FROM news WHERE Status = 1 ORDER BY RAND() LIMIT :sl";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':sl', $soluong, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function Bai_Viet_Dem()
    {
        $sql = "SELECT COUNT(*) AS dem FROM news WHERE Status = 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['dem'];
    }



    public function Lay_Binh_Luan($news_id)
    {
        $stmt = $this->pdo->prepare("
        SELECT 
            c.Comment AS Content, 
            u.Name AS User_Name,
            c.Sent_Date, c.Comment
        FROM comments_news c
        JOIN users u ON c.User_ID = u.ID
        WHERE c.News_ID = :news_id
    ");
        $stmt->execute(['news_id' => $news_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function Them_Binh_Luan($user_id, $news_id, $comment)
    {
        $stmt = $this->pdo->prepare("INSERT INTO comments_news (User_ID, News_ID, Comment, Sent_Date) VALUES (:user_id, :news_id, :comment, NOW())");
        $stmt->bindParam(':news_id', $news_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function Get_All_Comments()
    {
        $stmt = $this->pdo->prepare("
            SELECT 
                c.ID, c.Comment AS Content, 
                u.Name AS User_Name, 
                n.Name AS News_Title, 
                c.Sent_Date 
            FROM comments_news c
            JOIN users u ON c.User_ID = u.ID
            JOIN news n ON c.News_ID = n.ID
            ORDER BY c.Sent_Date DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function Delete_Comment($comment_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM comments_news WHERE ID = :comment_id");
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    /* ========================= Trang Chủ ============================ */

    public function Get_All_Banner(){
        $sql = "SELECT * FROM banners";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_All_Banner_By_Status($status){
        $sql = "SELECT * FROM banners WHERE Status = :status";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBannerById($id)
    {
        $sql = "SELECT * FROM banners WHERE ID = :id";
        $result = $this->pdo->prepare($sql);
        $result->execute(['id' => $id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function sp_moi($so_luong)
    {
        $sql = "SELECT * FROM products WHERE Status = 1 ORDER BY ID DESC LIMIT :sl";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':sl', $so_luong, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function sp_xem_nhieu($so_luong)
    {
        $sql = "SELECT * FROM products WHERE Status = 1 ORDER BY Views DESC LIMIT :sl";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':sl', $so_luong, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function sp_cho($so_luong)
    {
        $sql = "SELECT * FROM products WHERE Status = 1 AND Name LIKE '%chó%' LIMIT :sl";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':sl', $so_luong, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function sp_meo($so_luong)
    {
        $sql = "SELECT * FROM products WHERE Status = 1 AND Name LIKE '%mèo%' LIMIT :sl";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':sl', $so_luong, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function danh_muc($so_luong)
    {
        $sql = "SELECT * FROM categories WHERE Status = 1 ORDER BY ID ASC LIMIT :sl";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':sl', $so_luong, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sp_dm($id, $page_size = 6, $page_num = 1)
    {
        $start = ($page_num - 1) * $page_size;
        $sql = "SELECT * FROM products 
                WHERE Status = 1 AND Category_ID = :id 
                ORDER BY ID DESC 
                LIMIT :start, :page_size";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':start', $start, PDO::PARAM_INT);
        $result->bindParam(':page_size', $page_size, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function dm_dem($id_dm)
    {
        $sql = "SELECT COUNT(*) AS dem 
                FROM products 
                WHERE Status = 1 AND Category_ID = :id_dm";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':id_dm', $id_dm, PDO::PARAM_INT);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data['dem'];
    }

    public function Chi_Tiet($id)
    {
        $sql = "SELECT products.*, categories.Name as ten_loai FROM products, categories WHERE products.id = :id_sp AND products.Category_ID = categories.ID";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_sp', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function tim_kiem_sp($keyword, $min_price = 0, $max_price = PHP_INT_MAX, $page_size = 6, $page_num = 1, $order = 'ASC')
    {
        $start = ($page_num - 1) * $page_size;
        $sql = "SELECT * FROM products WHERE Name LIKE :keyword AND Price BETWEEN :min_p AND :max_p AND Status = 1 ORDER BY Price $order LIMIT :start, :page_size";
        $stmt = $this->pdo->prepare($sql);
        $keyw = '%' . $keyword . '%';
        $stmt->bindParam(':keyword', $keyw, PDO::PARAM_STR);
        $stmt->bindParam(':min_p', $min_price, PDO::PARAM_INT);
        $stmt->bindParam(':max_p', $max_price, PDO::PARAM_INT);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':page_size', $page_size, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tim_kiem_dem($keyword, $min_price = 0, $max_price = PHP_INT_MAX)
    {
        $sql = "SELECT COUNT(*) AS dem 
                FROM products 
                WHERE Name LIKE :keyword 
                AND Price BETWEEN :min_p AND :max_p 
                AND Status = 1";
        $stmt = $this->pdo->prepare($sql);
        $keyw = '%' . $keyword . '%';
        $stmt->bindParam(':keyword', $keyw, PDO::PARAM_STR);
        $stmt->bindParam(':min_p', $min_price, PDO::PARAM_INT);
        $stmt->bindParam(':max_p', $max_price, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['dem'];
    }


    public function tim_san_pham_2_dk($k1, $k2)
    {
        $sql = "SELECT * FROM products WHERE Name LIKE :k1 AND Name LIKE :k2 AND Status = 1";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':k1', '%' . $k1 . '%', PDO::PARAM_STR);
        $result->bindParam(':k2', '%' . $k2 . '%', PDO::PARAM_STR);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sp_lien_quan($id, $so_luong)
    {
        $sql = "SELECT * FROM products WHERE Status = 1
        AND Category_ID in (SELECT Category_ID FROM products WHERE ID = :id1) AND ID <> :id2
        ORDER BY ID DESC LIMIT :sl";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':id1', $id, PDO::PARAM_INT);
        $result->bindParam(':id2', $id, PDO::PARAM_INT);
        $result->bindParam(':sl', $so_luong, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function binhluan_sp($ProductId)
    {
        $sql = "SELECT
                    r.ID, r.ID_User, r.ID_Product, r.Date, r.Status, r.Rating, r.Review,
                    u.Name AS UserName
                FROM
                    rating_product r
                INNER JOIN
                    users u
                ON
                    r.ID_User = u.ID
                WHERE
                    r.ID_Product = :id_prd AND r.Status = 1
                ORDER BY
                    r.Date DESC";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':id_prd', $ProductId, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function xem_chi_tietdh($id)
    {
        $sql = "SELECT od.ID, od.ID_Product, od.Price, od.Quantity, p.Image, p.Name 
                FROM order_details od
                LEFT JOIN products p ON od.ID_Product = p.ID
                WHERE od.ID_Order = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_All_Rating_Product()
    {
        $stmt = $this->pdo->prepare("SELECT p.ID, p.Name, AVG(r.Rating) as Rating 
                                    FROM products p 
                                    LEFT JOIN rating_product r ON p.ID = r.ID_Product 
                                    GROUP BY p.ID, p.Name");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_Product_Rating_By_ID_Order_Detail($id)
    {
        $stmt = $this->pdo->prepare("SELECT * from rating_product where ID_Order_Detail = :id_order_detail");
        $stmt->bindParam(':id_order_detail', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Up_View_Product($id)
    {
        $stmt = $this->pdo->prepare("UPDATE products SET Views = Views + 1 WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Up_View_News($id)
    {
        $stmt = $this->pdo->prepare("UPDATE news SET Views = Views + 1 WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /* ===================== Dịch Vụ ====================== */
    public function Get_All_Service()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM services");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_Service_By_Page($page, $limit)
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->pdo->prepare("SELECT * FROM services LIMIT :offset, :limit");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_Service_By_ID($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM services WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function Get_Service_By_ID_Category($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM services WHERE Category_ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Insert_Service($name, $image, $price, $description, $time, $category_id, $status)
    {
        $stmt = $this->pdo->prepare("INSERT INTO services (Name, Image, Price, Detail, Time_Service, Category_ID, Status) 
        VALUES (:name, :image, :price, :description, :time, :category_id, :status)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':time', $time, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Update_Service($id, $name, $image, $price, $description, $time, $category_id, $status)
    {
        $stmt = $this->pdo->prepare("UPDATE services SET Name = :name, Image = :image, Price = :price, Detail = :description, Time_Service = :time, Category_ID = :category_id, 
        Status = :status WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_INT);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':time', $time, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Delete_Service($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM services WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function Show_Hide_Service($id)
    {
        $stmt = $this->pdo->prepare("UPDATE services SET Status = :status WHERE ID = :id");
        $status = ($this->Get_Service_By_ID($id)['Status'] == 1) ? 0 : 1;
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
