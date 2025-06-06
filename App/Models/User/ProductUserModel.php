<?php
class ProductUserModel
{
    public $db;

    // Khởi tạo đối tượng Database để kết nối cơ sở dữ liệu
    public function __construct()
    {
        $this->db = new Database();
    }

    // Lấy 12 sản phẩm ngẫu nhiên từ cơ sở dữ liệu để hiển thị trên dashboard
    public function getProductDashboard()
    {
        $sql = "SELECT * FROM products ORDER BY rand() LIMIT 12";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetchAll();
        return $result;
    }

    // Lấy tất cả sản phẩm, có thể lọc theo category_id nếu có
    public function getDataShop()
    {
        $sql = "SELECT * FROM `products`";
        if (isset($_GET['category_id'])) {
            $sql .= " WHERE category_id=:category_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':category_id', $_GET['category_id']);
        } else {
            $stmt = $this->db->pdo->prepare($sql);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy số lượng sản phẩm còn hàng và hết hàng
    public function getProductStock()
    {
        $sql1 = "SELECT COUNT(id) as instock FROM `products` WHERE stock > 0";
        $query1 = $this->db->pdo->query($sql1);
        $inStock = $query1->fetch();

        $sql2 = "SELECT COUNT(id) as outstock FROM `products` WHERE stock = 0";
        $query2 = $this->db->pdo->query($sql2);
        $outStock = $query2->fetch();

        return [$inStock, $outStock]; // Trả về số lượng sản phẩm còn và hết hàng
    }

    // Tìm kiếm sản phẩm theo tên không chính xác
    public function getDataShopName()
    {
        $productName = $_GET['product-name'];
        $sql = "SELECT * FROM products WHERE name like '%$productName%'";
        $query = $this->db->pdo->query($sql);
        return $query->fetchAll();
    }

    // Lấy thông tin sản phẩm theo product_id
    public function getProductById()
    {
        if (isset($_GET['product_id'])) {
            $sql = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $_GET['product_id']);
            $stmt->execute();
            return $stmt->fetch();
        }
    }

    // Lấy hình ảnh của sản phẩm theo product_id
    public function getProductImageById()
    {
        if (isset($_GET['product_id'])) {
            $sql = "SELECT * FROM product_image WHERE product_id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $_GET['product_id']);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    // Lấy các sản phẩm cùng category với sản phẩm hiện tại, ngoại trừ sản phẩm đang xem
    public function getProductByCategory()
    {
        if (isset($_GET['category_id']) && isset($_GET['product_id'])) {
            $sql = "SELECT * FROM products WHERE category_id = :category_id AND id != :product_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':category_id', $_GET['category_id']);
            $stmt->bindParam(':product_id', $_GET['product_id']);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    // Lấy các biến thể của sản phẩm theo product_id
    public function getVaribalById()
    {
        if (isset($_GET['product_id'])) {
            $sql = "SELECT * FROM product_variants WHERE product_id = :product_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':product_id', $_GET['product_id']);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Lấy các bình luận của sản phẩm
    public function getComment($productId)
    {
        $sql = "SELECT product_comment.*, users.name, users.image 
                FROM product_comment 
                JOIN users ON product_comment.user_id = users.id 
                WHERE product_comment.product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lưu đánh giá của người dùng cho sản phẩm
    public function saveRating()
    {
        $sql = "SELECT * FROM product_rating WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $_SESSION['users']['id']);
        $stmt->bindParam(':product_id', $_POST['productId']);
        $stmt->execute();

        if ($stmt->fetch()) {  // Nếu đã đánh giá, cập nhật đánh giá
            $sql = "UPDATE `product_rating` SET `rating`= :rating WHERE user_id = :user_id AND product_id = :product_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $_SESSION['users']['id']);
            $stmt->bindParam(':rating', $_POST['rate']);
            $stmt->bindParam(':product_id', $_POST['productId']);
            return $stmt->execute();
        }

        // Nếu chưa đánh giá, chèn đánh giá mới vào cơ sở dữ liệu
        $productId = $_POST['productId'];
        $rate = $_POST['rate'];
        $userid = $_SESSION['users']['id'];
        $now = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `product_rating`(`product_id`, `user_id`, `rating`,`created_at`) 
                VALUES (:product_id, :user_id, :rating, :created_at)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':user_id', $userid);
        $stmt->bindParam(':rating', $rate);
        $stmt->bindParam(':created_at', $now);
        return $stmt->execute();
    }

    // Lưu bình luận của người dùng cho sản phẩm
    public function saveComment()
    {
        // Lấy dữ liệu từ form
        $productId = $_POST['productId'];
        $userid = $_SESSION['users']['id'];
        $comment = $_POST['comment'];
        $now = date('Y-m-d H:i:s');
        $parent = null;

        try {
            // Lưu bình luận vào bảng product_comment
            $sql = "INSERT INTO `product_comment`(`product_id`, `user_id`, `comment`, `created_at`, `parent`) 
                    VALUES (:product_id, :user_id, :comment, :created_at, :parent)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':product_id', $productId);
            $stmt->bindParam(':user_id', $userid);
            $stmt->bindParam(':comment', $comment);
            $stmt->bindParam(':parent', $parent);
            $stmt->bindParam(':created_at', $now);
            $stmt->execute();

            // Lấy category_id từ bảng products
            $query = "SELECT category_id FROM products WHERE id = :product_id";
            $stmt = $this->db->pdo->prepare($query);
            $stmt->bindParam(':product_id', $productId);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && isset($result['category_id'])) {
                return $result['category_id']; // Trả về category_id để sử dụng trong chuyển hướng
            } else {
                throw new Exception("Category ID không tồn tại cho product_id: $productId");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Lấy đánh giá của người dùng cho sản phẩm
    public function getCommentByUser($productId, $userId)
    {
        $sql = "SELECT * FROM product_rating WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Lấy tất cả đánh giá của sản phẩm
    public function getRating($productId)
    {
        $sql = "SELECT * FROM product_rating WHERE product_id=:product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Tính điểm trung bình của các đánh giá sản phẩm
    public function avgRating($productId)
    {
        $sql = "SELECT avg(rating) as avgRating FROM `product_rating` WHERE product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();

        return round($stmt->fetch()->avgRating ?? 0, 2);
    }

    // Lấy sản phẩm theo tên danh mục
    public function getProductsByCategoryName($categoryName)
    {
        $sql = "
            SELECT products.*
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            WHERE categories.name = :name
        ";
    
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':name', $categoryName, PDO::PARAM_STR);
    
        try {
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }
};
?>
