<?php

class CategoryController
{
    public function showAllproduct()
    {
        $categories =  new  CategoryModel();
        $listProduct = $categories->allCategory();
        include 'App/Views/Admin/category.php';
    }

    public function addCategory()
    {
        include 'App/Views/Admin/add-category.php';
    } // form thêm add;


    public function checkValidate() // validatevalidate
    {
        $name = $_POST['name'];

        if ($name != "") {
            return true;
        } else {
            $_SESSION['error'] = "vui lòng điền thông tin";
            return false;
        }
    }

    public function PostCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!$this->checkValidate()) {
                // var_dump("Before redirect");

                header("Location: " . BASE_URL_ADMIN . "?role=admin&act=category-add");
                exit;
            }

            $categoryModel = new CategoryModel();
            $message = $categoryModel->addCategory();

            if ($message) {
                $_SESSION['message'] = "Thêm sp mới thành công";
                header("Location: " . BASE_URL . "?role=admin&act=category");
            } else {
                $_SESSION['message'] = "Thêm mới không thành công";
                header("Location: " . BASE_URL . "?role=admin&act=category-add");
                exit;
            }
        }
    }

    public function deleteCatefory()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "vui lòng chọn danh mục cần xóa";
            header("Location: " . BASE_URL . "?role=admin&act=category");
            exit;
        }

        $Category = new CategoryModel();
        $message = $Category->deleteCategoty();

        if ($message) {
            $_SESSION['message'] = "Xóa Thành Công";
            header("Location: " . BASE_URL . "?role=admin&act=category");
            exit;
        } else {
            $_SESSION['message'] = "Xóa Không thành công";
            header("Location: " . BASE_URL . "?role=admin&act=category");
        }
    }

    public function formCategory()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "vui chọn  đúng danh mục cần sửa thông tin";
            header("Location: " . BASE_URL . "?role=admin&category");
            exit;
        }

        $categories = (new CategoryModel())->getCategoryByID(); // lấy 1 sp theo id
        include 'App/Views/Admin/update-category.php';
    }

    public function updateCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!isset($_GET['id'])) {
                $_SESSION['message'] = "Vui lòng chọn danh mục cần sửa";
                header("Location: " . BASE_URL . "?role=admin&category");
                exit;
            }

            if (!$this->checkValidate()) {
                // var_dump("Before redirect");

                header("Location: " .   BASE_URL    . "?role=admin&act=category-form&id="    .   $_GET['id']);
                exit;
            }
            $category = new CategoryModel();
            $message = $category->updateCategoryToDB();

            if ($message) {
                $_SESSION['message'] = "Sửa Thành Công";
                header("Location: " .   BASE_URL    . "?role=admin&act=category-form&id="   .   $_GET['id']);
                exit;
            } else {
                $_SESSION['message'] = "Sửa Không Thành Công";
                header("Location: " .   BASE_URL    . "?role=admin&act=category-form&id="   .   $_GET['id']);
                exit;
            }
        }
    }

    public function ShowCategory()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "vui chọn  đúng danh mục cần sửa thông tin";
            header("Location: " . BASE_URL . "?role=admin&category");
            exit;
        }

        $categories = (new CategoryModel())->getCategoryByID(); // lấy 1 sp theo id
        include 'App/Views/Admin/show-category.php';
    }
}
