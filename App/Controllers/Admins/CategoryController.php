<?php
class CategoryController 
{
    // Hiển thị danh mục sản phẩm
    public function showAllproduct()
    {
        $categories =  new  CategoryModel();
        
        // Lấy danh sách tất cả danh mục
        $listProduct = $categories->allCategory();
        include 'App/Views/Admin/category.php';
    }

    // Form thêm danh mục mới
    public function addCategory()
    {
        include 'App/Views/Admin/add-category.php';
    } 

    // Kiểm tra dữ liệu đầu vào trước khi thêm danh mục
    public function checkValidate() 
    {
        $name = $_POST['name'];

        // Kiểm tra nếu tên danh mục không rỗng
        if ($name != "") {
            return true;
        } else {
            $_SESSION['error'] = "Vui lòng điền thông tin";
            return false;
        }
    }

    // Thêm danh mục vào cơ sở dữ liệu
    public function PostCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Kiểm tra dữ liệu hợp lệ
            if (!$this->checkValidate()) {
                // Nếu không hợp lệ, chuyển hướng lại về form thêm danh mục
                header("Location: " . BASE_URL_ADMIN . "?role=admin&act=category-add");
                exit;
            }

            $categoryModel = new CategoryModel();
            $message = $categoryModel->addCategory();

            if ($message) {
                $_SESSION['message'] = "Thêm danh mục mới thành công";
                header("Location: " . BASE_URL . "?role=admin&act=category");
            } else {
                $_SESSION['message'] = "Thêm mới không thành công";
                header("Location: " . BASE_URL . "?role=admin&act=category-add");
                exit;
            }
        }
    }

    // Xóa danh mục
    public function deleteCatefory()
    {
        // Kiểm tra nếu không có ID, yêu cầu chọn danh mục
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn danh mục cần xóa";
            header("Location: " . BASE_URL . "?role=admin&act=category");
            exit;
        }

        $Category = new CategoryModel();
        $message = $Category->deleteCategoty();

        if ($message) {
            $_SESSION['message'] = "Xóa thành công";
            header("Location: " . BASE_URL . "?role=admin&act=category");
            exit;
        } else {
            $_SESSION['message'] = "Xóa không thành công";
            header("Location: " . BASE_URL . "?role=admin&act=category");
        }
    }

    // Hiển thị form sửa danh mục
    public function formCategory()
    {
        // Kiểm tra nếu không có ID, yêu cầu chọn danh mục cần sửa
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn danh mục cần sửa thông tin";
            header("Location: " . BASE_URL . "?role=admin&category");
            exit;
        }

        // Lấy thông tin danh mục theo ID
        $categories = (new CategoryModel())->getCategoryByID();
        include 'App/Views/Admin/update-category.php';
    }

    // Cập nhật danh mục
    public function updateCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Kiểm tra nếu không có ID, yêu cầu chọn danh mục cần sửa
            if (!isset($_GET['id'])) {
                $_SESSION['message'] = "Vui lòng chọn danh mục cần sửa";
                header("Location: " . BASE_URL . "?role=admin&category");
                exit;
            }

            // Kiểm tra lại dữ liệu đầu vào trước khi lưu
            if (!$this->checkValidate()) {
                header("Location: " .   BASE_URL    . "?role=admin&act=category-form&id="    .   $_GET['id']);
                exit;
            }
            $category = new CategoryModel();
            $message = $category->updateCategoryToDB();

            if ($message) {
                $_SESSION['message'] = "Cập nhật thành công";
                header("Location: " .   BASE_URL    . "?role=admin&act=category-form&id="   .   $_GET['id']);
                exit;
            } else {
                $_SESSION['message'] = "Cập nhật không thành công";
                header("Location: " .   BASE_URL    . "?role=admin&act=category-form&id="   .   $_GET['id']);
                exit;
            }
        }
    }

    // Hiển thị thông tin danh mục
    public function ShowCategory()
    {
        // Kiểm tra nếu không có ID, yêu cầu chọn danh mục cần sửa thông tin
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = "Vui lòng chọn danh mục cần sửa thông tin";
            header("Location: " . BASE_URL . "?role=admin&category");
            exit;
        }

        // Lấy thông tin danh mục theo ID
        $categories = (new CategoryModel())->getCategoryByID();
        include 'App/Views/Admin/show-category.php';
    }
}
