<?php
   namespace app\model;
 
   include __DIR__ . '/../../vendor/autoload.php';
 
   use app\connection\connection;
 
   use PDO;

   class Tags
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

    public function InsertTag()
    {
        $query= "INSERT INTO `tags`(`name`) Values (?) ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1,$this->name);
        $result = $stmt->execute();

        return $result;

    }


    public function AllTags()
    {
        $query = "SELECT * FROM `tags`";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $tags = $stmt->fetchAll();
        return $tags;
        $ad = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ad;
    }

    public function deleteTags()
    {
        $query = "DELETE FROM tags WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();

        return true;
    }









   }



?>