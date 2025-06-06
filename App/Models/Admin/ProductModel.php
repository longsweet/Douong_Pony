<?php
class ProductModel
{
    public $db;

    // Constructor: khởi tạo và kết nối DB mỗi khi tạo mới ProductModel
    public function __construct()
    {
        $this->db = new Database();
    }

    // Lấy 12 sản phẩm ngẫu nhiên (dùng cho trang dashboard/trang chủ)
    public function getProductDashboard()
    {
        $sql = "SELECT * FROM products ORDER BY rand() LIMIT 12";
        $query = $this->db->pdo->query($sql);
        return $query->fetchAll(); // Trả về mảng chứa 12 sản phẩm ngẫu nhiên
    }

    // Lấy tất cả sản phẩm (kèm theo tên danh mục) — dùng cho trang quản trị
    public function getAllProduct()
    {
        $sql = "
            SELECT products.id, products.name, products.price, products.price_sale, 
                   products.category_id, products.stock, products.image_main, 
                   categories.name AS categoryName 
            FROM products 
            JOIN categories ON products.category_id = categories.id
        ";
        $query = $this->db->pdo->query($sql);
        return $query->fetchAll();
    }

    // Lấy chi tiết sản phẩm theo ID (dùng khi sửa sản phẩm)
    public function getProductByID()
    {
        $id = $_GET['id']; // ID truyền qua URL
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
        return false;
    }

    // Thêm sản phẩm mới vào database
    public function addProductToDB($destPath)
    {
        // Lấy dữ liệu từ form (POST)
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $price_sale = isset($_POST['price_sale']) && $_POST['price_sale'] !== '' ? (int)$_POST['price_sale'] : null;
        $stock = $_POST['stock'];
        $description = $_POST['description'];
        $now = date('Y-m-d H:i:s');
        $imageDes = $destPath; // Đường dẫn ảnh chính

        // Câu lệnh SQL thêm sản phẩm
        $sql = "
            INSERT INTO products(name, category_id, description, price, price_sale, stock, image_main, created_at, updated_at) 
            VALUES (:name, :category_id, :description, :price, :price_sale, :stock, :image_main, :created_at, :updated_at)
        ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category_id', $category);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':price_sale', $price_sale);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':image_main', $imageDes);
        $stmt->bindParam(':created_at', $now);
        $stmt->bindParam(':updated_at', $now);

        if ($stmt->execute()) {
            // Trả về ID của sản phẩm mới vừa thêm
            return $this->db->pdo->lastInsertId();
        } else {
            return false;
        }
    }

    // Thêm ảnh thư viện (nhiều ảnh phụ) cho 1 sản phẩm
    public function addGararyImage($destPathImage, $idProduct)
    {
        $sql = "INSERT INTO product_image(product_id, image) VALUES (:product_id, :image)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $idProduct);
        $stmt->bindParam(':image', $destPathImage);
        return $stmt->execute();
    }

    // Lấy danh sách ảnh thư viện của sản phẩm
    public function getProductImageByID()
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM product_image WHERE product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $id);
        if ($stmt->execute()) {
            return $stmt->fetchAll(); // Trả về mảng ảnh phụ của sản phẩm
        }
        return false;
    }

    // Xóa sản phẩm và ảnh phụ đi kèm
    public function deleteProductToDB()
    {
        $id = $_GET['id'];

        // Xóa ảnh phụ
        $sqlProductImage = "DELETE FROM product_image WHERE product_id = :product_id";
        $stmt1 = $this->db->pdo->prepare($sqlProductImage);
        $stmt1->bindParam(':product_id', $id);

        // Xóa sản phẩm
        $sqlProduct = "DELETE FROM products WHERE id = :id";
        $stmt2 = $this->db->pdo->prepare($sqlProduct);
        $stmt2->bindParam(':id', $id);

        return $stmt1->execute() && $stmt2->execute(); // Nếu cả hai đều xóa thành công thì return true
    }

    // Cập nhật sản phẩm
    public function updateProductToDB($destPath)
    {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $price_sale = $_POST['price_sale'] != "" ? $_POST['price_sale'] : null;
        $stock = $_POST['stock'];
        $description = $_POST['description'];
        $now = date('Y-m-d H:i:s');
        $imageDes = $destPath;

        $sql = "
            UPDATE products 
            SET name = :name, category_id = :category_id, description = :description, 
                price = :price, price_sale = :price_sale, stock = :stock, 
                image_main = :image_main, updated_at = :updated_at 
            WHERE id = :id
        ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category_id', $category);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':price_sale', $price_sale);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':image_main', $imageDes);
        $stmt->bindParam(':updated_at', $now);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // Xóa toàn bộ ảnh thư viện (dựa vào product_id)
    public function deleteImageGarary()
    {
        $id = $_GET['id'];

        // LỖI: Sai cú pháp câu SQL ("DELETE product_image" nên sửa thành "DELETE FROM product_image")
        $sqlProductImage = "DELETE FROM product_image WHERE product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sqlProductImage);

        // LỖI: sai tên biến bindParam (phải là 'product_id' không phải 'product-id')
        $stmt->bindParam(':product_id', $id);
        return $stmt->execute();
    }

    // Tìm kiếm sản phẩm theo tên (sử dụng LIKE %từ khóa%)
    public function getDataShopName()
    {
        $productName = $_GET['product-name'];
        $sql = "SELECT * FROM products WHERE name LIKE '%$productName%'";
        $query = $this->db->pdo->query($sql);
        return $query->fetchAll();
    }
}
