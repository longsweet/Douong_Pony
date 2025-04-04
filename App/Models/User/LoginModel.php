<?php 

class LoginModel
{
    public $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function checkLogin($email,$password){

        $sql = "SELECT * FROM users WHERE email = :email and role = 2";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();   

        $result = $stmt->fetch();
        if ($result && password_verify($password, $result->password)){
            return $result;  
        }
        return false;
    }

    public function addUserToDB(){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $now = date('Y-m-d H:i:s');
        $role = "2";

        //check email > 1
        $sqlCheck = "SELECT * FROM users WHERE email = :email";
        $stmt1 = $this->db->pdo->prepare($sqlCheck);
        $stmt1->bindParam(':email', $email);
        $stmt1->execute();
        if(count($stmt1->fetchAll()) > 0){
            return false;
        }


        $sql = "
        INSERT INTO users(name,email,password,created_at,updated_at,role) 
        VALUES (:name,:email,:password,:created_at,:updated_at,:role)
        ";


        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':created_at', $now);
        $stmt->bindParam(':updated_at', $now);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    public function findUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();   
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function updatePassword($email, $newPassword) {
        // Lưu mật khẩu thô (không mã hóa)
        $sql = "UPDATE users SET password = :password WHERE email = :email";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':password', $newPassword); // Lưu mật khẩu thô
        $stmt->bindParam(':email', $email);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false; // Lỗi khi thực hiện câu lệnh
        }
    }

    public function getCurrenUser(){
        if(isset($_SESSION['users'])){
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $_SESSION['users']['id']);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ); // ✅ Lấy dữ liệu dạng object
        } else {
            return false;
        }
    }

    public function changePassword(){
        if(isset($_SESSION['users'])){
            $user = $this->getCurrenUser();
            if(password_verify($_POST['current-password'], $user->password)){
                $hash = password_hash($_POST['new-password'], PASSWORD_BCRYPT);
                $sql = "UPDATE `users` SET `password`=:password  WHERE id=:id";
                $stmt = $this->db->pdo->prepare($sql);
                $stmt->bindParam(':password', $hash);
                $stmt->bindParam(':id', $_SESSION['users']['id']);
                return $stmt->execute();
            }

        }else{
            return false;
        }
    }

    public function updateCurrentUser($destPath){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $image = $destPath;
        $now = date('Y-m-d H:i:s');


        $sql = "
        UPDATE users SET name=:name, email=:email, address=:address, phone=:phone, image=:image,
        updated_at=:updated_at WHERE id=:id
        ";


        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':updated_at', $now);
        $stmt->bindParam(':id', $_SESSION['users']['id']);
        return $stmt->execute();
    }
    
    
    
    
    
}