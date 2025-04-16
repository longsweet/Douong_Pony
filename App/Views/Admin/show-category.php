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
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">danh mục</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Danh sách Danh mục</div>
                    </li>
                </ul>
            </div>
            <!-- product-list -->
            <div class="wg-box">

                <form method="post">
                    <div class="mb-5">
                        <div class="body-title mb-10">Tiêu đề danh mục <span class="tf-color-1">*</span></div>
                        <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                            class="form-control" value="<?= $categories->name ?>" readonly>
                    </div>

                    <hr>

                    <div class="cols gap10">
                        <a href="<?= BASE_URL_ADMIN ?>act=category" class="tf-button style-3 w380" type="submit">Trở về</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /main-content-wrap -->
</div>
<?= include 'App/Views/Admin/layouts/footer.php' ?>