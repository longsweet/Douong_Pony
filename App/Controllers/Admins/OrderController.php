<?php

class OrderController
{
    // Hiển thị danh sách tất cả các đơn hàng
    public function showAllOrders()
    {
        $orderModel = new OrderModel();
        // Lấy tất cả đơn hàng từ OrderModel
        $orders = $orderModel->getAllOrders();
        // Hiển thị danh sách đơn hàng trên giao diện admin
        include 'App/Views/Admin/orders.php';
    }

    // Hiển thị chi tiết một đơn hàng
    public function showOrderDetail()
    {
        // Kiểm tra nếu id không hợp lệ hoặc không tồn tại
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID đơn hàng không hợp lệ.';
            header("Location: ?role=admin&act=orders");
            exit();
        }

        $order_id = intval($_GET['id']);
        $orderModel = new OrderModel();

        // Lấy thông tin chi tiết đơn hàng
        $order = $orderModel->getOrderDetailById($order_id);
        if (!$order) {
            $_SESSION['error'] = 'Không tìm thấy đơn hàng.';
            header("Location: ?role=admin&act=orders");
            exit();
        }

        // Lấy chi tiết các sản phẩm trong đơn hàng
        $orderDetail = $orderModel->getOrderDetail($order_id);
        foreach ($orderDetail as $item) {
            // Lấy thông tin các biến thể sản phẩm (nếu có)
            $item->variant = $orderModel->getProductVariants($item->product_variants_id);
        }

        // Tính tổng giá trị đơn hàng
        $orderTotal = 0;
        if (!empty($orderDetail)) {
            $orderTotal = array_sum(array_map(function ($item) {
                $price = $item->price; // Giá mặc định là giá trong order_detail
                if (isset($item->variant) && $item->variant) {
                    $price = $item->variant->price; // Nếu có biến thể, dùng giá của biến thể
                }
                return $item->quantity * $price;
            }, $orderDetail));
        }

        // Giả sử phí vận chuyển là 15,000 VNĐ
        $shippingFee = 15000;

        // Hiển thị chi tiết đơn hàng
        include __DIR__ . '/../../Views/Admin/order-detail.php';
    }

    // Chỉnh sửa thông tin đơn hàng
    public function editOrder()
    {
        // Kiểm tra nếu id đơn hàng không hợp lệ
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID đơn hàng không hợp lệ.';
            header("Location: ?role=admin&act=orders");
            exit();
        }

        $order_id = intval($_GET['id']);
        $orderModel = new OrderModel();
        // Lấy thông tin chi tiết đơn hàng để chỉnh sửa
        $order = $orderModel->getOrderDetailById($order_id);

        if (!$order) {
            $_SESSION['error'] = 'Không tìm thấy đơn hàng.';
            header("Location: ?role=admin&act=orders");
            exit();
        }

        // Hiển thị form chỉnh sửa đơn hàng
        include __DIR__ . '/../../Views/Admin/edit-order.php';
    }

    // Cập nhật trạng thái đơn hàng
    public function updateOrder()
    {
        // Kiểm tra nếu có dữ liệu POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['order_id'], $_POST['status'])) {
                $_SESSION['error'] = 'Thiếu dữ liệu cập nhật đơn hàng.';
                header("Location: ?role=admin&act=orders");
                exit();
            }

            $order_id = intval($_POST['order_id']);
            $status = trim($_POST['status']);
            $orderModel = new OrderModel();
            // Cập nhật trạng thái đơn hàng
            $success = $orderModel->updateOrderStatus($order_id, $status);

            if ($success) {
                $_SESSION['success'] = 'Cập nhật trạng thái đơn hàng thành công!';
                header("Location: ?role=admin&act=orders");
            } else {
                $_SESSION['error'] = 'Cập nhật đơn hàng thất bại, vui lòng thử lại!';
                header("Location: ?role=admin&act=edit-order&id=$order_id");
            }
            exit();
        }
    }
}
