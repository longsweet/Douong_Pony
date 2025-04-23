<?php

class CategoryModel
{
    public $db;

    // Constructor: Khởi tạo đối tượng Database khi tạo CategoryModel
    public function __construct()
    {
        $this->db = new Database();
    }

    // Lấy tất cả danh mục từ bảng `categories`
    public function allCategory()
    {
        $sql = "SELECT * FROM categories";
        $query = $this->db->pdo->query($sql);
        return $query->fetchAll(); // Trả về mảng danh mục
    }

    // Thêm danh mục mới vào CSDL
    public function addCategory()
    {
        $name = $_POST['name']; // Lấy tên danh mục từ form
        $sql = "INSERT INTO categories(name) VALUES (:name)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        return $stmt->execute(); // Trả về true nếu thêm thành công
    }

    // Xóa danh mục theo ID
    public function deleteCategoty() // => typo trong tên hàm, nên là `deleteCategory`
    {
        $id = $_GET['id'];
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Lấy thông tin danh mục theo ID (dùng để show lên form edit)
    public function getCategoryByID()
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return $stmt->fetch(); // Trả về 1 dòng thông tin danh mục
        }
        return false;
    }

    // Cập nhật tên danh mục
    public function updateCategoryToDB()
    {
        $id = $_GET['id'];
        $name = $_POST['name'];

        $sql = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);

        return $stmt->execute(); // Trả về true nếu cập nhật thành công
    }
}
