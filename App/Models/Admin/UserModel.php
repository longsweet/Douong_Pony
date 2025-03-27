<?php

class UserModel
{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function UserAll()
    {
        $sql = "SELECT * FROM users";

        $stmt = $this->db->pdo->query($sql);

        $result = $stmt->fetchAll();

        return $result;
    }

    public function  Userpost($destPath)
    {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'] != "" ? password_hash($_POST['password'], PASSWORD_BCRYPT) : password_hash(
            $_POST['email'],
            PASSWORD_BCRYPT
        );
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];
        $image = $destPath;
        $now = date('Y-m-d H:i:s');

        $sqlCheck = "SELECT * FROM users WHERE email = :email";
        $stmt1 = $this->db->pdo->prepare($sqlCheck);
        $stmt1->bindParam(':email', $email);
        $stmt1->execute();
        if (count($stmt1->fetchAll()) > 0) {
            return false;
        }

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
        return $stmt->execute();
    }

    public function getUserById()
    {
        $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);

        $stmt ->bindParam(':id', $id);

        if($stmt->execute())
        {
            return $stmt->fetch();
        }return false;
    }


        


}
