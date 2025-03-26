
<?php

session_start();

include 'App/Databases/Database.php';

<<<<<<< HEAD
include 'App/Models/Admin/ProductModel.php'; // ProductModel
include 'App/Models/Admin/CategoryModel.php'; // CategoryModel
include 'App/Models/Admin/OrderModel.php'; // OrderModel
include 'App/Models/Admin/CommentRatingModel.php'; // CommentModelModel
include 'App/Models/Admin/HomeModel.php'; // homeModel
=======

//Phần ModelModel


include 'App/Models/Admin/ProductModel.php'; // model
include 'App/Models/Admin/CategoryModel.php';
include 'App/Models/Admin/OrderModel.php';
>>>>>>> b4386be2e0ed97ff341367676478caf15c7ed17a


include 'App/Controllers/Admins/ProductController.php'; // controller 
include 'App/Controllers/Admins/CategoryController.php';
<<<<<<< HEAD
include 'App/Controllers/Admins/OrderController.php'; 
include 'App/Controllers/Admins/CommentRatingController.php';
include 'App/Controllers/Admins/LoginController.php'; //LoginAmin
=======
include 'App/Controllers/Admins/OrderController.php';
>>>>>>> b4386be2e0ed97ff341367676478caf15c7ed17a



const BASE_URL = "http://localhost/Douong_Pony/";

include 'Router/web.php';
