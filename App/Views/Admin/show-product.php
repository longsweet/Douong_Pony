<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->


<!-- Mirrored from themesflat.co/html/ecomus/admin-ecomus/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2024 14:58:29 GMT -->

<head>
  <!-- Basic Page Needs -->
  <meta charset="utf-8">
  <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
  <title>MHT Tea - Ultimate Admin Dashboard</title>

  <meta name="author" content="themesflat.com">

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Theme Style -->
  <link rel="stylesheet" type="text/css" href="assets/Admin/css/animate.min.css">
  <link rel="stylesheet" type="text/css" href="assets/Admin/css/animation.css">
  <link rel="stylesheet" type="text/css" href="assets/Admin/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/Admin/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="assets/Admin/css/styles.css">



  <!-- Font -->
  <link rel="stylesheet" href="assets/Admin/font/fonts.css">

  <!-- Icon -->
  <link rel="stylesheet" href="assets/Admin/icon/style.css">

  <!-- Favicon and Touch Icons  -->
  <link rel="shortcut icon" href="assets/Admin/images/logomain_preview_rev.png">
  <link rel="apple-touch-icon-precomposed" href="assets/Admin/images/logomain_preview_rev.png">

</head>

<body>

  <!-- #wrapper -->
  <div id="wrapper">
    <!-- #page -->
    <div id="page" class="">
      <!-- layout-wrap -->
      <div class="layout-wrap">
        <!-- preload -->
        <div id="preload" class="preload-container">
          <div class="preloading">
            <span></span>
          </div>
        </div>
        <!-- /preload -->
        <!-- section-menu-left -->

        <!-- /section-menu-left -->
        <!-- section-content-right -->
        <div class="section-content-right">
          <!-- header-dashboard -->

          <!-- /header-dashboard -->
          <!-- main-content -->
          <div class="main-content">
            <!-- main-content-wrap -->
            <div class="main-content-inner">
              <!-- main-content-wrap -->
              <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                  <h3>Chi tiết sản phẩm</h3>
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
                      <a href="<?= BASE_URL ?>?role=admin&act=all-product">
                        <div class="text-tiny">Sản phẩm</div>
                      </a>
                    </li>
                    <li>
                      <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                      <div class="text-tiny">Chi tiết sản phẩm</div>
                    </li>
                  </ul>
                </div>

                <div class="wg-box">
                  <form action="<?= BASE_URL ?>?role=admin&act=update-post-product&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-5">
                      <div class="body-title mb-10">Tiêu đề sản phẩm <span class="tf-color-1">*</span></div>
                      <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="<?= $product->name ?>" readonly>
                    </div>
                    <div class="mb-5">
                      <div class="body-title mb-10">Danh mục <span class="tf-color-1">*</span></div>
                      <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                        class="form-control" value="<?= $product->category_id ?>" readonly>
                    </div>
                    <div class="mb-5">
                      <div class="body-title mb-10">Giá <span class="tf-color-1">*</span></div>
                      <input type="text" name="price" id="price" placeholder="price" class="form-control" value="<?= $product->price ?>" readonly>
                    </div>
                    <div class="mb-5">
                      <div class="body-title mb-10">Giá bán <span class="tf-color-1">*</span></div>
                      <input type="text" name="pricesale" id="price-sale" placeholder="Price sale" class="form-control" value="<?= $product->price_sale ?>" readonly>
                    </div>
                    <div class="mb-5">
                      <div class="body-title mb-10">Số lượng <span class="tf-color-1">*</span></div>
                      <input type="text" name="stock" id="stock" placeholder="Số lượng" class="form-control" value="<?= $product->stock ?>" readonly>
                    </div>
                    <div class="mb-5">
                      <div class="body-title mb-10">Hình ảnh <span class="tf-color-1">*</span></div>
                      <img src="<?= $product->image_main ?>" alt="" width="50">

                    </div>
                    <div class="mb-5">
                      <label>Kích thước</label>
                      <select name="size" class="form-control" required>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                      </select>
                    </div>
                    <div class="mb-5">
                      <div class="body-title mb-10">Mô tả <span class="tf-color-1">*</span></div>
                      <textarea class="mb-10" name="description" id="description" placeholder="Mô tả ngắn gọn về sản phẩm" tabindex="0" aria-required="true" required="" class="form-control" readonly><?= $product->description ?></textarea>
                    </div>
                    <div class="mb-5">
                      <div class="body-title mb-10">Danh sách ảnh <span class="tf-color-1">*</span></div>

                      <div class="block-image">

                      </div>
                    </div>
                    <hr>

                    <div class="cols gap10">

                      <a href="<?= BASE_URL ?>?role=admin&act=all-product" class="tf-button style-3 w380" type="submit">Trở về</a>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /main-content-wrap -->
            </div>
            <!-- /main-content-wrap -->
            <!-- bottom-page -->

            <!-- /bottom-page -->
          </div>
          <!-- /main-content -->
        </div>
        <!-- /section-content-right -->
      </div>
      <!-- /layout-wrap -->
    </div>
    <!-- /#page -->
  </div>
  <!-- /#wrapper -->

  <!-- Javascript -->
  <script src="assets/Admin/js/jquery.min.js"></script>
  <script src="assets/Admin/js/bootstrap.min.js"></script>
  <script src="assets/Admin/js/bootstrap-select.min.js"></script>
  <script src="assets/Admin/js/zoom.js"></script>
  <script src="assets/Admin/js/morris.min.js"></script>
  <script src="assets/Admin/js/raphael.min.js"></script>
  <script src="assets/Admin/js/morris.js"></script>
  <script src="assets/Admin/js/jvectormap.min.js"></script>
  <script src="assets/Admin/js/jvectormap-us-lcc.js"></script>
  <script src="assets/Admin/js/jvectormap-data.js"></script>
  <script src="assets/Admin/js/jvectormap.js"></script>
  <script src="assets/Admin/js/apexcharts/apexcharts.js"></script>
  <script src="assets/Admin/js/apexcharts/line-chart-1.js"></script>
  <script src="assets/Admin/js/apexcharts/line-chart-2.js"></script>
  <script src="assets/Admin/js/apexcharts/line-chart-3.js"></script>
  <script src="assets/Admin/js/apexcharts/line-chart-4.js"></script>
  <script src="assets/Admin/js/apexcharts/line-chart-5.js"></script>
  <script src="assets/Admin/js/apexcharts/line-chart-6.js"></script>
  <script src="assets/Admin/js/apexcharts/line-chart-7.js"></script>
  <script src="assets/Admin/js/switcher.js"></script>
  <script defer src="assets/Admin/js/theme-settings.js"></script>
  <script src="assets/Admin/js/main.js"></script>

</body>


<!-- Mirrored from themesflat.co/html/ecomus/admin-ecomus/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2024 14:58:54 GMT -->

</html>