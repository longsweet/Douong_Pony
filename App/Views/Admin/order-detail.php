<?php

if (!isset($orderDetail) || empty($orderDetail)) {
    echo "<p>Không có dữ liệu đơn hàng.</p>";
    exit;
}
$orderInfo = $orderDetail[0];
?>

<?= include 'App/Views/Admin/layouts/header.php' ?>
<!-- main-content -->
<div class="main-content">
    <!-- main-content-wrap- inner -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Đơn hàng #<?= isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 'Không xác định' ?></h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li><a href="index.php">
                            <div class="text-tiny">Trang chủ</div>
                        </a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><a href="?role=admin&act=orders">
                            <div class="text-tiny">Đơn hàng</div>
                        </a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <div class="text-tiny">Chi tiết đơn hàng</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="wg-order-detail">
            <div class="left flex-grow">
                <div class="wg-box mb-20">
                    <div class="wg-table table-order-detail">
                        <ul class="table-title flex items-center justify-between gap20 mb-24">
                            <li>
                                <div class="body-title">Tất cả sản phẩm</div>
                            </li>
                        </ul>
                        <ul class="flex flex-column gap10">
                            <?php foreach ($orderDetail as $item): ?>
                                <li class="wg-product flex flex-wrap gap20 p-3 border rounded bg-white shadow-sm">
                                    <!-- Hình ảnh + Tên sản phẩm -->
                                    <div class="flex items-start gap10" style="min-width: 220px; flex: 1;">
                                        <div class="image" style="width: 80px; height: 80px; flex-shrink: 0;">
                                            <img src="<?= htmlspecialchars($item->product_image) ?>" alt="<?= htmlspecialchars($item->product_name) ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                                        </div>
                                        <div>
                                            <div class="text-tiny">Tên sản phẩm</div>
                                            <div class="body-title-2"><?= htmlspecialchars($item->product_name) ?></div>
                                        </div>
                                    </div>

                                    <!-- Số lượng -->
                                    <div style="min-width: 120px;">
                                        <div class="text-tiny">Số lượng</div>
                                        <div class="body-title-2"><?= htmlspecialchars($item->quantity) ?></div>
                                    </div>

                                    <!-- Giá -->
                                    <div style="min-width: 150px;">
                                        <div class="text-tiny">Giá</div>
                                        <div class="body-title-2"><?= number_format($item->price, 0, ',', '.') ?> VNĐ</div>
                                    </div>

                                    <!-- Biến thể -->
                                    <div style="flex: 1; min-width: 200px;">
                                        <div class="text-tiny">Phân loại</div>
                                        <div class="body-text">
                                            <?php if ($item->variant): ?>
                                                <div class="body-title-2">
                                                    <strong>Kích thước:</strong> <?= !empty($item->size) ? htmlspecialchars($item->size) : 'Không có' ?><br>
                                                    <strong>Toppings:</strong> <?= !empty($item->toppings) ? htmlspecialchars($item->toppings) : 'Không có' ?><br>
                                                    <strong>Độ ngọt:</strong> <?= !empty($item->sweetness) ? htmlspecialchars($item->sweetness) : 'Không có' ?><br>
                                                    <strong>Đá:</strong> <?= !empty($item->ice) ? htmlspecialchars($item->ice) : 'Không có' ?><br>
                                                </div>


                                            <?php else: ?>
                                                Sản phẩm này chưa có phân loại
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>


                    </div>
                </div>

                <div class="wg-box">
                    <div class="wg-table table-cart-totals">
                        <ul class="table-title flex mb-24">
                            <li>
                                <div class="body-title">Tổng giỏ hàng</div>
                            </li>
                        </ul>
                        <ul class="flex flex-column gap14">
                            <li class="cart-totals-item">
                                <span class="body-text">Tổng phụ:</span>
                                <span class="body-title-2"><?= number_format($orderTotal ?? 0, 0, ',', '.') ?> VNĐ</span>
                            </li>
                            <li class="divider"></li>
                            <li class="cart-totals-item">
                                <span class="body-text">Vận chuyển:</span>
                                <span class="body-title-2"><?= number_format($shippingFee ?? 0, 0, ',', '.') ?> VNĐ</span>
                            </li>
                            <li class="divider"></li>
                            <li class="cart-totals-item">
                                <span class="body-title">Tổng hóa đơn:</span>
                                <span class="body-title tf-color-1"><?= number_format(($orderTotal ?? 0) + ($shippingFee ?? 0), 0, ',', '.') ?> VNĐ</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="right">
                <div class="wg-box mb-20 gap10">
                    <div class="body-title">Tóm tắt</div>
                    <div class="summary-item">
                        <div class="body-text">ID đơn hàng</div>
                        <div class="body-title-2">#<?= htmlspecialchars($_GET['id']) ?></div>
                    </div>
                    <div class="summary-item">
                        <div class="body-text">Ngày</div>
                        <div class="body-title-2"><?= date('d/m/Y', strtotime($orderDetail[0]->created_at)) ?></div>
                    </div>
                    <div class="summary-item">
                        <div class="body-text">Tổng</div>
                        <div class="body-title-2 tf-color-1"><?= number_format($orderTotal + $shippingFee, 0, ',', '.') ?> VNĐ</div>
                    </div>
                </div>
                <div class="wg-box mb-20 gap10">
                    <div class="body-title">Địa chỉ</div>
                    <div class="body-text"><?= htmlspecialchars($orderDetail[0]->customer_address ?? 'Không có địa chỉ') ?></div>
                </div>
                <div class="wg-box mb-20 gap10">
                    <div class="body-title">Phương thức giao hàng</div>
                    <div class="body-text"><?= htmlspecialchars($orderDetail[0]->shipping_method ?? 'Chưa cập nhật') ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /main-content-wrap-inner -->
</div>
<!-- /main-content -->
<!-- bottom-page -->
<?= include 'App/Views/Admin/layouts/footer.php' ?>