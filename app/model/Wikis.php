<?php

    namespace app\model;
    include __DIR__ . '/../../vendor/autoload.php';

    use app\connection\connection;
    use PDO;
use PDOException;

    class Wikis
    {
        private $description;
        private $title;
        private $status;
        private $id;
        private $db;
        private $img;

        public function __construct($description,$title,$status,$id,$db,$img)
        {
            $this->db = Connection::getInstence()->getConnect();
            $this->id = $id;
            $this->description = $description;
            $this->title = $title;
            $this->status = $status;
            $this->img = $img;
        }


        public function InsertWiki()
        {
            $query = "INSERT INTO `wikis`(`description`, `title`, `status`, `img`) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1,$this->description);
            $stmt->bindParam(2,$this->title);
            $stmt->bindParam(3,$this->status);
            $stmt->bindParam(4,$this->img);
            $result = $stmt->execute();
           

            return $result;
        }

        public function getAllWikis(){
            try{
                $query = "SELECT * FROM `wikis`";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            }
            catch(PDOException $e){
                echo "Error".$e->getMessage();
            }
        }


    public function selectWikiById($id) {
        try {
            $query = "SELECT * FROM `wikis` WHERE `id` = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            
        }
}




    }


?>