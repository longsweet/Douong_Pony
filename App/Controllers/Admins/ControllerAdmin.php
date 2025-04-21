<?php 

class ControllerAdmin
{
    public function __construct()
    {
        if(!isset($_SESSION['users']))
        {
            $_SESSION['error'] = "Vui lòng đăng Nhập trước thì mới vào được";
            header("Location: " .   BASE_URL    .   "?act=login-admin"   );
            exit;
        }
    }
} 