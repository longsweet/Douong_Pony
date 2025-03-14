<?php 

class DashboardController
{
    public function Dashboar()
    {
        $products = new ProductUserModel();
        $listProducts = $products->getProductDashboard(); 

        include 'App/Views/home.php';
    }
}