<?php
class OrderUserModel
{
    public $db;

    // Khởi tạo đối tượng Database để kết nối cơ sở dữ liệu
    public function __construct()
    {
        $this->db = new Database();
    }

    // Đặt hàng và lưu thông tin đơn hàng vào cơ sở dữ liệu
    public function order($products)
    {
        // Lấy thông tin từ form
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $note = $_POST['note'];
        $total = $_POST['total'];
        $user_id = $_SESSION['users']['id'];
        $now = date('Y-m-d H:i:s');
        $status = "pending";  // Trạng thái đơn hàng mặc định là chờ xử lý

        // Thêm đơn hàng vào bảng `order`
        $sql = "INSERT INTO `order` (`user_id`, `status`, `total`, `created_at`, `updated_at`, `name`, `address`, `phone`, `email`, `notes`) 
                VALUES (:user_id, :status, :total, :created_at, :updated_at, :name, :address, :phone, :email, :notes)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':created_at', $now);
        $stmt->bindParam(':updated_at', $now);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':notes', $note);

        // Nếu thành công, thêm chi tiết đơn hàng vào bảng `order_detail`
        if ($stmt->execute()) {
            $orderId = $this->db->pdo->lastInsertId(); // Lấy id đơn hàng vừa thêm
            foreach ($products as $key => $value) {
                $sql = "INSERT INTO `order_detail` (`order_id`, `product_id`, `quantity`, `price`) 
                        VALUES (:order_id, :product_id, :quantity, :price)";
                $stmt = $this->db->pdo->prepare($sql);
                $price_order = $value->price_sale != null ? $value->price_sale : $value->price;
                $stmt->bindParam(':order_id', $orderId);
                $stmt->bindParam(':product_id', $value->product_id);
                $stmt->bindParam(':quantity', $value->quantity);
                $stmt->bindParam(':price', $price_order);
                $stmt->execute();
            }
            return true;  // Trả về true nếu đặt hàng thành công
        } else {
            return false;  // Trả về false nếu có lỗi khi đặt hàng
        }
    }

    // Lấy tất cả các đơn hàng của người dùng
    public function getAllOrder()
    {
        $user_id = $_SESSION['users']['id'];
        $sql = "SELECT * FROM `order` WHERE user_id = :user_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll();  // Trả về tất cả các đơn hàng của người dùng
    }

    // Lấy chi tiết đơn hàng theo order_id
    public function getOrderDetail() {
        $order_id = $_GET['order_id'];
        $sql = "SELECT 
                    order_detail.*, 
                    products.name AS product_name, 
                    products.image_main, 
                    (order_detail.quantity * order_detail.price) AS total,
                    `order`.name AS customer_name,
                    `order`.address,
                    `order`.notes
                FROM order_detail 
                JOIN products ON order_detail.product_id = products.id 
                JOIN `order` ON order_detail.order_id = `order`.id 
                WHERE order_detail.order_id = :order_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);  // Trả về chi tiết đơn hàng
    }

    // Hủy đơn hàng
    public function cancelOrderModel(){
        $order_id = $_GET['order_id'];
        $status = 'canceled';  // Thay đổi trạng thái thành "hủy"
        $sql = "UPDATE `order` SET `status` = :status WHERE id = :order_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':order_id', $order_id);
        return $stmt->execute();  // Trả về true nếu hủy đơn hàng thành công
    }
}
?>
