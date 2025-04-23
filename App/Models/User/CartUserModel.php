<?php 

class CartUserModel
{
    public $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Thêm sản phẩm vào giỏ hàng (nếu có thì tăng số lượng, chưa có thì thêm mới)
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
        $cart = $stmt->fetch(PDO::FETCH_ASSOC); // Lấy dữ liệu giỏ hàng nếu đã tồn tại
    
        if (!$cart) {
            // 2. Nếu chưa có giỏ => tạo mới
            $sql = "INSERT INTO cart(user_id, created_at, updated_at) VALUES (:user_id, :created_at, :updated_at)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':created_at', $now);
            $stmt->bindParam(':updated_at', $now);
            $stmt->execute();
            $cartId = $this->db->pdo->lastInsertId();
        } else {
            // 3. Nếu có rồi thì lấy id giỏ hàng
            $cartId = $cart['id'];
        }
    
        // 4. Kiểm tra sản phẩm đã tồn tại trong cart_detail chưa
        $sql = "SELECT * FROM cart_detail WHERE cart_id = :cart_id AND product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':cart_id', $cartId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        $cartDetail = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($cartDetail) {
            // 5. Nếu đã có => tăng số lượng
            $newQuantity = intval($cartDetail['quantity']) + intval($quantity);
            $sql = "UPDATE cart_detail SET quantity = :quantity WHERE id = :cart_detail_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':quantity', $newQuantity);
            $stmt->bindParam(':cart_detail_id', $cartDetail['id']);
            $stmt->execute();
        } else {
            // 6. Nếu chưa có => thêm mới
            $sql = "INSERT INTO cart_detail(cart_id, product_id, quantity) VALUES (:cart_id, :product_id, :quantity)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':cart_id', $cartId);
            $stmt->bindParam(':product_id', $productId);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->execute();
        }

        return true;
    }

    // Lấy chi tiết giỏ hàng của người dùng hiện tại
    public function showCartModel() {
        $userId = $_SESSION['users']['id'];

        // Lấy giỏ hàng hiện tại của user
        $sql = "SELECT * FROM cart WHERE user_id = :user_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $cart = $stmt->fetch();

        if (!$cart) {
            // Nếu chưa có giỏ => tạo mới
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

        // Truy vấn chi tiết giỏ hàng kèm thông tin sản phẩm
        $sql = "SELECT cart_detail.*, products.name, products.image_main, products.price, products.price_sale 
                FROM cart_detail 
                JOIN products ON cart_detail.product_id = products.id  
                WHERE cart_detail.cart_id = :cart_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':cart_id', $cartId);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Cập nhật giỏ hàng: tăng, giảm hoặc xóa sản phẩm
    public function updateCartModel() {
        $cart_detail_Id = $_POST['cart_detail_id'];
        $action = $_POST['action'];

        switch ($action) {
            case 'increase':
                $sql = "UPDATE cart_detail SET quantity = quantity + 1 WHERE id = :cart_detail_id";
                break;
            case 'decrease':
                $sql = "UPDATE cart_detail SET quantity = quantity - 1 WHERE id = :cart_detail_id AND quantity > 1";
                break;
            case 'deleted':
                $sql = "DELETE FROM cart_detail WHERE id = :cart_detail_id";
                break;
        }

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':cart_detail_id', $cart_detail_Id);
        $stmt->execute();

        // Trả về giỏ hàng đã cập nhật
        return $this->showCartModel();
    }

    // Xóa 1 item khỏi giỏ hàng
    public function deleteCartItemModel($id) {
        $sql = "DELETE FROM cart_detail WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Xóa toàn bộ sản phẩm trong giỏ hàng
    public function deleteCartDetail() {
        $userId = $_SESSION['users']['id'];

        // Lấy thông tin giỏ hàng
        $sql = "SELECT * FROM cart WHERE user_id = :user_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $cart = $stmt->fetch();

        // Nếu có thì xóa toàn bộ chi tiết
        if ($cart) {
            $sql = "DELETE FROM cart_detail WHERE cart_id = :cart_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':cart_id', $cart->id);
            return $stmt->execute();
        }

        return false;
    }
}
