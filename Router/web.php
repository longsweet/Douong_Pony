<?php

$act = isset($_GET['act']) ? $_GET['act'] : "";

switch ($act) {



    case ''; {
            $dashBoardController = new ProductController();
            $dashBoardController->showAllproduct();

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
    case 'orders'; {
            // http://localhost/Douong_Pony/?role=admin&act=orders
            (new OrderController())->showAllOrders();
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
}
