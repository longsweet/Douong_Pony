<?php



$act = isset($_GET['act']) ? $_GET['act'] : "";

switch ($act) {


    case '': {
            (new HomeController)->home();
            break;
        }

    case 'category': { //http://localhost/Douong_Pony/?role=admin&act=long 
            $dashBoardController = new CategoryController();
            $dashBoardController->showAllproduct();

            break;
        }

        // form thêm danh mục
    case 'category-add': {
            $dashBoardController = new CategoryController();
            $dashBoardController->addCategory();

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

    case 'category-show'; {
            (new CategoryController())->ShowCategory();
            break;
        }

        //comment 

    case 'comment-all'; {
            (new CommentRatingController())->showComment();
            break;
        }

    case 'comment-detail'; {
            (new CommentRatingController)->commentDetail();
            break;
        }
    case 'comment-reply'; {
            (new CommentRatingController)->commentReply();
            break;
        }
    case 'comment-delete'; {
            (new CommentRatingController)->commentDelete();
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

    case 'product': {
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

        // case 'comment-product'; {
        //         $commentRatingController = new CommentRatingController();
        //         $commentRatingController->showComment();
        //         break;
        //     }

}
