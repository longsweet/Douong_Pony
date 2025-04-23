<?php 

class LoginModel
{
    public $db;

    // Khởi tạo đối tượng Database để kết nối cơ sở dữ liệu
    public function __construct(){
        $this->db = new Database();
    }

    // Kiểm tra thông tin đăng nhập (email và mật khẩu)
    public function checkLogin($email, $password){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();   

        $result = $stmt->fetch();
        if ($result && password_verify($password, $result->password)){
            return $result;  // Đăng nhập thành công
        }
        return false;  // Đăng nhập thất bại
    }

    // Thêm người dùng mới vào cơ sở dữ liệu
    public function addUserToDB(){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $now = date('Y-m-d H:i:s');
        $role = "2";  // Vai trò mặc định là người dùng thường

        // Kiểm tra email có bị trùng không
        $sqlCheck = "SELECT * FROM users WHERE email = :email";
        $stmt1 = $this->db->pdo->prepare($sqlCheck);
        $stmt1->bindParam(':email', $email);
        $stmt1->execute();
        if(count($stmt1->fetchAll()) > 0){
            return false;  // Trả về false nếu email đã tồn tại
        }

        // Thêm người dùng mới vào bảng users
        $sql = "INSERT INTO users(name,email,password,created_at,updated_at,role) 
                VALUES (:name,:email,:password,:created_at,:updated_at,:role)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':created_at', $now);
        $stmt->bindParam(':updated_at', $now);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();  // Trả về true nếu thêm thành công
    }

    // Tìm người dùng theo email
    public function findUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();   
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Trả về thông tin người dùng theo email
    }

    // Cập nhật mật khẩu người dùng
    public function updatePassword($email, $newPassword) {
        $sql = "UPDATE users SET password = :password WHERE email = :email";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':password', $newPassword); // Cập nhật mật khẩu mới
        $stmt->bindParam(':email', $email);
        
        if ($stmt->execute()) {
            return true;  // Trả về true nếu cập nhật thành công
        } else {
            return false; // Lỗi khi thực hiện câu lệnh
        }
    }

    // Lấy thông tin người dùng hiện tại từ session
    public function getCurrenUser(){
        if(isset($_SESSION['users'])){
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $_SESSION['users']['id']);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);  // Trả về dữ liệu người dùng dưới dạng object
        } else {
            return false;  // Trả về false nếu không có người dùng trong session
        }
    }

    // Thay đổi mật khẩu người dùng
    public function changePassword(){
        if(isset($_SESSION['users'])){
            $user = $this->getCurrenUser();
            if(password_verify($_POST['current-password'], $user->password)){
                $hash = password_hash($_POST['new-password'], PASSWORD_BCRYPT);
                $sql = "UPDATE `users` SET `password`=:password  WHERE id=:id";
                $stmt = $this->db->pdo->prepare($sql);
                $stmt->bindParam(':password', $hash);
                $stmt->bindParam(':id', $_SESSION['users']['id']);
                return $stmt->execute();  // Trả về true nếu cập nhật mật khẩu thành công
            }
        } else {
            return false;  // Trả về false nếu không có người dùng trong session
        }
    }

    // Cập nhật thông tin người dùng hiện tại (bao gồm hình ảnh)
    public function updateCurrentUser($destPath){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $image = $destPath;
        $now = date('Y-m-d H:i:s');

        // Cập nhật thông tin người dùng
        $sql = "UPDATE users SET name=:name, email=:email, address=:address, phone=:phone, image=:image,
                updated_at=:updated_at WHERE id=:id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':updated_at', $now);
        $stmt->bindParam(':id', $_SESSION['users']['id']);
        return $stmt->execute();  // Trả về true nếu cập nhật thành công
    }
}
?>
