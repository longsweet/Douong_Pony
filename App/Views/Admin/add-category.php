<?= include 'App/Views/Admin/layouts/header.php' ?>

<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Thêm mới danh mục</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="<?= BASE_URL ?>?role=admin&act=home">
                            <div class="text-tiny">Bảng điều khiển</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>?role=admin&act=all-category">
                            <div class="text-tiny">Danh mục</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Thêm danh mục</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <?php
                if (isset($_SESSION['message'])) {
                    echo "<p>" . $_SESSION['message'] . "</p>";
                    unset($_SESSION['message']);
                }
                if (isset($_SESSION['error'])) {
                    echo "<p>" . $_SESSION['error'] . "</p>";
                    unset($_SESSION['error']);
                }
                ?>

                <form action="<?= BASE_URL_ADMIN ?>act=category-post" method="post">
                    <div class="mb-5">
                        <div class="body-title mb-10">Tiêu đề danh mục <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" name="name" id="name" placeholder="Nhập tiêu đề" class="form-control">
                    </div>
                    <hr>
                    <div class="cols gap10">
                        <button class="tf-button w380" type="submit">Thêm danh mục</button>
                        <a href="<?= BASE_URL ?>?role=admin&act=category" class="tf-button style-3 w380" type="submit">Hủy bỏ</a>
                    </div>


                </form>
            </div>
        </div>
        <!-- /main-content-wrap -->
    </div>
    <!-- /main-content-wrap -->
    <!-- bottom-page -->
    <?= include 'App/Views/Admin/layouts/footer.php' ?>