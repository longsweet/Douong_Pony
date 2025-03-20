<?php 

$act = isset($_GET['act']) ? $_GET['act'] : "";

switch($act){
    case ''; {
        $dashBoardController = new ProductController();
        $dashBoardController->showAllproduct();

        break;
    }
}

