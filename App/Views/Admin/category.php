<?= include 'App/Views/Admin/layouts/header.php' ?>
<!-- main-content -->
<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Tất cả danh mục</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">

                </ul>
            </div>
            <!-- all-category -->
            <div class="wg-box">
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
                                <input type="text" placeholder="Tìm kiếm ở đây..." class="" name="name" tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="<?= BASE_URL_ADMIN ?>act=category-add"><i class="icon-plus"></i>Thêm mới</a>
                </div>
                <div class="wg-table table-all-category">
                    <ul class="table-title flex gap20 mb-14">
                        <li>
                            <div class="body-title">STT</div>
                        </li>
                        <li>
                            <div class="body-title">Name</div>
                        </li>
                        <li>
                            <div class="body-title">Thao Tác</div>
                        </li>

                    </ul>
                    <ul class="flex flex-column">
                        <?php foreach ($listProduct as $key => $value) : ?>
                            <li class="wg-product item-row gap20">

                                <div class="body-text text-main-dark mt-4"><?= $key + 1 ?></div>
                                <div class="body-text text-main-dark mt-4"><?= $value->name ?></div>
                                <div class="list-icon-function">
                                    <!-- viết nhầm đường đẫn lên sai mịa nó -->
                                    <div class="item trash">
                                        <a
                                            onclick="return confirm('Bạn có muốn xóa không?')"
                                            href="<?= BASE_URL ?>?role=admin&act=category-delete&id=<?= $value->id ?>">
                                            <i class="icon-trash-2" style="color: red;">xoa</i>
                                        </a>
                                    </div>

                                    <div class="item edit">
                                        <a
                                            href="<?= BASE_URL ?>?role=admin&act=category-form&id=<?= $value->id ?>">
                                            <i class="icon-trash-2" style="color: red;">edit</i>
                                        </a>
                                    </div>

                                    <div class="item show">
                                        <a
                                            href="<?= BASE_URL ?>?role=admin&act=category-show&id=<?= $value->id ?>">
                                            <i class="icon-trash-2" style="color: red;">show</i>
                                        </a>
                                    </div>

                                </div>

                            </li>

                        <?php endforeach; ?>

                    </ul>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">Xem 10 mục kế tiếp</div>
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
            <!-- /all-category -->
        </div>
        <!-- /main-content-wrap -->
    </div>
    <!-- /main-content-wrap -->
    <!-- bottom-page -->
    <?= include 'App/Views/Admin/layouts/footer.php' ?>