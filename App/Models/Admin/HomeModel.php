<?php 

 class HomeModel
 {
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function loginCheck($email, $password)
    {
        // $email = $_POST['email'];
        // $password = $_POST['password'];
    
        // Chọn các cột cần thiết thay vì SELECT *
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
    
 }