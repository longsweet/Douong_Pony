<?php 

class ProductController
{
    public function showAllproduct()
    {
        $productModel =  new  ProductModel();
        $listProduct = $productModel->getProductDashboard();
        include 'App/Views/Admin/products.php';
    }
}