<?php

class UserController
{
    // Lấy danh sách tất cả người dùng
    public function UserAll()
    {
        $listUser = (new UserModel)->UserAll(); // Lấy danh sách người dùng từ model

        include 'App/Views/Admin/user.php'; // Hiển thị danh sách người dùng trong view
    }

    // Hiển thị form thêm người dùng mới
    public function formUser()
    {
        include 'App/Views/Admin/add-user.php'; // Hiển thị form thêm người dùng
    }

    // Kiểm tra dữ liệu nhập vào trong form
    public function validete()
    {
        $name  = $_POST['name'];
        $email  = $_POST['email'];
        $address  = $_POST['address'];
        $phone  = $_POST['phone']; // Sửa lỗi gọi sai trường 'phone'
        $role  = $_POST['role'];

        // Kiểm tra nếu tất cả các trường không rỗng
        if ($name != "" && $email != "" && $address != "" && $phone != "" && $role != "") {
            return true;
        } else {
            $_SESSION['error'] = "Vui lòng điền đủ thông tin";
            return false;
        }
    }

    // Xử lý thêm người dùng mới vào cơ sở dữ liệu
    public function userPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!$this->validete()) { // Kiểm tra validate dữ liệu
                header("Location: " . BASE_URL . "?act=add-user");
                exit;
            }
        }

        // Xử lý tải lên ảnh người dùng
        $upload_anh = 'Assets/Admin/upload/';
        $DuoiA = ['image/jpeg', 'image/png', 'image/gif'];
        $destPath = "";

        if (!empty($_FILES['image']['name'])) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileTyle = mime_content_type($fileTmpPath);
            $fileName = basename($_FILES['image']['name']);
            $filtExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $newName = uniqid() . '.' . $filtExtension;

            if (in_array($fileTyle, $DuoiA)) {
                $destPath = $upload_anh . $newName;

                if (!move_uploaded_file($fileTmpPath, $destPath)) {
                    $destPath = "";
                }
            }

            $massage = (new UserModel())->Userpost($destPath); // Thêm người dùng vào DB

            if ($massage) {
                $_SESSION['message'] = "Thêm mới thành công";
                header("Location: " . BASE_URL . "?act=user-all");
                exit;
            } else {
                $_SESSION['message'] = "Thêm mới không thành công";
                header("Location: " . BASE_URL . "?act=admin-form");
                exit;
            }
        }
    }

    // Hiển thị thông tin người dùng theo ID
    public function showUser()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn tài khoản cần xem";
            header("Location: " . BASE_URL . "?act=user-all");
            exit;
        }

        $user = (new UserModel())->getUserById(); // Lấy thông tin người dùng theo ID

        include 'App/Views/Admin/show-user.php'; // Hiển thị chi tiết người dùng
    }

    // Hiển thị form chỉnh sửa thông tin người dùng
    public function userUpdateForm()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn tài khoản cần sửa!";
            header("Location: " . BASE_URL . "?role=admin&act=all-user");
            exit;
        }

        $userModel = new UserModel();
        $user = $userModel->getUserById(); // Lấy thông tin người dùng cần sửa
        if (!$user) {
            $_SESSION['message'] = "Không tìm thấy dữ liệu!";
            header("Location: " . BASE_URL . "?role=admin&act=all-user");
            exit;
        }

        include 'App/Views/Admin/update-user.php'; // Hiển thị form sửa thông tin người dùng
    }

    // Xử lý cập nhật thông tin người dùng
    public function updatePostUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_GET['id'])) {
                $_SESSION['message'] = "Vui lòng chọn tài khoản cần sửa!";
                header("Location: " . BASE_URL . "?role=admin&act=user-all");
                exit;
            }

            if (!$this->validete()) { // Kiểm tra validate dữ liệu
                header("Location: " . BASE_URL . "?role=admin&act=update-user&id=" . $_GET['id']);
                exit;
            }

            $userModel = new UserModel();
            $user = $userModel->getUserById();

            // Xử lý ảnh người dùng
            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = $user->image; // Giữ lại ảnh cũ nếu không thay đổi

            if (!empty($_FILES['image']['name'])) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileType = mime_content_type($fileTmpPath);
                $fileName = basename($_FILES['image']['name']);
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $newFileName = uniqid() . '.' . $fileExtension;
                if (in_array($fileType, $allowedTypes)) {
                    $destPath = $uploadDir . $newFileName;
                    if (!move_uploaded_file($fileTmpPath, $destPath)) {
                        $destPath = "";
                    }
                    // Xóa ảnh cũ nếu có
                    unlink($user->image);
                }
            }

            $message = $userModel->updateUserToDB($destPath); // Cập nhật thông tin người dùng

            if ($message) {
                $_SESSION['message'] = "Cập nhật thành công!";
                header("Location: " . BASE_URL . "?role=admin&act=user-all");
                exit;
            } else {
                $_SESSION['message'] = "Cập nhật không thành công!";
                header("Location: " . BASE_URL . "?role=admin&act=update-user&id=" . $_GET['id']);
                exit;
            }
        }
    }
}
?>
