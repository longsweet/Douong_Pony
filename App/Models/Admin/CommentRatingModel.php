<?php

class CommentRatingModel
{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function avgRating($productId)
    {
        $sql = "SELECT avg(rating) as avgRating FROM `product_rating` WHERE product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();

        return $stmt->fetch()->avgRating;
    }

    public function countComment($productId)
    {
        $sql = "SELECT count(id) as countComment FROM `product_comment` WHERE product_id = :product_id and parent is null";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT); // Đảm bảo kiểu dữ liệu chính xác
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_OBJ); // Lấy kết quả dưới dạng đối tượng
    
        if ($result) {
            return (int) $result->countComment; // Ép kiểu về số nguyên
        } else {
            return 0; // Trả về 0 nếu không có bình luận
        }
    }
    


    public function showCommentDetail(){
        $product_id = $_GET['id'];
        $sql = "SELECT product_comment.*, users.name FROM `product_comment` JOIN users on product_comment.user_id = users.id 
        where product_comment.product_id = :product_id and users.role != 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }


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
            $stmt->bindValue(':parent', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':parent', $commentId, PDO::PARAM_INT);
        }
    
        return $stmt->execute();
    }
    
    public function commentDeleteModel()
    {
        $commentId = $_POST['commentId'];
        $sql = "DELETE FROM product_comment where id=:id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $commentId);
        $stmt->execute();

        $sql = "DELETE FROM product_comment where parent=:id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $commentId);
        return $stmt->execute();
    }


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
