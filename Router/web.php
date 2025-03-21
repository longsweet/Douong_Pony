<?php 

$act = isset($_GET['act']) ? $_GET['act'] : "";

switch($act){


    case ''; {
        $dashBoardController = new CategoryController();
        $dashBoardController->showAllproduct();

        break;
    }

    case 'long'; {
        $dashBoardController = new ProductController();
        $dashBoardController->showAllproduct();

        break;
    }

}

