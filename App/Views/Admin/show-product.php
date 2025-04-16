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
              <div class="text-tiny">Sản phẩm</div>
            </a>
          </li>
          <li>
            <i class="icon-chevron-right"></i>
          </li>
          <li>
            <div class="text-tiny">Danh sách sản phẩm</div>
          </li>
        </ul>
      </div>
      <!-- product-list -->

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
      <!-- /product-list -->
    </div>
    <!-- /main-content-wrap -->
  </div>
  <!-- /main-content-wrap -->
  <!-- bottom-page -->
  <?= include 'App/Views/Admin/layouts/footer.php' ?>