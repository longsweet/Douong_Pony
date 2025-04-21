<?= include 'App/Views/Admin/layouts/header.php' ?>
<!-- main-content -->
<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <?php
            // Đảm bảo thay thế null bằng 'Không có' trước khi sử dụng htmlspecialchars
            $orderHeader = $order[0] ?? null;
            ?>
            <?php if (!$orderHeader): ?>
                <p>Không tìm thấy đơn hàng.</p>
            <?php else: ?>
                <h2>Chỉnh sửa trạng thái đơn hàng #<?= htmlspecialchars($orderHeader->order_id ?? 'Không có') ?></h2>

                <!-- Form chỉnh sửa trạng thái -->
                <form action="?role=admin&act=update-order" method="POST">
                    <input type="hidden" name="order_id" value="<?= htmlspecialchars($orderHeader->order_id ?? 'Không có') ?>">

                    <!-- Trạng thái đơn hàng -->
                    <!-- Dropdown hiển thị 5 trạng thái -->
                    <div>
                        <label>Trạng thái đơn hàng:</label>
                        <?php if ($orderHeader->status === 'completed'): ?>
                            <!-- Hiển thị trạng thái dưới dạng văn bản nếu đã hoàn thành -->
                            <input type="text" value="Hoàn thành" readonly style="border: 1px solid #333; padding: 5px; background-color: #f0f0f0;">
                        <?php else: ?>
                            <!-- Dropdown chỉnh sửa trạng thái nếu chưa hoàn thành -->
                            <select name="status" style="border: 2px solid #333; padding: 5px;">
                                <option value="pending" <?= $orderHeader->status === 'pending' ? 'selected' : '' ?>>Chờ xử lý</option>
                                <option value="canceled" <?= $orderHeader->status === 'canceled' ? 'selected' : '' ?>>Đã hủy</option>
                                <option value="completed" <?= $orderHeader->status === 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                                <option value="in_progress" <?= $orderHeader->status === 'in_progress' ? 'selected' : '' ?>>Đang xử lý</option>
                                <option value="shipped" <?= $orderHeader->status === 'shipped' ? 'selected' : '' ?>>Đã giao hàng</option>
                            </select>
                        <?php endif; ?>
                    </div>

                    <!-- Các trường thông tin khách hàng (không cho phép chỉnh sửa) -->
                    <div>
                        <label>Họ và tên:</label>
                        <input type="text" name="customer_name" value="<?= htmlspecialchars($orderHeader->customer_name ?? 'Không có') ?>" readonly style="border: 1px solid #333; padding: 5px; background-color: #f0f0f0;">
                    </div>
                    <div>
                        <label>Địa chỉ:</label>
                        <input type="text" name="customer_address" value="<?= htmlspecialchars($orderHeader->address ?? 'Không có') ?>" readonly style="border: 1px solid #333; padding: 5px; background-color: #f0f0f0;">
                    </div>
                    <div>
                        <label>Số điện thoại:</label>
                        <input type="text" name="phone" value="<?= htmlspecialchars($orderHeader->phone ?? 'Không có') ?>" readonly style="border: 1px solid #333; padding: 5px; background-color: #f0f0f0;">
                    </div>
                    <div>
                        <label>Email:</label>
                        <input type="text" name="email" value="<?= htmlspecialchars($orderHeader->email ?? 'Không có') ?>" readonly style="border: 1px solid #333; padding: 5px; background-color: #f0f0f0;">
                    </div>

                    <button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none;">Cập nhật trạng thái</button>
                </form>

                <hr>

                <h3>Chi tiết sản phẩm</h3>
                <table border="1" cellpadding="8" cellspacing="0">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Size</th>
                        <th>Toppings</th>
                        <th>Sweetness</th>
                        <th>Ice</th>
                        <th>Tổng</th>
                    </tr>
                    <?php foreach ($order as $item): ?>
                        <?php
                        $price = $item->price;
                        if (isset($item->variant) && $item->variant) {
                            $price = $item->variant->price;
                        }
                        $total = $price * $item->quantity;
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($item->product_name ?? 'Không có') ?></td>
                            <td><img src="<?= htmlspecialchars($item->product_image ?? 'Không có') ?>" width="60"></td>
                            <td><?= number_format($price, 0, ',', '.') ?>đ</td>
                            <td><?= $item->quantity ?></td>
                            <td><?= htmlspecialchars($item->size ?? 'Không có') ?></td>
                            <td><?= htmlspecialchars($item->toppings ?? 'Không có') ?></td>
                            <td><?= htmlspecialchars($item->sweetness ?? 'Không có') ?></td>
                            <td><?= htmlspecialchars($item->ice ?? 'Không có') ?></td>
                            <td><?= number_format($total, 0, ',', '.') ?>đ</td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>

        </div>

        <!-- /order-list -->
    </div>
    <!-- /main-content-wrap -->
</div>
<!-- /main-content-wrap -->
<!-- bottom-page -->
<?= include 'App/Views/Admin/layouts/footer.php' ?>