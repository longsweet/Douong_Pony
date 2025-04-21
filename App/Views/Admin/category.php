<!-- filepath: e:\laragon\www\Douong_Pony\App\Views\Admin\category.php -->
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
                    <!-- Breadcrumbs nếu cần -->
                </ul>
            </div>
            <!-- all-category -->
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
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
                                <div class="body-text text-main-dark mt-4"><?= htmlspecialchars($value->name) ?></div>
                                <div class="list-icon-function">
          
                                    <div class="item edit">
                                        <a
                                            href="<?= BASE_URL ?>?role=admin&act=category-form&id=<?= $value->id ?>">
                                            <i class="icon-edit-3" style="color: blue;"></i>
                                        </a>
                                    </div>
                                    <div class="item show">
                                        <a
                                            href="<?= BASE_URL ?>?role=admin&act=category-show&id=<?= $value->id ?>">
                                            <i class="icon-eye" style="color: green;"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            
        <!-- /main-content-wrap -->
    </div>
    <!-- /main-content-wrap -->
    <!-- bottom-page -->
    <?= include 'App/Views/Admin/layouts/footer.php' ?>