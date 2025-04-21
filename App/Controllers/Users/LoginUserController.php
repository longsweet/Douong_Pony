<?php

class LoginUserController
{

    public function index()
    {
        include 'App/Views/Users/index.php';
    }
    public function login()
    {
        $categoryModel = new CategoryUserModel();
        $listCategory = $categoryModel->getCategoryDashboard();
        include 'App/Views/Users/login.php';
    }

    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            // var_dump( $email);
            // die();
            // Khởi tạo model
            $loginModel = new LoginModel();
            $dataUsers = $loginModel->checkLogin($email, $password);
            if ($dataUsers) {
                $_SESSION['users'] = [
                    'id'     => $dataUsers->id,
                    'name'   => $dataUsers->name,
                    'email'  => $dataUsers->email,
                ];
                header("Location: " . BASE_URL);
                exit;
            } else {
                $_SESSION['error'] = "Email hoặc mật khẩu không đúng!";
                header("Location: " . BASE_URL . "?act=login");
                exit;
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['users'])) {
            unset($_SESSION['users']);
        }
        header("Location: " . BASE_URL);
    }

    public function register()
    {
        $categoryModel = new CategoryUserModel();
        $listCategory = $categoryModel->getCategoryDashboard();
        include 'App/Views/Users/register.php';
    }

    public function postRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $loginModel = new LoginModel();
            $message = $loginModel->addUserToDB();


            if ($message) {
                $_SESSION['message'] = "Đăng ký thành công!";
                header("Location: " . BASE_URL . "?act=login");
                exit;
            } else {
                $_SESSION['message'] = "Đăng ký không thành công!";
                header("Location: " . BASE_URL . "?act=register");
                exit;
            }
        }
    }

    public function showForgotPasswordForm()
    {
        include 'App/Views/Users/login.php';
    }

    public function postQuenMatKhau()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy email từ form
            $email = $_POST['email'];

            // Kiểm tra xem email có tồn tại trong database không
            $user = (new LoginModel())->findUserByEmail($email);

            // Nếu email tồn tại, tạo mật khẩu mới và cập nhật
            if ($user) {
                // Tạo mật khẩu mới ngẫu nhiên (hoặc có thể yêu cầu người dùng nhập mật khẩu mới)
                $newPassword = substr(md5(time()), 0, 8); // Tạo mật khẩu mới ngẫu nhiên (8 ký tự)
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                // Cập nhật mật khẩu mới vào database
                if ((new LoginModel())->updatePassword($email, $hashedPassword)) {
                    // Cập nhật thành công
                    $_SESSION['success'] = "Mật khẩu mới của bạn là: <strong>$newPassword</strong>";
                } else {
                    // Nếu có lỗi khi cập nhật
                    $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật mật khẩu!";
                }
            } else {
                // Nếu email không tồn tại trong database
                $_SESSION['error'] = "Email không tồn tại!";
            }

            // Chuyển hướng về trang reset password và hiển thị thông báo
            header("Location: " . BASE_URL . "?act=formqmk");
            exit;
        }
    }
}
