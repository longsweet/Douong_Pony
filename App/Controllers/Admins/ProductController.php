<?php

class ProductController
{
    // Lấy danh sách sản phẩm từ dashboard
    public function getProductDashboard()
    {
        $productModel =  new  ProductModel();
        $listProduct = $productModel->getProductDashboard();
        include 'App/Views/Admin/products.php'; // Hiển thị danh sách sản phẩm trên giao diện admin
    }

    // Thêm sản phẩm mới (form)
    public function addProduct()  
    {
        $categoryModel = new CategoryModel();
        $listCategory = $categoryModel->allCategory(); // Lấy danh sách các danh mục sản phẩm

        include 'App/Views/Admin/add-product.php'; // Hiển thị form thêm sản phẩm
    }

    // Kiểm tra dữ liệu nhập vào trong form
    public function checkValidate()
    {
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        if ($name != "" && $category != "" && $price != "" && $stock != "") {
            return true;
        } else {
            $_SESSION['error'] = "Bạn nhập thiếu thông tin!"; // Thông báo nếu thiếu thông tin
            return false;
        }
    }

    // Xử lý thêm sản phẩm vào cơ sở dữ liệu
    public function addPostProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$this->checkValidate()) { // Kiểm tra dữ liệu nhập vào
                header("Location: " . BASE_URL . "?role=admin&act=add-product");
                exit;
            }

            // Thêm ảnh chính
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
            $idProduct = $productModel->addProductToDB($destPath); // Thêm sản phẩm vào DB

            if (!$idProduct) {
                $_SESSION['message'] = "Thêm mới không thành công!";
                header("Location: " . BASE_URL . "?role=admin&act=add-product");
                exit;
            }

            // Thêm thư viện ảnh cho sản phẩm
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
                    $productModel->addGararyImage($destPathImage, $idProduct); // Thêm ảnh vào thư viện
                }
            }

            $_SESSION['message'] = "Thêm mới thành công!";
            header("Location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
    }

    // Xóa sản phẩm
    public function deleteProduct()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn sản phẩm cần xóa!";
            header("Location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
        
        $productModel = new ProductModel();
        // Xóa ảnh chính
        $product = $productModel->getProductByID();
        if ($product->image_main != null) {
            if (file_exists($product->image_main)) {
                unlink($product->image_main); // Xóa ảnh chính khỏi thư mục
            }
        }

        // Xóa ảnh trong thư viện ảnh sản phẩm
        $listImage = $productModel->getProductImageByID();
        foreach ($listImage as $key => $value) {
            if ($value->image != null) {
                unlink($value->image); // Xóa ảnh trong thư viện
            }
        }

        $message = $productModel->deleteProductToDB(); // Xóa sản phẩm khỏi DB

        if ($message) {
            $_SESSION['message'] = "Xóa thành công!";
            header("Location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        } else {
            $_SESSION['message'] = "Xóa không thành công!";
            header("Location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
    }

    // Cập nhật thông tin sản phẩm
    public function updateProduct()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn sản phẩm cần sửa!";
            header("Location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }

        $categoryModel = new CategoryModel();
        $listCategory = $categoryModel->allCategory(); // Lấy danh sách các danh mục sản phẩm

        $productModel = new ProductModel();
        $product = $productModel->getProductByID(); // Lấy sản phẩm cần chỉnh sửa
        $listProductImage = $productModel->getProductImageByID(); // Lấy ảnh sản phẩm

        include 'app/Views/Admin/update-product.php'; // Hiển thị form cập nhật sản phẩm
    }

    // Xử lý cập nhật sản phẩm
    public function updatePostProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_GET['id'])) {
                $_SESSION['message'] = "Vui lòng chọn sản phẩm cần sửa!";
                header("Location: " . BASE_URL . "?role=admin&act=all-product");
                exit;
            }

            if (!$this->checkValidate()) { // Kiểm tra dữ liệu đầu vào
                header("Location: " . BASE_URL . "?role=admin&act=update-product&id=" . $_GET['id']);
                exit;
            }

            $productModel = new ProductModel();
            $product = $productModel->getProductByID();
            // Xử lý ảnh chính
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
                    unlink($product->image_main); // Xóa ảnh cũ
                }
            }

            $message = $productModel->updateProductToDB($destPath); // Cập nhật thông tin sản phẩm

            if (!$message) {
                $_SESSION['message'] = "Sửa không thành công!";
                header("Location: " . BASE_URL . "?role=admin&act=update-product&id=" . $_GET['id']);
                exit;
            }

            // Xử lý thư viện ảnh
            if (isset($_FILES['image']) && count($_FILES['image']) > 0) {
                $listImage = $productModel->getProductImageByID();
                foreach ($listImage as $key => $value) {
                    if ($value->image != null) {
                        unlink($value->image); // Xóa ảnh cũ trong thư viện
                    }
                }
                $productModel->deleteImageGarary(); // Xóa ảnh trong thư viện trước khi thêm mới
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
                    $productModel->addGararyImage($destPathImage, $_GET['id']); // Thêm ảnh vào thư viện
                }
            }
            $_SESSION['message'] = "Sửa thành công!";
            header("Location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }
    }

    // Xem chi tiết sản phẩm
    public function showProduct()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn sản phẩm cần xem!";
            header("Location: " . BASE_URL . "?role=admin&act=all-product");
            exit;
        }

        $productModel = new ProductModel();
        $product = $productModel->getProductByID(); // Lấy thông tin sản phẩm theo ID

        include 'App/Views/Admin/show-product.php'; // Hiển thị chi tiết sản phẩm
    }
}
?>
