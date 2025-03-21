<?php  

class OrderModel
{

    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllOrder()
    {
        $sql = "select * FROM `order`";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}