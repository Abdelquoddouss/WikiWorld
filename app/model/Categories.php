<?php
  namespace app\model;
 
  include __DIR__ . '/../../vendor/autoload.php';

  use app\connection\connection;

  use PDO;

  class Categories
  {

    public $id;
    public $name;
    public $db;


    public function __construct($id,$name)
    {
        $this->db = Connection::getInstence()->getConnect();
        $this->name = $name;
        $this->id = $id;
    }

    public function InsertCategorie()
    {
        $query= "INSERT INTO `categories`(`name`) Values (?) ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1,$this->name);
        $result = $stmt->execute();

        return $result;

    }

    public function AllCategories()
    {
        $query = "SELECT * FROM `categories` ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $categories= $stmt->fetchAll();
        return $categories;
        $ad = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ad;
    }

    public function AllCategoriesby2()
    {
        $query = "SELECT * FROM `categories` ORDER BY id DESC lIMIT 3";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $categories= $stmt->fetchAll();
        return $categories;
        $ad = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ad;
    }

    public function deleteCategory()
    {
        $query = "DELETE FROM categories WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();

        return true;
    }


    // public function updateRecord($id, $name)
    // {
    //     $query = "UPDATE `categories` SET `name` = :name WHERE id = :id";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':name', $name);
    //     $stmt->bindParam(':id', $id);

    //     $result = $stmt->execute();

    //     return $result;
    // }





    }





?>