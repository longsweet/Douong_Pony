<?php
class CategoryUserModel {
    public $db;

    // Khởi tạo đối tượng Database để kết nối với cơ sở dữ liệu
    public function __construct(){
        $this->db = new Database();
    }

    // Lấy tất cả danh mục từ cơ sở dữ liệu
    public function allCategory(){
        $sql = "SELECT * FROM categories";
        $query = $this->db->pdo->query($sql);
        return $query->fetchAll(); // Trả về tất cả các danh mục
    }

    // Lấy tất cả danh mục dưới dạng đối tượng
    public function getCategoryDashboard() {
        $sql = "SELECT * FROM categories";
        $query = $this->db->pdo->query($sql);
        return $query->fetchAll(PDO::FETCH_OBJ); // Trả về dạng đối tượng
    }

    // Lấy danh mục theo ID
    public function getCategoryById($id){
        $sql = "SELECT * FROM categories WHERE id=:id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(); // Trả về danh mục theo ID
    }

    // Lấy danh mục ngẫu nhiên (mặc định 4 danh mục)
    public function randomCategories($limit = 4)
    {
        $sql = "SELECT * FROM categories ORDER BY RAND() LIMIT :limit";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh mục ngẫu nhiên
    }

    // Lấy danh mục với số lượng giới hạn
    public function all4($limit = 4)
    {
        $sql = "SELECT * FROM categories LIMIT :limit";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh mục theo giới hạn
    }

    // Tìm sản phẩm theo tên
    public function searchByName($keyword)
    {
        $sql = "SELECT * FROM products WHERE name LIKE :keyword";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về sản phẩm tìm thấy
    }
}
?>
