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
        ORDER BY o.created_at DESC";

        $stmt = $this->conn->prepare($sql);
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
            p.price,
            od.size,
od.toppings,
od.sweetness,
od.ice,

            od.product_variants_id
        FROM `order` o
        LEFT JOIN `order_detail` od ON o.id = od.order_id
        LEFT JOIN `products` p ON od.product_id = p.id
        WHERE o.id = :order_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOrderDetailById($order_id)
    {
        $sql = "SELECT 
            o.id AS order_id,
            o.name AS customer_name,
            o.status,
            o.created_at,
            o.address,
            o.phone,
            o.email,
            o.notes,
            p.name AS product_name,
            p.image_main AS product_image,
            od.quantity,
            od.price,
            od.size,
            od.toppings,
            od.sweetness,
            od.ice,
            od.product_variants_id,
            (od.quantity * od.price) AS total
        FROM `order` o
        JOIN `order_detail` od ON o.id = od.order_id
        JOIN `products` p ON od.product_id = p.id
        WHERE o.id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateOrder($order_id, $status, $customer_name, $customer_address, $phone, $email, $notes)
    {
        $sql = "UPDATE `order` 
                SET status = :status, 
                    name = :customer_name, 
                    address = :customer_address, 
                    phone = :phone, 
                    email = :email, 
                    notes = :notes
                WHERE id = :order_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':customer_name', $customer_name, PDO::PARAM_STR);
        $stmt->bindParam(':customer_address', $customer_address, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':notes', $notes, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getProductVariants($product_variants_id)
    {
        if (!$product_variants_id) return null;

        $sql = "SELECT * FROM product_variants WHERE id = :product_variants_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':product_variants_id', $product_variants_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ); // Kiểm tra xem dữ liệu có trả về không
    }   
}
