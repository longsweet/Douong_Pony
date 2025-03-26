<?php

$act = isset($_GET['act']) ? $_GET['act'] : "";

switch ($act) {



    case ''; {
            $dashBoardController = new ProductController();
            $dashBoardController->getProductDashboard();

            break;
        }
        // hiển thị category
    case 'category'; { //http://localhost/Douong_Pony/?role=admin&act=long 
            $dashBoardController = new CategoryController();
            $dashBoardController->showAllproduct();

            break;
        }

        // form thêm danh mục
    case 'category-add'; {
            $dashBoardController = new CategoryController();
            $dashBoardController->addCategory();

            break;
        }
        //dữ liệu để thêm một danh mục
    case 'category-post'; {
            (new CategoryController())->PostCategory();
            break;
        }
        // xóa dữ liệu theo idid
    case 'category-delete'; {
            (new CategoryController())->deleteCatefory();
            break;
        }
        //hiển thị form sửa sản phẩm
    case 'category-form'; {
            (new CategoryController())->formCategory();
            break;
        }
        //Hiển thị chức năng update
    case 'category-update'; {
            (new CategoryController)->updateCategory();
        }
    case 'category-show'; {
            (new CategoryController())->ShowCategory();
        }
    case 'orders'; { // http://localhost/Douong_Pony/?role=admin&act=orders
            (new OrderController())->showAllOrders();
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

    case 'show-product'; {
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
