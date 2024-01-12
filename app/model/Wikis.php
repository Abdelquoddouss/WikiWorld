<?php
namespace app\model;


    include __DIR__ . '/../../vendor/autoload.php';

    use app\connection\connection;
    use PDO;
    use PDOException;
    use Exception;

    class Wikis
    {
        private $description;
        private $title;
        private $status;
        private $id;
        private $db;
        private $img;
        private $categories_id;

        public function __construct($description,$title,$status,$id,$db,$img,$categories_id)
        {
            $this->db = Connection::getInstence()->getConnect();
            $this->id = $id;
            $this->description = $description;
            $this->title = $title;
            $this->status = $status;
            $this->img = $img;
            $this->categories_id = $categories_id;
        }


        public function InsertWiki()
        {
            $query = "INSERT INTO `wikis`(`description`, `title`, `status`, `img`,`categorie_id`) VALUES (?, ?, ?, ?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1,$this->description);
            $stmt->bindParam(2,$this->title);
            $stmt->bindParam(3,$this->status);
            $stmt->bindParam(4,$this->img);
            $stmt->bindParam(5,$this->categories_id);
            $result = $stmt->execute();
           

            return $result;
        }

        public function getAllWikis(){
            try{
                $query = "SELECT wikis.* ,categories.name FROM wikis LEFT JOIN categories ON wikis.categorie_id = categories.id";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
            }
            catch(PDOException $e){
                echo "Error".$e->getMessage();
            }
        }


        public function getAllWikis2(){
            try{
                $query = "SELECT * FROM `wikis` ORDER BY id DESC lIMIT 4";
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
        
                if (!$result) {
                    throw new Exception("Wiki not found with ID: " . $id); // Include the ID in the exception message
                }
        
                return $result;
            } catch (PDOException $e) {
                throw new Exception("Error in selectWikiById: " . $e->getMessage());
            }
        }

        public  function searchWiki($key){
            $query="SELECT w.*, c.name AS category, GROUP_CONCAT(t.name) AS tags
            FROM wikis w
            JOIN categories c ON w.categorie_id = c.id
            LEFT JOIN wikis_tags wt ON w.id = wt.wiki_id
            LEFT JOIN tags t ON wt.tags_id = t.id
            WHERE w.title LIKE ?
            GROUP BY w.id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(["%$key%"]);
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        
        




    }


?>