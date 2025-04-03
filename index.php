
<?php

session_start();

include 'App/Databases/Database.php';

include 'App/Models/Admin/ProductModel.php'; // ProductModel
include 'App/Models/Admin/CategoryModel.php'; // CategoryModel
include 'App/Models/Admin/OrderModel.php'; // OrderModel
include 'App/Models/Admin/CommentRatingModel.php'; // CommentModelModel
include 'App/Models/Admin/HomeModel.php'; // homeModel
include 'App/Models/Admin/UserModel.php';

// userModel
include 'App/Models/User/LoginModel.php';
include 'App/Models/User/CategoryUserModel.php';
include 'App/Models/User/ProductUserModel.php';




include 'App/Controllers/Admins/ProductController.php'; // controller 
include 'App/Controllers/Admins/CategoryController.php';

include 'App/Controllers/Admins/OrderController.php'; 
include 'App/Controllers/Admins/CommentRatingController.php';
include 'App/Controllers/Admins/LoginController.php'; //LoginAmin
include 'App/Controllers/Admins/HomeController.php';
include 'App/Controllers/Admins/UserController.php';

//controller Model
include 'App/Controllers/Users/LoginUserController.php';
include 'App/Controllers/Users/DashboardController.php';






const BASE_URL = "http://localhost/Douong_Pony/";
const BASE_URL_ADMIN = "http://localhost/Douong_Pony/?role=admin&";

include 'Router/web.php';
