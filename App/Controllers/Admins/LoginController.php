<?php 

class LoginController
{
    public function loginAdmin()
    {
        include 'App/Views/Admin/loginAdmin.php';
    }


    public function LoginPost()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        // var_dump( $email);
        // die();
        // Khởi tạo model
        $HomeModel = new HomeModel();
        $DataUsers = $HomeModel->loginCheck($email, $password);
        // var_dump($DataUsers);
        // die();
        // Kiểm tra nếu đăng nhập thành công
        if ($DataUsers) {
            
            // Lưu thông tin người dùng vào session
            $_SESSION['users'] = [
                'id'    => $DataUsers->id,
                'name'  => $DataUsers->name,
                'email' => $DataUsers->email,
            ];

            // Chuyển hướng đến trang quản lý category (sửa BASE_URL cho đúng)
            header("Location: " . BASE_URL_ADMIN . "act=category");
            exit;
        } else {
            // Nếu đăng nhập thất bại, trả về thông báo lỗi
            $_SESSION['error'] = "Tài khoản Không Tồn Tại";
            header("Location: " . BASE_URL_ADMIN . "act=login-admin");
            exit;
        }
    }

    public function Logout()
    {
        if(isset($_SESSION['users']))
        {
            unset($_SESSION['users']);
        }

        $_SESSION['error'] = "Chúc mừng bạn đã đăng Xuát Thành Công";
        header(header: "Location: " .   BASE_URL_ADMIN    . "act=login-admin");
        exit;
    }
}



