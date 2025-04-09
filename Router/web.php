<?php


$role = isset($_GET['role']) ? $_GET['role'] : "user";

$act = isset($_GET['act']) ? $_GET['act'] : "";

if ($role == "user") {

    switch ($act) {

        case '': {
                (new DashboardController)->dashboard();
                break;
            }
        case 'shop': {
                (new DashboardController)->showShop();
                break;
            }

        case 'login': {
                (new LoginUserController)->login();
                break;
            }

        case 'post-login': {
                (new LoginUserController)->postLogin();
                break;
            }

        case 'logout': {
                (new LoginUserController)->logout();
                break;
            }

        case 'register': {
                (new LoginUserController)->register();
                break;
            }
        case 'post-register': {
                (new LoginUserController)->postRegister();
                break;
            }
        case 'product-detail': {
                $DashboardController = new DashboardController();
                $DashboardController->productDetail();
                break;
            }

        case 'formqmk': {
                (new LoginUserController)->showForgotPasswordForm();
                break;
            }

        case 'my-account': {
                (new DashboardController)->myAccount();
                break;
            }
        case 'account-detal': {
                (new DashboardController)->accountDetal();
                break;
            }
        case 'account-update': {
                (new DashboardController)->accountUpdate();
                break;
            }

        case 'postQuenMatKhau': {
                (new LoginUserController)->postQuenMatKhau();
                break;
            }
        case 'write-review': {
                $dashBoardController = new DashboardController();
                $dashBoardController->writeReview();
                break;
            }

            //categoies

        case 'all-category': {
                (new DashboardController)->allCategory();
                break;
            }

            // giỏ hàng 

        case 'add-to-cart': {
                (new DashboardController)->addToCart();
                break;
            }

        case 'update-cart': {
                (new DashboardController)->updateCart();
                break;
            }

        case 'show-to-cart': {
                (new DashboardController)->showToCart();
                break;
            }

        case 'delete-cart': {
                (new DashboardController)->deleteCartItem();
                break;
            }

        case 'shopping-cart': {
                (new DashboardController)->shoppingCart();
                break;
            }

        case 'check-out': {
                (new DashboardController)->checkout();
                break;
            }

        case 'submit-check-out': {
                (new DashboardController)->submitCheckout();
                break;
            }

        case 'show-order': {
                (new DashboardController)->showOrder();
                break;
            }

        case 'show-order-detail': {
                (new DashboardController)->showOrderDetail();
                break;
            }

            case 'cancel-order'; {
                $dashBoardController = new DashboardController();
                $dashBoardController->cancelOrder();
                break;
            }
    }
} else {

    switch ($act) {

        //?role=admin&act=login-admin Vidu chạychạy
        case 'home': {
                (new HomeController)->long();
                break;
            }

        case 'all-product': {
                $productController = new ProductController();
                $productController->getProductDashboard();
                break;
            }
        case 'add-product': {
                $productController = new ProductController();
                $productController->addProduct();
                break;
            }

        case 'add-post-product': {
                $productController = new ProductController();
                $productController->addPostProduct();
                break;
            }

        case 'delete-product': {
                $productController = new ProductController();
                $productController->deleteProduct();
                break;
            }

        case 'update-product': {
                $productController = new ProductController();
                $productController->updateProduct();
                break;
            }
        case 'update-post-product': {
                $productController = new ProductController();
                $productController->updatePostProduct();
                break;
            }

        case 'show-product': {
                $productController = new ProductController();
                $productController->showProduct();
                break;
            }


        case 'category': { //http://localhost/Douong_Pony/?role=admin&act=long 
                $dashBoardController = new CategoryController();
                $dashBoardController->showAllproduct();

                break;
            }

            // form thêm danh mục
        case 'category-add': {
                (new CategoryController)->addCategory();
                break;
            }
            //dữ liệu để thêm một danh mục
        case 'category-post': {
                (new CategoryController())->PostCategory();
                break;
            }
            // xóa dữ liệu theo idid
        case 'category-delete': {
                (new CategoryController())->deleteCatefory();
                break;
            }
            //hiển thị form sửa sản phẩm
        case 'category-form': {
                (new CategoryController())->formCategory();
                break;
            }
            //Hiển thị chức năng update
        case 'category-update': {
                (new CategoryController)->updateCategory();
                break;
            }

        case 'category-show': {
                (new CategoryController())->ShowCategory();
                break;
            }

            //comment 
        case 'comment-all': {
                $commentRatingController = new CommentRatingController();
                $commentRatingController->showComment();
                break;
            }

        case 'comment-detail': {
                $commentRatingController = new CommentRatingController();
                $commentRatingController->commentDetail();
                break;
            }

        case 'comment-reply': {
                $commentRatingController = new CommentRatingController();
                $commentRatingController->commentReply();
                break;
            }

        case 'comment-delete': {
                $commentRatingController = new CommentRatingController();
                $commentRatingController->commentDelete();
                break;
            }

            //userAdminuserAdmin
        case 'login-admin'; {
                (new LoginController)->loginAdmin();
                break;
            }

        case 'login-post'; {
                (new LoginController)->LoginPost();
                break;
            }

        case 'logout'; {
                (new LoginController)->Logout();
                break;
            }
        case 'user-all'; {
                (new UserController)->UserAll();
                break;
            }

        case 'user-form': {
                (new UserController)->formUser();
                break;
            }

        case 'user-post-add': {
                (new UserController)->userPost();
                break;
            }

        case 'user-show': {
                (new UserController)->showUser();
                break;
            }
        case 'user-form-update': {
                (new UserController)->userUpdateForm();
                break;
            }
        case 'user-post-update': {
                (new UserController)->updatePostUser();
                break;
            }

            // orders 

        case 'orders': {
                (new OrderController())->showAllOrders();
                break;
            }

        case 'order-detail': { // http://localhost/Douong_Pony/?role=admin&act=order-detail
                (new OrderController())->showOrderDetail();
                break;
            }
        case 'edit-order': {
                (new OrderController())->editOrder();
                break;
            }
        case 'update-order': {
                (new OrderController())->updateOrder();
                break;
            }

            // case 'search-product': {
            //         (new ProductController())->searchProduct();
            //         break;
            //     }



            // case 'comment-product'; {
            //         $commentRatingController = new CommentRatingController();
            //         $commentRatingController->showComment();
            //         break;
            //     }



    }
}
