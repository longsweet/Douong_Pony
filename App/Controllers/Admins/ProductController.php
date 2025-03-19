<?php 

class ProductController
{
    public function showAllproduct()
    {
        $productModel =  new  ProductModel();
        $listproduct = $productModel->getProductDashboard();
        include 'App/Views/Admin';
    }
}