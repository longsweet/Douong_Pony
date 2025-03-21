<?php 

class CategoryModel
{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function allCategory()
    {
        $sql = "SELECT * FROM categories";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetchAll();

        return $result;

    }
}