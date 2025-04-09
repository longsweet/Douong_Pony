<?php 

class CartUserModel
{
    public $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function addCartModel()
    {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $userId = $_SESSION['users']['id'];
        $now = date('Y-m-d H:i:s');
    
        // 1. Kiểm tra xem user đã có giỏ hàng chưa
        $sql = 'SELECT * FROM cart WHERE user_id = :user_id';
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $cart = $stmt->fetch(PDO::FETCH_ASSOC); // ✅ Lấy về dạng array
    
        if (!$cart) {
            // 2. Nếu chưa có giỏ hàng thì tạo mới
            $sql = "INSERT INTO `cart`(`user_id`, `created_at`, `updated_at`) VALUES (:user_id, :created_at, :updated_at)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':created_at', $now);
            $stmt->bindParam(':updated_at', $now);
            $stmt->execute();
    
            $cartId = $this->db->pdo->lastInsertId();
        } else {
            // 3. Nếu đã có giỏ hàng thì lấy id
            $cartId = $cart['id']; // ✅ Vì đã fetch dạng array
        }
    
        // 4. Kiểm tra xem sản phẩm đã tồn tại trong cart_detail chưa
        $sql = "SELECT * FROM cart_detail WHERE cart_id = :cart_id AND product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':cart_id', $cartId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        $cartDetail = $stmt->fetch(PDO::FETCH_ASSOC); // ✅ Lấy về dạng array
    
        if ($cartDetail) {
            // 5. Nếu sản phẩm đã tồn tại => tăng số lượng
            $newQuantity = intval($cartDetail['quantity']) + intval($quantity);
    
            $sql = "UPDATE `cart_detail` SET `quantity` = :quantity WHERE id = :cart_detail_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':quantity', $newQuantity);
            $stmt->bindParam(':cart_detail_id', $cartDetail['id']);
            $stmt->execute();
        } else {
            // 6. Nếu chưa tồn tại => thêm mới vào cart_detail
            $sql = "INSERT INTO `cart_detail`(`cart_id`, `product_id`, `quantity`) VALUES (:cart_id, :product_id, :quantity)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':cart_id', $cartId);
            $stmt->bindParam(':product_id', $productId);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->execute();
        }
    
        return true;
    }
    
    
    
    
    

    public function showCartModel() {
        $userId = $_SESSION['users']['id'];
    
        // Lấy giỏ hàng theo user_id
        $sql = "SELECT * FROM cart WHERE user_id = :user_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $cart = $stmt->fetch();
    
        if (!$cart) {
            // Tạo giỏ hàng mới
            $now = date('Y-m-d H:i:s');
            $sql = "INSERT INTO cart (user_id, created_at, updated_at) VALUES (:user_id, :created_at, :updated_at)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':created_at', $now);
            $stmt->bindParam(':updated_at', $now);
            $stmt->execute();
            $cartId = $this->db->pdo->lastInsertId();
        } else {
            $cartId = $cart->id;
        }
    
        // Lấy chi tiết giỏ hàng
        $sql = "SELECT cart_detail.*, products.name, products.image_main, products.price, products.price_sale 
                FROM cart_detail 
                JOIN products ON cart_detail.product_id = products.id  
                WHERE cart_detail.cart_id = :cart_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':cart_id', $cartId);
        $stmt->execute();
    
        return $stmt->fetchAll();
    }
    
    
    public function updateCartModel(){
        $cart_detail_Id = $_POST['cart_detail_id'];
        $action = $_POST['action'];
        switch($action){
            case 'increase': {
                $sql = "UPDATE `cart_detail` SET `quantity`= quantity + 1  WHERE id = :cart_detail_id";
                $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':cart_detail_id', $cart_detail_Id);
            $stmt->execute();
            break;
            }
            case 'decrease': {
                $sql = "UPDATE `cart_detail` SET `quantity`= quantity - 1  WHERE id = :cart_detail_id and quantity > 1";
                $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':cart_detail_id', $cart_detail_Id);
            $stmt->execute();
            break;
            }
            case 'deleted': {
                $sql = "DELETE FROM `cart_detail` WHERE id = :cart_detail_id";
                $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':cart_detail_id', $cart_detail_Id);
            $stmt->execute();
            break;
            }
        }
        return $this->showCartModel();
    }

    public function deleteCartItemModel($id) {
        $sql = "DELETE FROM cart_detail WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteCartDetail(){
        $userId = $_SESSION['users']['id'];
        $sql = "SELECT * FROM `cart` WHERE user_id = :user_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $cart = $stmt->fetch();
            if($cart){
                $sql = "DELETE FROM `cart_detail` WHERE cart_id = :cart_id";
                $stmt = $this->db->pdo->prepare($sql);
                $stmt->bindParam(':cart_id', $cart->id);
                return $stmt->execute();
            }
            return false;
    }
    
}