<?php
session_start();

include 'App/Databases/Database.php';


//Phần ModelModel
include 'App/Models/Admin/ProductModel.php';

include 'App/Models/Admin/ProductModel.php'; // model
include 'App/Models/Admin/CategoryModel.php';
include 'App/Models/Admin/OrderModel.php';


include 'App/Controllers/Admins/ProductController.php'; // controller 
include 'App/Controllers/Admins/CategoryController.php';
include 'App/Controllers/Admins/OrderController.php';


// Phần ControllerController
include 'App/Controllers/Admins/ProductController.php';

const BASE_URL = "http://localhost/Douong_Pony/";

include 'Router/web.php';
