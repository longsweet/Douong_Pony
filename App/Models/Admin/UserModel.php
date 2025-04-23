<?php

class UserModel
{
    public $db;

    // Hàm khởi tạo: kết nối đến database khi khởi tạo class
    public function __construct()
    {
        $this->db = new Database();
    }

    // Hàm lấy tất cả người dùng từ bảng 'users'
    public function UserAll()
    {
        $sql = "SELECT * FROM users";

        $stmt = $this->db->pdo->query($sql);

        // Lấy toàn bộ dữ liệu người dùng dưới dạng mảng
        $result = $stmt->fetchAll();

        return $result;
    }

    // Hàm thêm mới người dùng vào DB, sử dụng dữ liệu từ form và ảnh đã upload (đường dẫn ảnh truyền vào là $destPath)
    public function Userpost($destPath)
    {
        // Lấy dữ liệu từ form (POST)
        $name = $_POST['name'];
        $email = $_POST['email'];
        // Nếu có nhập mật khẩu thì hash, nếu không thì hash email làm mật khẩu tạm (tránh NULL)
        $password = $_POST['password'] != "" 
            ? password_hash($_POST['password'], PASSWORD_BCRYPT) 
            : password_hash($_POST['email'], PASSWORD_BCRYPT);
        
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $role = $_POST['role']; // 0: khách, 1: admin
        $image = $destPath; // Đường dẫn ảnh
        $now = date('Y-m-d H:i:s');

        // Kiểm tra xem email đã tồn tại chưa để tránh tạo trùng
        $sqlCheck = "SELECT * FROM users WHERE email = :email";
        $stmt1 = $this->db->pdo->prepare($sqlCheck);
        $stmt1->bindParam(':email', $email);
        $stmt1->execute();

        // Nếu có kết quả → email đã tồn tại → trả false
        if (count($stmt1->fetchAll()) > 0) {
            return false;
        }

        // Nếu không trùng email thì tiến hành thêm mới người dùng
        $sql = "
            INSERT INTO users(name,email,password,address,phone,image,created_at,updated_at,role) 
            VALUES (:name,:email,:password,:address,:phone,:image,:created_at,:updated_at,:role)
        ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':created_at', $now);
        $stmt->bindParam(':updated_at', $now);
        $stmt->bindParam(':role', $role);

        // Thực thi câu lệnh SQL
        return $stmt->execute();
    }

    // Hàm lấy thông tin người dùng dựa vào ID (thường dùng để hiển thị khi sửa user)
    public function getUserById()
    {
        $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return $stmt->fetch(); // Trả về dữ liệu user (dạng object)
        }

        return false;
    }

    // Hàm cập nhật thông tin người dùng vào database
    public function updateUserToDB($destPath)
    {
        // Lấy thông tin người dùng hiện tại để dùng lại mật khẩu nếu người dùng không nhập mới
        $user = $this->getUserById();

        // Dữ liệu mới từ form
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'] != "" 
            ? password_hash($_POST['password'], PASSWORD_BCRYPT) 
            : $user->password; // Nếu không nhập mật khẩu thì giữ nguyên
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];
        $image = $destPath;
        $now = date('Y-m-d H:i:s');

        // Câu lệnh cập nhật user
        $sql = "
            UPDATE users 
            SET name=:name, email=:email, password=:password, address=:address, 
                phone=:phone, image=:image, updated_at=:updated_at, role=:role 
            WHERE id=:id
        ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':updated_at', $now);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $_GET['id']);

        // Thực hiện cập nhật
        return $stmt->execute();
    }
}
