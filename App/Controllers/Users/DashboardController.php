<?php

class DashboardController
{
    public function dashboard()
    {
        // Khởi tạo mô hình danh mục
        $categoryModel = new CategoryUserModel();
        $listCategory = $categoryModel->getCategoryDashboard();

        // Khởi tạo mô hình sản phẩm
        $productModel = new ProductUserModel(); // Thực tế nên gọi vào ProductUserModel
        $listProduct = $productModel->getProductDashboard();

        // Lấy từ khóa tìm kiếm từ GET request
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $products = [];

        // Nếu từ khóa không rỗng, tìm kiếm sản phẩm theo từ khóa
        if ($keyword !== '') {
            $products = $categoryModel->searchByName($keyword);
        }

        // Debug để kiểm tra dữ liệu có trả về không
        if (empty($listCategory)) {
            die("Lỗi: Không có danh mục nào trong database!");
        }
        // Bao gồm view để hiển thị
        include 'App/Views/Users/index.php';
    }






    public function showShop()
    {
        $productModel = new ProductUserModel();
        $listProduct = $productModel->getDataShop();


        $categoryModel = new CategoryUserModel();
        if (isset($_GET['category_id'])) {
            $category = $categoryModel->getCategoryByID($_GET['category_id']);
        }
        $listCategory = $categoryModel->getCategoryDashboard();
        $stock = $productModel->getProductStock();

        if (isset($_GET['instock'])) {
            $listProduct = array_filter($listProduct, function ($product) {
                return $product->stock > 0;
            });
        }

        if (isset($_GET['outstock'])) {
            $listProduct = array_filter($listProduct, function ($product) {
                return $product->stock == 0;
            });
        }

        if (isset($_GET['min'])) {
            $listProduct = array_filter($listProduct, function ($product) {
                if ($product->price_sale != null) {
                    return $product->price_sale > $_GET['min'];
                }
                return $product->price > $_GET['min'];
            });
        }

        if (isset($_GET['max'])) {
            $listProduct = array_filter($listProduct, function ($product) {
                if ($product->price_sale != null) {
                    return $product->price_sale < $_GET['max'];
                }
                return $product->price < $_GET['max'];
            });
        }

        if (isset($_GET['product-name'])) {
            $listProduct = $productModel->getDataShopName();
        }

        include 'App/Views/Users/shop.php';
    }

    public function myAccount()
    {
        include 'App/Views/Users/myaccount.php';
    }

    public function accountDetal()
    {
        $user = (new LoginModel())->getCurrenUser();

        // if (!$user) {
        //     // Xử lý trường hợp chưa đăng nhập, ví dụ:
        //     header("    BASE_URL.?act=login    ");
        //     exit;
        // }

        include 'App/Views/Users/account-detal.php';
    }

    public function changePassword()
    {
        if (
            $_POST['current-password'] != "" &&
            $_POST['new-password'] != "" &&
            $_POST['confirm-password'] != "" &&
            $_POST['new-password'] == $_POST['confirm-password']
        ) {
            $userModel = (new LoginModel())->changePassword();
        }
    }

    public function accountUpdate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->changePassword();
            $user = (new LoginModel())->getCurrenUser();

            //Them anh
            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = $user->image;

            if (!empty($_FILES['image']['name'])) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileType = mime_content_type($fileTmpPath);
                $fileName = basename($_FILES['image']['name']);
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $newFileName = uniqid() . '.' . $fileExtension;
                if (in_array($fileType, $allowedTypes)) {
                    $destPath = $uploadDir . $newFileName;
                    if (!move_uploaded_file($fileTmpPath, $destPath)) {
                        $destPath = "";
                    }
                    //xóa ảnh cũ
                    unlink($user->image);
                }
            }

            $message = (new LoginModel())->updateCurrentUser($destPath);


            if ($message) {
                $_SESSION['message'] = "Cập nhật thành công!";
                header("Location: " . BASE_URL . "?act=account-detal");
                exit;
            } else {
                $_SESSION['message'] = "Cập nhật không thành công!";
                header("Location: " . BASE_URL . "?act=account-detal");
                exit;
            }
        }
    }


    public function productDetail()
    {
        $productModel = new ProductUserModel();
        $product = $productModel->getProductById();
        $variable = $productModel->getVaribalById(); // SỬA Ở ĐÂY
        $productImage = $productModel->getProductImageById();


        if (isset($_GET['category_id'])) {
            $category = $productModel->getProductByCategory();
        } else {
            $category = [];
        }

        $comment = $productModel->getComment($product->id);
        foreach ($comment as $key => $value) {
            $rating = $productModel->getCommentByUser($product->id, $value->user_id);
            $comment[$key]->rating = $rating ? $rating->rating : null;
        }

        $ratingProduct = $productModel->getRating($product->id);
        $ratingAvg = $productModel->avgRating($product->id);

        include 'App/Views/Users/product-detail.php';
    }


    public function allCategory()
    {

        $listCategory = (new CategoryUserModel())->allCategory();


        include 'App/Views/Users/all-category.php';
    }

    public function writeReview()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productModel = new ProductUserModel();
            $productModel->saveRating();
            $categoryId = $productModel->saveComment(); // Lấy category_id từ saveComment

            // Kiểm tra và chuyển hướng
            if ($categoryId !== false) {
                $productId = $_POST['productId'];
                header("Location: " . BASE_URL . "?act=product-detail&product_id=" . $productId . "&category_id=" . $categoryId);
                exit();
            } else {
                echo "Không thể lấy được category_id.";
            }
        }
    }

    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartModel = new CartUserModel();
            $cartModel->addCartModel(); // xử lý thêm vào giỏ hàng

            // Chuyển hướng sau khi thêm
            header("Location: " . BASE_URL . "?act=shopping-cart");

            exit;
        } else {
            echo "Truy cập không hợp lệ!";
        }
    }




    public function showToCart()
    {
        $cartModel = new CartUserModel();
        $data = $cartModel->showCartModel();
        echo json_encode($data);
    }
    public function updateCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $model = (new CartUserModel())->updateCartModel();
        }

        header("Location: " . BASE_URL . "?act=shopping-cart"); // quay lại giỏ hàng
        exit;
    }






    public function showCart()
    {
        require_once "./App/Models/User/CartUserModel.php";

        $model = new CartUserModel();
        $data = $model->showCartModel();
        require_once "./App/Views/Users/shopcart.php"; // view hiển thị giỏ hàng
    }

    public function deleteCartItem()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            require_once "./App/Models/User/CartUserModel.php";
            $model = new CartUserModel();
            $model->deleteCartItemModel($id);
        }
        header("Location: " . BASE_URL . "?act=shopcart");
        exit;
    }

    public function shoppingCart()
    {
        $data = (new CartUserModel())->showCartModel();

        include 'App/Views/Users/shopping-cart.php';
    }

    public function checkout()
    {
        $currentUser = (new LoginModel())->getCurrenUser();
        $products = (new CartUserModel())->showCartModel();

        include 'App/Views/Users/check-out.php';
    }

    public function submitCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cartModel = new CartUserModel();
            $products = $cartModel->showCartModel();


            $orderModel = new OrderUserModel();
            $addOrder = $orderModel->order($products);
            if ($addOrder) {
                $cartModel->deleteCartDetail();
                header("Location: " . BASE_URL);
            }
        }
    }

    public function showOrder()
    {

        $orderModel = new OrderUserModel();
        $orders = $orderModel->getAllOrder();

        include 'app/Views/Users/show-order.php';
    }

    public function showOrderDetail()
    {

        $order_detail = (new OrderUserModel())->getOrderDetail();

        include 'App/Views/Users/show-order-detail.php';
    }

    public function cancelOrder()
    {
        $orderModel = new OrderUserModel();
        $orderModel->cancelOrderModel();
        header("location: " . BASE_URL . "?act=show-order");
    }
}
