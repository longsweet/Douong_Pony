<?php  

class OrderModel
{

    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllOrders()
    {
        $sql = "SELECT 
        o.id AS order_id,
        o.name AS customer_name,  -- Lấy tên khách hàng từ bảng order
        o.total, 
        o.status,
        o.created_at,
        p.name AS product_name, 
        p.image_main AS product_image,  -- Lấy ảnh sản phẩm
        od.quantity,
        p.price
    FROM `order` o
    LEFT JOIN `order_detail` od ON o.id = od.order_id
    LEFT JOIN `products` p ON od.product_id = p.id
    ORDER BY o.created_at DESC";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}