<?= include 'App/Views/Admin/layouts/header.php' ?>
<!-- main-content -->
<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Danh sách đơn hàng</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Trang chủ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Đơn hàng</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Danh sách đơn hàng</div>
                    </li>
                </ul>
            </div>
            <!-- order-list -->
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="oder-detail.html"><i class="icon-file-text"></i>Xuất tất cả đơn hàng</a>
                </div>
                <div class="wg-table table-all-category">
                    <ul class="table-title flex gap20 mb-14">
                        <li style="width: 120px !important; max-width: 120px !important; min-width: 120px !important; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            <div class="body-title">Khách hàng</div>
                        </li>

                        <li>
                            <div class="body-title">Ảnh</div>
                        </li>
                        <li>
                            <div class="body-title">Sản phẩm</div>
                        </li>
                        <li>
                            <div class="body-title">Tổng tiền</div>
                        </li>
                        <li>
                            <div class="body-title">Số lượng</div>
                        </li>
                        <li>
                            <div class="body-title">Giá từng sản phẩm</div>
                        </li>
                        <li>
                            <div class="body-title">Trạng thái</div>
                        </li>
                        <li>
                            <div class="body-title">Ngày đặt</div>
                        </li>
                        <li>
                            <div class="body-title">Hành động</div>
                        </li>
                    </ul>

                    <ul class="flex flex-column">
                        <?php foreach ($orders as $order): ?>
                            <li class="wg-product item-row gap20">
                                <div class="body-text text-main-dark mt-4"
                                    style="width: 120px !important; max-width: 120px !important; min-width: 120px !important; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <?= htmlspecialchars($order->customer_name) ?>
                                </div>

                                <div class="body-text text-main-dark mt-4">
                                    <img src="<?= htmlspecialchars($order->product_image) ?>" alt="<?= htmlspecialchars($order->product_name) ?>" width="50">
                                </div>
                                <div class="body-text text-main-dark mt-4"><?= htmlspecialchars($order->product_name) ?></div>
                                <div class="body-text text-main-dark mt-4"><?= number_format($order->total, 0, ',', '.') ?> VNĐ</div>
                                <div class="body-text text-main-dark mt-4"><?= htmlspecialchars($order->quantity) ?></div>
                                <div class="body-text text-main-dark mt-4"><?= number_format($order->price, 0, ',', '.') ?> VNĐ</div>
                                <div class="body-text text-main-dark mt-4">
                                    <div class="<?= ($order->status == 'completed') ? 'block-available bg-1 fw-7' : 'block-pending bg-1 fw-7' ?>">
                                        <?= ucfirst($order->status) ?>
                                    </div>
                                </div>
                                <div class="body-text text-main-dark mt-4"><?= date('d/m/Y', strtotime($order->created_at)) ?></div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <a href="?role=admin&act=order-detail&id=<?= $order->order_id ?>">
                                            <i class="icon-eye"></i>
                                        </a>

                                    </div>
                                    <div class="item edit">
                                        <a href="?role=admin&act=edit-order&id=<?= $order->order_id ?>">
                                            <i class="icon-edit-3"></i>
                                        </a>


                                    </div>
                                    <div class="item trash">
                                        <a href="<?= BASE_URL ?>?role=admin&act=delete-order&id=<?= $order->order_id ?>"
                                            onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không?')"
                                            title="Xóa đơn hàng">
                                            <i class="icon-trash-2"></i>
                                        </a>

                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>


                </div>

                </ul>

            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10">
                <div class="text-tiny">Showing 10 entries</div>
                <ul class="wg-pagination">
                    <li>
                        <a href="#"><i class="icon-chevron-left"></i></a>
                    </li>
                    <li>
                        <a href="#">1</a>
                    </li>
                    <li class="active">
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /order-list -->
    </div>
    <!-- /main-content-wrap -->
</div>
<!-- /main-content-wrap -->
<!-- bottom-page -->
<?= include 'App/Views/Admin/layouts/footer.php' ?>