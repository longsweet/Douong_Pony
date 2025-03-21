<?php 

class CategoryController
{
    public function showAllproduct()
    {
        $categories =  new  CategoryModel();
        $listProduct = $categories->allCategory();
        include 'App/Views/Admin/category.php';
    }
}