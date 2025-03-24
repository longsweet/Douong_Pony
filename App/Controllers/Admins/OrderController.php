<?php 

class OrderController
{
    public function showAllOrders()
    {
        $orderModel = new OrderModel();
        $orders = $orderModel->getAllOrders();
        include 'App/Views/Admin/orders.php';
    }
}

?>
