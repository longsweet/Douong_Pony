<?php

include 'App/Databases/Database.php';

//Phần ModelModel
include 'App/Models/Admin/ProductModel.php';

// Phần ControllerController
include 'App/Controllers/Admins/ProductController.php'; 

const BASE_URL = "http://localhost/Douong_Pony/";

include 'Router/web.php';
