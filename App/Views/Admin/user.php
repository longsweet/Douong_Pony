<?= include 'App/Views/Admin/layouts/header.php' ?>

<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">

                <h3>Tất cả User & Admin</h3>
            </div>

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
                    <a class="tf-button style-1 w208"
                        href="<?= BASE_URL ?>?role=admin&act=user-form">
                        <i class="icon-plus"></i>Thêm mới</a>
                </div>
                <div class="wg-table table-product-list">
                    <ul class="table-title flex gap20 mb-14">
                        <li>
                            <div class="body-title">STT</div>
                        </li>
                        <li>
                            <div class="body-title">Name</div>
                        </li>
                        <li>
                            <div class="body-title">Image</div>
                        </li>
                        <li>
                            <div class="body-title">Email</div>
                        </li>
                        <li>
                            <div class="body-title">Thao tác</div>
                        </li>
                    </ul>
                    <ul class="flex flex-column">
                        <?php foreach ($listUser as $key => $value): ?>
                            <li class="wg-product item-row gap20">
                                <div class="body-text text-main-dark mt-4"><?= $key + 1 ?></div>
                                <div class="body-text text-main-dark mt-4"><?= $value->name ?></div>
                                <div class="body-text text-main-dark mt-4">
                                    <img src="<?= $value->image ?>" alt="" width="50">
                                </div>
                                <div class="body-text text-main-dark mt-4"><?= $value->email ?></div>
                                <div class="list-icon-function">

                                    <div class="item eye">
                                        <a href="<?= BASE_URL ?>?role=admin&act=user-show&id=<?= $value->id ?>">
                                            <i class="icon-eye" style="color: orange;">show</i>
                                        </a>
                                    </div>
                                    <div class="item edit">
                                        <a href="<?= BASE_URL ?>?role=admin&act=user-form-update&id=<?= $value->id ?>">
                                            <i class="icon-edit-3" style="color: green;">edit</i>
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
    <!-- /main-content-wrap -->
</div>


<?= include 'App/Views/Admin/layouts/footer.php' ?>