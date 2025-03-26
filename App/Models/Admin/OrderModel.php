<?php

class OrderModel
{

    public $db;
    public $conn;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->pdo;
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

    public function getOrderDetail($orderId)
    {
        $sql = "SELECT 
        o.id AS order_id,
        o.name AS customer_name,  
        o.total, 
        o.status,
        o.created_at,
        p.name AS product_name, 
        p.image_main AS product_image,  
        od.quantity,
        p.price
    FROM `order` o
    LEFT JOIN `order_detail` od ON o.id = od.order_id
    LEFT JOIN `products` p ON od.product_id = p.id
    WHERE o.id = :order_id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOrderDetailById($order_id)
    {
        $sql = "SELECT 
        o.id AS order_id,
        o.customer_name,
        o.status,
        o.created_at,
        o.customer_address,
        o.shipping_method,
        p.name AS product_name,
        p.image_main AS product_image,
        od.quantity,
        od.price,
        (od.quantity * od.price) AS total
    FROM orders o
    JOIN order_detail od ON o.id = od.order_id
    JOIN products p ON od.product_id = p.id
    WHERE o.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
