<?php

class DashboardController
{
    public function dashboard()
    {
        $categoryModel = new CategoryUserModel();
        $listCategory = $categoryModel->getCategoryDashboard();

        $productModel = new ProductUserModel();
        $listProduct = $productModel->getProductDashboard();

        // Debug để kiểm tra dữ liệu có trả về không
        if (empty($listCategory)) {
            die("Lỗi: Không có danh mục nào trong database!");
        }

        include 'App/Views/Users/index.php';
    }

    public function showShop()
    {
        $productModel = new ProductUserModel();
        $listProduct = $productModel->getDataShop();


        $categoryModel = new CategoryUserModel();
        if (isset($_GET['category_id'])) {
            $category = $categoryModel->getCategoryByID($_GET['category_id']);
        }
        $listCategory = $categoryModel->getCategoryDashboard();
        $stock = $productModel->getProductStock();

        if (isset($_GET['instock'])) {
            $listProduct = array_filter($listProduct, function ($product) {
                return $product->stock > 0;
            });
        }

        if (isset($_GET['outstock'])) {
            $listProduct = array_filter($listProduct, function ($product) {
                return $product->stock == 0;
            });
        }

        if (isset($_GET['min'])) {
            $listProduct = array_filter($listProduct, function ($product) {
                if ($product->price_sale != null) {
                    return $product->price_sale > $_GET['min'];
                }
                return $product->price > $_GET['min'];
            });
        }

        if (isset($_GET['max'])) {
            $listProduct = array_filter($listProduct, function ($product) {
                if ($product->price_sale != null) {
                    return $product->price_sale < $_GET['max'];
                }
                return $product->price < $_GET['max'];
            });
        }

        if (isset($_GET['product-name'])) {
            $listProduct = $productModel->getDataShopName();
        }

        include 'App/Views/Users/shop.php';
    }
    // public function productDetail()
    // {

    //     $productModel = new ProductUserModel();
    //     $product = $productModel->getProductById();
    //     $varibale = $productModel->getVaribalById();
    //     $productImage = $productModel->getProductImageById();
    //     if (isset($_GET['category_id'])) {
    //         $productModel = new ProductUserModel();
    //         $category = $productModel->getProductByCategory();
    //         //  $category = 
    //     } else {
    //         $category = [];
    //     }
    //     $ratingProduct = $productModel->getRating($product->id);
    //     $ratingAvg = $productModel->avgRating($product->id);
    //     // var_dump($varibale);
    //     // die;



    //     include 'App/Views/Users/product-detail.php';
    // }

    public function productDetail()
    {
        $productModel = new ProductUserModel();
        $product = $productModel->getProductById();

        $productImage = $productModel->getProductImageById();
        if (isset($_GET['category_id'])) {
            $productModel = new ProductUserModel();
            $category = $productModel->getProductByCategory();
            //  $category = 
        } else {
            $category = [];
        }
        $comment = $productModel->getComment($product->id);
        foreach ($comment as $key => $value) {
            $rating = $productModel->getCommentByUser($product->id, $value->user_id);
            if ($rating) {
                $comment[$key]->rating = $rating->rating;
            } else {
                $comment[$key]->rating = null;
            }
        }
        // var_dump($productImage);die;
        $ratingProduct = $productModel->getRating($product->id);
        $ratingAvg = $productModel->avgRating($product->id);
        // $ratingProduct = count($ratingProduct ) != 0 ? $ratingProduct : []; 
        // var_dump($ratingProduct);
        // die;


        include 'app/Views/Users/product-detail.php';
    }
}
