<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
  <meta charset="utf-8">
  <title>MHT Tea - Ultimate Admin Dashboard</title>
  <meta name="author" content="themesflat.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" type="text/css" href="assets/Admin/css/animate.min.css">
  <link rel="stylesheet" type="text/css" href="assets/Admin/css/animation.css">
  <link rel="stylesheet" type="text/css" href="assets/Admin/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/Admin/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="assets/Admin/css/styles.css">
  <link rel="stylesheet" href="assets/Admin/font/fonts.css">
  <link rel="stylesheet" href="assets/Admin/icon/style.css">
  <link rel="shortcut icon" href="assets/Admin/images/logomain_preview_rev.png">
  <link rel="apple-touch-icon-precomposed" href="assets/Admin/images/logomain_preview_rev.png">
</head>

<body>
  <div id="wrapper">
    <div id="page" class="">
      <div class="layout-wrap">
        <div class="section-content-right">
          <div class="main-content">
            <div class="main-content-inner">
              <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                  <h3>Sửa sản phẩm</h3>
                </div>
                <div class="wg-box">
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
                      <div class="mb-5">


                        <input type="hidden" name="product_id" value="<?= $product->id ?>">



                        <div class="mb-5">
                          <label>Kích thước</label>
                          <select name="size" class="form-control" required>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                          </select>
                        </div>





                      </div>


                    </div>

                </div>
                <hr>
                <div class="cols gap10">
                  <button class="tf-button w380" type="submit">Lưu lại</button>
                  <a href="<?= BASE_URL ?>?role=admin&act=all-product" class="tf-button style-3 w380" type="submit">Hủy bỏ</a>
                </div>



                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script>
    $("#add-variant").click(function() {
      $("#variants-container").append(`
        <div class="variant-item">
          <input type="text" name="variant_name[]" placeholder="Tên biến thể" class="form-control">
          <input type="text" name="variant_price[]" placeholder="Giá" class="form-control">
          <input type="text" name="variant_stock[]" placeholder="Số lượng" class="form-control">
          <button type="button" class="btn-sm btn btn-danger btn-delete-variant">Xóa</button>
        </div>
      `);
    });
    $("#variants-container").on("click", ".btn-delete-variant", function() {
      $(this).parent().remove();
    });
  </script>
</body>

</html>