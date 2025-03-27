<?php

class UserController
{
    public function UserAll()
    {
        $listUser = (new UserModel)->UserAll();

        include 'App/Views/Admin/user.php';
    }

    public function formUser()
    {
        include 'App/Views/Admin/add-user.php';
    }

    public function validete()
    {
        $name  = $_POST['name'];
        $email  = $_POST['email'];
        $address  = $_POST['address'];
        $phone  = $_POST['name'];
        $role  = $_POST['role'];

        if ($name != "" && $email != "" && $address !=  "" && $phone != "" && $role != "") {
            return true;
        } else {
            $_SESSION['error'] = "Vui long điền đủ thông tin";
            return false;
        }
    }

    public function userPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!$this->validete()) // kiểm cha validate
            {
                header("Location: "     .   BASE_URL    .   "?act=add-user");
                exit;
            }
        }

        $upload_anh = 'Assets/Admin/upload/';
        $DuoiA = ['image/jpeg', 'image/png',    'image/gif'];
        $destPath = "";

        if (!empty($_FILES['image']['name'])) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileTyle    = mime_content_type($fileTmpPath);
            $fileName    = basename($_FILES['image']['name']);
            $filtExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $newName = uniqid() .   '.' .   $filtExtension;

            if (in_array($fileTyle, $DuoiA)) {
                $destPath = $upload_anh .   $newName;

                if (!move_uploaded_file($fileTmpPath, $destPath)) {
                    $destPath = "";
                }
            }

            $massage = (new UserModel())->Userpost($destPath);

            if ($massage) {
                $_SESSION['message'] = "Thêm mới thành công";
                header("Location: " .   BASE_URL    .   "?act=user-all");
                exit;
            } else {
                $_SESSION['message'] = "Thêm mới Không thành công";
                header("Location: " .   BASE_URL    .   "?act=admin-form");
                exit;
            }
        }
    }

    public function showUser()
    {
        if(!isset($_GET['id']))
        {
            $_SESSION['message'] = "Vui lòng chọn tài khoản cần xem";
            header("Location: " .   BASE_URL    .   "?act=user-all");
            exit;   
        }
        $user = (new UserModel())->getUserById();

        include 'App/Views/Admin/show-user.php';
    }


    
}
