<?= include 'App/Views/Admin/layouts/header.php' ?>

<!-- main-content -->
<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Danh sách sản phẩm</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    

                </ul>
            </div>
            <!-- product-list -->
            <div class="wg-box">

                <?php
                if (isset($_SESSION['message'])) {
                    echo "<p>" . $_SESSION['message'] . "</p>";
                    unset($_SESSION['message']);
                }
                ?>

                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <div class="show">
                            <div class="text-tiny">Hiển thị</div>
                            <div class="select">
                                <select class="">
                                    <option>10</option>
                                    <option>20</option>
                                    <option>30</option>
                                </select>
                            </div>
                            <div class="text-tiny">Mục nhập</div>
                        </div>
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Tìm kiếm ở đây" class="" name="name" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="wg-table table-product-list">
                    <ul class="table-title flex gap20 mb-14">
                        <li>
                            <div class="body-title">STT</div>
                        </li>
                        <li>
                            <div class="body-title">Tên sản phẩm</div>
                        </li>
                        <li>
                            <div class="body-title">Ảnh</div>
                        </li>
                        <li>
                            <div class="body-title">Giá</div>
                        </li>
                        <li>
                            <div class="body-title">Giá bán</div>
                        </li>
                        <li>
                            <div class="body-title">Đánh giá trung bình</div>
                        </li>
                        <li>
                            <div class="body-title">Tổng bình luận</div>
                        </li>
                        <li>
                            <div class="body-title">Thao tác</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        <?php foreach ($listProduct as $key => $value): ?>
                            <li class="wg-product item-row gap20">
                                <div class="body-text text-main-dark mt-4"><?= $key + 1 ?></div>
                                <div class="body-text text-main-dark mt-4"><?= $value->name ?></div>
                                <div class="body-text text-main-dark mt-4">
                                    <img src="<?= $value->image_main ?>" alt="" width="100">
                                </div>
                                <div class="body-text text-main-dark mt-4"><?= number_format($value->price) ?> VNĐ</div>
                                <div class="body-text text-main-dark mt-4">
                                    <?php
                                    if ($value->price_sale != null) {
                                        echo "<p style='color:red;'>" .  number_format($value->price_sale) . "VNĐ" . "</p>";
                                    }
                                    ?>
                                </div>
                                <div class="body-text text-main-dark mt-4"><?= $value->avRating ?> <i class="icon icon-star text-warning">Danh Gia</i></div>

                                <div class="body-text text-main-dark mt-4">
    <?= isset($value->countComment) ? $value->countComment : 0 ?>
    <i class="icon-message-square text-primary">SL</i>
</div>


                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <a href="<?= BASE_URL ?>?role=admin&act=comment-detail&id=<?= $value->id ?>">
                                            <i class="icon-eye" style="color: orange;">detail</i>
                                        </a>
                                    </div>
                                </div>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">Hiển thị 10 mục</div>
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
        </div>
    </div>
    <!-- /product-list -->
</div>
<!-- /main-content-wrap -->
</div>
<!-- /main-content-wrap -->
<!-- bottom-page -->
<?= include 'App/Views/Admin/layouts/footer.php' ?>