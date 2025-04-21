<?php
class CategoryUserModel {
    public $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function allCategory(){
        $sql = "SELECT * FROM categories";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetchAll();
        return $result;
    }

    public function getCategoryDashboard() {
        $sql = "SELECT * FROM categories ";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetchAll(PDO::FETCH_OBJ); // Trả về object thay vì mảng
        return $result;
    }

    public function getCategoryById($id){
        $sql = "SELECT * FROM categories WHERE id=:id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function randomCategories($limit = 4)
    {
        // Truy vấn lấy 4 danh mục ngẫu nhiên
        $sql = "SELECT * FROM categories ORDER BY RAND() LIMIT :limit";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    
        try {
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC); // Đảm bảo trả về mảng kết hợp (associative array)
    
            // Debug: Kiểm tra dữ liệu trả về
            // echo '<pre>';
            // var_dump($categories); // Kiểm tra xem mảng có dữ liệu không
            // echo '</pre>';
    
            return $categories; // trả về mảng danh mục ngẫu nhiên
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage(); // In lỗi nếu có
        }
    }

    public function all4($limit = 4)
{
    $sql = "SELECT * FROM categories LIMIT :limit";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function searchByName($keyword)
{
    $sql = "SELECT * FROM products WHERE name LIKE :keyword";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




    

    
    
    
    
    
}