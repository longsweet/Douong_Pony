<?= include 'App/Views/Admin/layouts/header.php' ?>
<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Danh sách sản phẩm</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="<?= BASE_URL_ADMIN  ?>act=category">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                </ul>
            </div>
            <!-- product-list -->
            <div class="wg-box">
                <div class="title-box">
                    <i class="icon-coffee"></i>
                    <div class="body-text">
                        Mẹo tìm kiếm theo ID sản phẩm: Mỗi sản phẩm được cung cấp một ID duy nhất, bạn có thể dựa vào đó để tìm chính xác sản phẩm mình cần.</div>
                </div>
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <div class="show">
                            <div class="text-tiny">Đang hiển thị</div>
                            <div class="select">
                                <select class="">
                                    <option>10</option>
                                    <option>20</option>
                                    <option>30</option>
                                </select>
                            </div>
                            <div class="text-tiny">Mục</div>
                        </div>
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="<?= BASE_URL ?>?role=admin&act=add-product"><i class="icon-plus"></i>Thêm mới</a>
                </div>

                <!--  thêm spsp -->
                <div class="wg-table table-product-list">
                    <ul class="table-title flex gap20 mb-14">
                        <li>
                            <div class="body-title">Sản phẩm</div>
                        </li>
                        <li>
                            <div class="body-title">ID sản phẩm</div>
                        </li>
                        <li>
                            <div class="body-title">Giá</div>
                        </li>
                        <li>
                            <div class="body-title">Số lượng</div>
                        </li>
                        <li>
                            <div class="body-title">Doanh thu</div>
                        </li>
                        <li>
                            <div class="body-title">Cổ phần</div>
                        </li>
                        <li>
                            <div class="body-title"> Ngày bắt đầu</div>
                        </li>
                        <li>
                            <div class="body-title">Hành động</div>
                        </li>
                    </ul>

                    <!--  mịa -->
                    <ul class="flex flex-column">
                        <?php foreach ($listProduct as $key => $value): ?>
                            <li class="wg-product item-row gap20">
                                <div class="body-text text-main-dark mt-4"><?= $key + 1 ?></div>
                                <div class="body-text text-main-dark mt-4"><?= $value->name ?></div>
                                <div class="body-text text-main-dark mt-4">
                                    <img src="<?= $value->image_main ?>" alt="" width="50">
                                </div>
                                <div class="body-text text-main-dark mt-4"></div>
                                <div class="body-text text-main-dark mt-4">
                                    <?= number_format($value->price) ?> VNĐ
                                    <?php
                                    if ($value->price_sale != null) {
                                        echo "-" . "<p style='color:red;'>" .  number_format($value->price_sale) . "VNĐ" . "</p>";
                                    }
                                    ?>
                                </div>
                                <div class="body-text text-main-dark mt-4">
                                    <?= $value->stock ?>
                                </div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <a href="<?= BASE_URL ?>?role=admin&act=show-product&id=<?= $value->id ?>">
                                            <i class="icon-eye" style="color: orange;"></i>
                                        </a>
                                    </div>
                                    <div class="item edit">
                                        <a href="<?= BASE_URL ?>?role=admin&act=update-product&id=<?= $value->id ?>">
                                            <i class="icon-edit-3" style="color: green;"></i>
                                        </a>
                                    </div>
                                    <div class="item trash">
                                        <a
                                            onclick="return confirm('Bạn có muốn xóa không?')"
                                            href="<?= BASE_URL ?>?role=admin&act=delete-product&id=<?= $value->id ?>">
                                            <i class="icon-trash-2" style="color: red;"></i>
                                        </a>
                                    </div>
                                </div>

                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- products gitgit-->
                </div>


                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">Hiển thị 10 mục kế tiếp</div>
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
            <!-- /product-list -->
        </div>
        <!-- /main-content-wrap -->
    </div>
    <!-- /main-content-wrap -->
    <!-- bottom-page -->
    <?= include 'App/Views/Admin/layouts/footer.php' ?>