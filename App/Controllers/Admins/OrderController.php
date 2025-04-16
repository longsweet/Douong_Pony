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
            $_SESSION['error'] = 'ID đơn hàng không hợp lệ.';
            header("Location: ?role=admin&act=order");
            exit();
        }

        $order_id = intval($_GET['id']);
        $orderModel = new OrderModel();
        
        // Lấy thông tin đơn hàng
        $order = $orderModel->getOrderDetailById($order_id);
        if (!$order) {
            $_SESSION['error'] = 'Không tìm thấy đơn hàng.';
            header("Location: ?role=admin&act=order");
            exit();
        }
        
        // Tính tổng tiền sản phẩm
        $orderTotal = 0;
        if (!empty($orderDetail)) {
            $orderTotal = array_sum(array_map(function ($item) use ($orderModel) {
                $variantPrice = $item->price; // Mặc định giá là price từ order_detail

                if (isset($item->product_variants_id) && $item->product_variants_id) {
                    $variant = $orderModel->getProductVariants($item->product_variants_id);
                    if ($variant) {
                        $variantPrice = $variant->price;
                    }
                }
                
                return $item->quantity * $variantPrice;
            }, $orderDetail));
        }

        // Giả định phí ship là 15,000 VNĐ
        $shippingFee = 15000;

        //Lấy ttin bthe
        $orderDetail = $orderModel->getOrderDetail($order_id);
        foreach ($orderDetail as $item) {
            $item->variant = $orderModel->getProductVariants($item->product_variants_id);
        }

        include __DIR__ . '/../../Views/Admin/order-detail.php';
    }

    public function editOrder()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID đơn hàng không hợp lệ.';
            header("Location: ?role=admin&act=order");
            exit();
        }

        $order_id = intval($_GET['id']);
        $orderModel = new OrderModel();
        $order = $orderModel->getOrderDetailById($order_id);

        if (!$order) {
            $_SESSION['error'] = 'Không tìm thấy đơn hàng.';
            header("Location: ?role=admin&act=order");
            exit();
        }

        include __DIR__ . '/../../Views/Admin/edit-order.php';
    }

    public function updateOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['order_id'], $_POST['status'], $_POST['customer_name'], $_POST['customer_address'])) {
                $_SESSION['error'] = 'Thiếu dữ liệu cập nhật đơn hàng.';
                header("Location: ?role=admin&act=order");
                exit();
            }

            $order_id = intval($_POST['order_id']);
            $status = trim($_POST['status']);
            $customer_name = trim($_POST['customer_name']);
            $customer_address = trim($_POST['customer_address']);
            $phone = trim($_POST['phone'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $notes = trim($_POST['notes'] ?? '');

            $orderModel = new OrderModel();
            $success = $orderModel->updateOrder($order_id, $status, $customer_name, $customer_address, $phone, $email, $notes);

            if ($success) {
                $_SESSION['success'] = 'Cập nhật đơn hàng thành công!';
                header("Location: ?role=admin&act=order");
            } else {
                $_SESSION['error'] = 'Cập nhật đơn hàng thất bại, vui lòng thử lại!';
                header("Location: ?role=admin&act=edit-order&id=$order_id");
            }
            exit();
        }
    }
}
