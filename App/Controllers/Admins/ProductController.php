<?php

class ProductController
{
    public function showAllproduct()
    {
        $productModel =  new  ProductModel();
        $listProduct = $productModel->getProductDashboard();
        include 'App/Views/Admin/products.php';
    }
    //Lấy danh sách danh mục
    public function addProduct()
    {
        $categoryModel = new CategoryModel();
        $lisCategory = $categoryModel->allCategory();
        include 'App/Views/Admin/add-product.php';
    }
    //ktra da nhap day du thong tin chua
    public function checkValidate()
    {
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        if ($name != "" && $category != "" && $price != "" && $stock != "") {
            return true;
        } else {
            $_SESSION['error'] = "ban nhap thieu thong tin!";
            return false;
        }
    }
    //Xử lý yêu cầu thêm mới sản phẩm 
    public function addPostProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$this->checkValidate()) {
                header("location:" . BASE_URL . "?role=admin&act=add-product");
                exit;
            } // them anh main
            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = "";
            if (!empty($_FILES['image_main']['name'])) {
                $fileTmpPath = $_FILES['image_main']['tmp_name'];
                $fileType = mime_content_type($fileTmpPath);
                $fileName = basename($_FILES['image_main']['name']);
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $newFileName = uniqid() . '.' . $fileExtension;
                if (in_array($fileType, $allowedTypes)) {
                    $destPath = $uploadDir . $newFileName;
                    if (!move_uploaded_file($fileTmpPath, $destPath)) {
                        $destPath = "";
                    }
                }
            }
            $productModel = new ProductModel();
            $idProduct = $productModel->addProductToDB($destPath);
            if ($idProduct) {
                $_SESSION['message'] = "Thêm mới không thành công!";
                header("location:" . BASE_URL . "?role=admin&act=add-product");
                exit;
            }
            //them thu vien anh
            if (isset($_FILES['image'])) {
                foreach ($_FILES['image']['name'] as $key => $name) {
                    $destPathImage = "";
                    if (!empty($name)) {
                        $fileTmpPath = $_FILES['image']['tmp_name'][$key];
                        $fileType = mime_content_type($fileTmpPath);
                        $fileName = basename($name);
                        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                        $newFileName = uniqid() . '.' . $fileExtension;
                        if (in_array($fileType, $allowedTypes)) {
                            $destPathImage = $uploadDir . $newFileName;
                            if (!move_uploaded_file($fileTmpPath, $destPathImage)) {
                                $destPathImage = "";
                            }
                        }
                    }
                    $productModel->addGararyImage($destPathImage, $idProduct);
                }
            }
            $_SESSION['message'] = "Thêm mới thành công!";
            header("Location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
        $productModel = new ProductModel();
        //xoa anh chinh
        $product = $productModel->getProductByID();
        if ($product->image_main != null) {
            unlink($product->image_main);
            //Nếu người dùng tải lên ảnh mới, ảnh cũ sẽ bị xóa
        }
        //xoa anh trong product_image
        $listImage = $productModel->getProductImageById();
        foreach ($listImage as $key => $value) {
            if ($value->image != null) {
                unlink($value->image);
            }
        }

        $message = $productModel->deleteProductToDB();

        if ($message) {
            $_SESSION['message'] = "xoa thanh cong!";
            header("Location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        } else {
            $_SESSION['message'] = "xoa khong thanh cong!";
            header("Location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
    }
    public function updateProduct()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn sản phẩm cần sửa!";
            header("Location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
        $categoryModel = new CategoryModel();
        $lisCategory = $categoryModel->allCategory();

        $productModel = new ProductModel();
        $product = $productModel->getProductByID();
        $listProductImage = $productModel->getProductImageByID();

        include 'App/Views/Admin/update-product.php';
    }
    public function updatePostProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_GET['id'])) {
                $_SESSION['message'] = "Vui lòng chọn sản phẩm cần sửa!";
                header("Location: " . BASE_URL . "?role=admin&act=all-product");
                exit;
            }

            if (!$this->checkValidate()) {
                header("Location: " . BASE_URL . "?role=admin&act=update-product&id=" . $_GET['id']);
                exit;
            }
            $productModel = new ProductModel();
            $product = $productModel->getProductByID();
            //chỉnh sửa ảnh main
            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = $product->image_main;
            if (!empty($_FILES['image_main']['name'])) {
                $fileTmpPath = $_FILES['image_main']['tmp_name'];
                $fileType = mime_content_type($fileTmpPath);
                $fileName = basename($_FILES['image_main']['name']);
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $newFileName = uniqid() . '.' . $fileExtension;
                if (in_array($fileType, $allowedTypes)) {
                    $destPath = $uploadDir . $newFileName;
                    if (!move_uploaded_file($fileTmpPath, $destPath)) {
                        $destPath = "";
                    }
                    unlink($product->image_main);
                }
            }

            $productModel = new ProductModel();
            $message = $productModel->updateProductToDB($destPath);

            if (!$message) {
                $_SESSION['message'] = "Sửa không thành công!";
                header("Location: " . BASE_URL . "?role=admin&act=update-product&id=" . $_GET['id']);
                exit;
            }

            //Thêm thư viện ảnh
            if (isset($_FILES['image']) && count($_FILES['image']) > 0) {
                $listImage = $productModel->getProductImageByID();
                foreach ($listImage as $key => $value) {
                    if ($value->image != null) {
                        unlink($value->image);
                    }
                }
                $productModel->deleteImageGarary();
                foreach ($_FILES['image']['name'] as $key => $name) {
                    $destPathImage = "";
                    if (!empty($name)) {
                        $fileTmpPath = $_FILES['image']['tmp_name'][$key];
                        $fileType = mime_content_type($fileTmpPath);
                        $fileName = basename($name);
                        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                        $newFileName = uniqid() . '.' . $fileExtension;
                        if (in_array($fileType, $allowedTypes)) {
                            $destPathImage = $uploadDir . $newFileName;
                            if (!move_uploaded_file($fileTmpPath, $destPathImage)) {
                                $destPathImage = "";
                            }
                        }
                    }
                    $productModel->addGararyImage($destPathImage, $_GET['id']);
                }
            }
            $_SESSION['message'] = "Sửa thành công!";
            header("Location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
    }

    public function showProduct()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn sản phẩm cần xem!";
            header("Location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
        $productModel = new ProductModel();
        $product = $productModel->getProductById();

        include 'app/Views/Admin/show-product.php';
    }
}
