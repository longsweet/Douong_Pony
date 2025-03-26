<?php

class OrderController
{
    public function showAllOrders()
    {
        $orderModel = new OrderModel();
        $orders = $orderModel->getAllOrders();
        include 'App/Views/Admin/orders.php';
    }

    public function showOrderDetail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die('ID đơn hàng không hợp lệ.');
        }
        $order_id = intval($_GET['id']);
    
        $orderModel = new OrderModel();
        $orderDetail = $orderModel->getOrderDetail($order_id);
    
        if (!$orderDetail || empty($orderDetail)) {
            die('Không tìm thấy đơn hàng.');
        }
    
        // Tính tổng tiền đơn hàng (nếu có dữ liệu)
        $orderTotal = 0;
        if (is_array($orderDetail) && count($orderDetail) > 0) {
            $orderTotal = array_sum(array_map(function ($item) {
                return $item->quantity * $item->price;
            }, $orderDetail));
        }
    
        // Giả định phí ship là 15,000 VNĐ
        $shippingFee = 15000;
    
        include __DIR__ . '/../../Views/Admin/order-detail.php';
    }
    
}
