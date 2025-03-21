<?php

include 'App/Databases/Database.php';

include 'App/Models/Admin/ProductModel.php'; // model
include 'App/Models/Admin/CategoryModel.php';

include 'App/Controllers/Admins/ProductController.php'; // controller 
include 'App/Controllers/Admins/CategoryController.php';


const BASE_URL = "http://localhost/Douong_Pony/";

include 'Router/web.php';