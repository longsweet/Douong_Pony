<?= include 'App/Views/Admin/layouts/header.php' ?>
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
                  <h3>Sửa sản phẩm</h3>
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
                      <div class="text-tiny">Sửa sản phẩm</div>
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

                  <form action="<?= BASE_URL ?>?role=admin&act=update-post-product&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-5">
                      <div class="body-title mb-10">Tiêu đề sản phẩm <span class="tf-color-1">*</span></div>
                      <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="<?= $product->name ?>">
                    </div>
                    <div class="mb-5">
                      <div class="body-title mb-10">Danh mục <span class="tf-color-1">*</span></div>
                      <select name="category" id="category" class="form-control">
                        <?php foreach ($listCategory as $value): ?>
                          <option value="<?= $value->id ?>" <?= ($product->category_id == $value->id) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($value->name) ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    </select>
                </div>
                <div class="mb-5">
                  <div class="body-title mb-10">Giá <span class="tf-color-1">*</span></div>
                  <input type="text" name="price" id="price" placeholder="price" class="form-control" value="<?= $product->price ?>">
                </div>
                <div class="mb-5">
                  <div class="body-title mb-10">Giá bán <span class="tf-color-1">*</span></div>
                  <input type="text" name="price_sale" id="price-sale" placeholder="Price sale" class="form-control" value="<?= $product->price_sale ?>">
                </div>
                <div class="mb-5">
                  <div class="body-title mb-10">Số lượng <span class="tf-color-1">*</span></div>
                  <input type="text" name="stock" id="stock" placeholder="Số lượng" class="form-control" value="<?= $product->stock ?>">
                </div>
                <div class="mb-5">
                  <div class="body-title mb-10">Hình ảnh <span class="tf-color-1">*</span></div>
                  <img src="<?= $product->image_main ?>" alt="" width="50">
                  <input
                    type="file"
                    name="image_main"
                    id="image_main"
                    placeholder="Tải lên hình ảnh"
                    class="form-control"
                    accept="image/*"
                    style="
                                                border: 1px solid #ff7433;
                                                background-color: white;  
                                                border-radius: 5px; 
                                                font-size: 15px; 
                                                cursor: pointer;
                                                transition: background-color 0.3s;
                                                margin-bottom: 15px;
                                            "
                    onmouseover="this.style.backgroundColor='#ff7433'"
                    onmouseout="this.style.backgroundColor='white'">
                </div>
                <div class="mb-5">
                  <div class="body-title mb-10">Mô tả <span class="tf-color-1">*</span></div>
                  <textarea class="mb-10" name="description" id="description" placeholder="Mô tả ngắn gọn về sản phẩm" tabindex="0" aria-required="true" required="" class="form-control" value="<?= $product->description ?>"><?= $product->description ?></textarea>
                  <div class="text-tiny">Không được nhập mô tả sản phẩm quá 1000 ký tự.</div>
                </div>
                <!-- <div class="mb-5">
                      <div class="body-title mb-10">Danh sách ảnh <span class="tf-color-1">*</span></div>
                      <button
                        class="btn-sm btn btn-primary"
                        id="btnAddImage"
                        style="
                                                    background-color: #ff7433; 
                                                    color: white; 
                                                    border: none; 
                                                    padding: 10px 20px; 
                                                    border-radius: 10px; 
                                                    font-size: 16px; 
                                                    cursor: pointer;
                                                    transition: background-color 0.3s;"
                        onmouseover="this.style.backgroundColor='#e56729'"
                        onmouseout="this.style.backgroundColor='#ff7433'">
                        Thêm ảnh
                      </button>
                      <div class="block-image">

                      </div>
                    </div> -->

                <hr>

                <div class="cols gap10">
                  <button class="tf-button w380" type="submit">Lưu lại</button>
                  <a href="<?= BASE_URL ?>?role=admin&act=all-product" class="tf-button style-3 w380" type="submit">Hủy bỏ</a>
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

  <script>
    $(".block-image").empty();

    <?php if (count($listProductImage) > 0): ?>
      let UI = ""
      <?php foreach ($listProductImage as $key => $value): ?>
        UI = `
                    <div class="mt-4 mb-4">
                        <span>Hình ảnh</span><br>
                        <img src="<?= $value->image ?>" alt="anh" width="50">
                        <div class="d-flex">
                            <input type="file" name="image[]" id="" class="form-control" accept="image/*">
                            <button class="btn-sm btn btn-danger btn-delete" >Xóa</button>
                        </div>
                    </div>
                `;
        $(".block-image").append(UI)
      <?php endforeach; ?>
    <?php endif; ?>
    $("#btnAddImage").click(function(e) {
      e.preventDefault();
      let UI = `
                <div class="mt-4 mb-4">
                    <span>Hình ảnh</span>
                    <div class="d-flex">
                        <input type="file" name="image[]" id="" class="form-control" accept="image/*">
                        <button class="btn-sm btn btn-danger btn-delete" >Xóa</button>
                    </div>
                </div>
            `;
      $(".block-image").append(UI)
    })

    $(".block-image").on('click', '.btn-delete', function() {
      $(this).parent().parent().remove()
    })
  </script>

</body>
<?= include 'App/Views/Admin/layouts/footer.php' ?>