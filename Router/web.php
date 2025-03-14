<?php 

$act = isset($_GET['act']) ? $_GET['act'] : "";

switch($act){
    case ''; {
        $dashBoardController = new DashboardController();
        $dashBoardController->Dashboar();

        break;
    }
}

