<?php

class CommentRatingModel
{
    public $db;

    public function __construct()
    {
        $this->db = new Database(); // Khởi tạo kết nối CSDL
    }

    // Tính trung bình số sao (rating) của sản phẩm
    public function avgRating($productId)
    {
        $sql = "SELECT avg(rating) as avgRating FROM `product_rating` WHERE product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetch()->avgRating; // Trả về điểm trung bình
    }

    // Đếm số lượng comment cha (không phải reply)
    public function countComment($productId)
    {
        $sql = "SELECT count(id) as countComment FROM `product_comment` WHERE product_id = :product_id and parent is null";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? (int) $result->countComment : 0;
    }

    // Lấy tất cả bình luận của sản phẩm (bao gồm tên người dùng) – loại trừ admin
    public function showCommentDetail()
    {
        $product_id = $_GET['id']; // ⚠ Nên tránh dùng trực tiếp $_GET ở trong model
        $sql = "SELECT product_comment.*, users.name 
                FROM `product_comment` 
                JOIN users on product_comment.user_id = users.id 
                WHERE product_comment.product_id = :product_id AND users.role != 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Thêm bình luận hoặc trả lời bình luận
    public function repComment()
    {
        $productId = $_POST['product-id'];
        $commentId = isset($_POST['comment-id']) && $_POST['comment-id'] !== '' ? (int)$_POST['comment-id'] : null;
        $reply = $_POST['reply'];
        $now = date('Y-m-d H:i:s');

        $sql = "INSERT INTO `product_comment`(`product_id`, `user_id`, `comment`, `created_at`, `parent`) 
                VALUES (:product_id, :user_id, :comment, :created_at, :parent)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $_SESSION['users']['id'], PDO::PARAM_INT);
        $stmt->bindParam(':comment', $reply, PDO::PARAM_STR);
        $stmt->bindParam(':created_at', $now, PDO::PARAM_STR);
        
        if (is_null($commentId)) {
            $stmt->bindValue(':parent', null, PDO::PARAM_NULL); // bình luận gốc
        } else {
            $stmt->bindValue(':parent', $commentId, PDO::PARAM_INT); // reply
        }

        return $stmt->execute();
    }

    // Xoá một comment (cả bình luận và các reply liên quan) – phiên bản 1
    public function commentDeleteModel()
    {
        $commentId = $_POST['commentId'];

        // Xoá bình luận chính
        $sql = "DELETE FROM product_comment WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $commentId);
        $stmt->execute();

        // Xoá các reply (có parent = id của bình luận chính)
        $sql = "DELETE FROM product_comment WHERE parent = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $commentId);
        return $stmt->execute();
    }

    // Xoá một comment – phiên bản 2 (giống với commentDeleteModel) → nên xoá 1 hàm
    public function commentDelete()
    {
        $commentId = $_POST['commentId'];

        $sql =  "DELETE FROM product_comment WHERE id=:id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $commentId);
        $stmt->execute();

        $sql = "DELETE FROM product_comment WHERE parent=:id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $commentId);
        return $stmt->execute();
    }
}
