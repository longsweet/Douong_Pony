<?php
class ProductUserModel
{
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getProductDashboard()
    {
        $sql = "SELECT * FROM products ORDER BY rand() LIMIT 12";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetchAll();
        return $result;
    }

    public function getDataShop()
    {
        $sql = "SELECT * FROM `products`";
        if (isset($_GET['category_id'])) {
            $sql = $sql . " WHERE category_id=:category_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':category_id', $_GET['category_id']);
        } else {
            $stmt = $this->db->pdo->prepare($sql);
        }

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getProductStock()
    {
        $sql1 = "SELECT COUNT(id) as instock FROM `products` WHERE stock > 0";
        $query1 = $this->db->pdo->query($sql1);
        $inStock = $query1->fetch();

        $sql2 = "SELECT COUNT(id) as outstock FROM `products` WHERE stock = 0";
        $query2 = $this->db->pdo->query($sql2);
        $outStock = $query2->fetch();
        return [$inStock, $outStock];
    }




    public function getDataShopName()
    { // tìm kiếm theo tên không chính xác 

        $productName = $_GET['product-name'];
        $sql = "SELECT * FROM products WHERE name like '%$productName%'";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetchAll();
        return $result;
    }
    //
    public function getProductById()
    {
        if (isset($_GET['product_id'])) {
            $sql = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $_GET['product_id']);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        }
    }

    public function getProductImageById()
    {
        if (isset($_GET['product_id'])) {
            $sql = "SELECT * FROM product_image WHERE product_id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $_GET['product_id']);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
    }

    public function getProductByCategory()
    {
        if (isset($_GET['category_id']) && isset($_GET['product_id'])) {
            $sql = "SELECT * FROM products WHERE category_id = :category_id AND id != :product_id";
            // var_dump($_GET['category_id']);
            // var_dump($_GET['product_id']);
            // die;

            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':category_id', $_GET['category_id']);
            $stmt->bindParam(':product_id', $_GET['product_id']);

            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
    }
    public function getVaribalById()
    {
        if (isset($_GET['product_id'])) {
            $sql = "SELECT * FROM product_variants WHERE  product_id = :product_id";
            // var_dump($_GET['category_id']);
            // var_dump($_GET['product_id']);
            // die;

            $stmt = $this->db->pdo->prepare($sql);

            $stmt->bindParam(':product_id', $_GET['product_id']);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getRating($productId)
    {
        $sql = "SELECT * FROM product_rating WHERE product_id=:product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function avgRating($productId)
    {
        $sql = "SELECT AVG(rating) as avgRating FROM product_rating WHERE product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return isset($result['avgRating']) ? round($result['avgRating'], 2) : 0;
    }


    public function getComment($productId)
    {
        $sql = "SELECT product_comment.*, users.name, users.image FROM `product_comment` JOIN users on product_comment.
        user_id = users.id WHERE product_comment.product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    public function getCommentByUser($productId, $userId)
    {
        $sql = "SELECT * FROM product_rating WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch();
    }
}
