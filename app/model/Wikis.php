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
        private $user_id;

        public function __construct($description,$title,$status,$id,$db,$img,$categories_id, $user_id)
        {
            $this->db = Connection::getInstence()->getConnect();
            $this->id = $id;
            $this->description = $description;
            $this->title = $title;
            $this->status = $status;
            $this->img = $img;
            $this->categories_id = $categories_id;
            $this->user_id = $user_id;
        }

        public function delete($id) {
            try {
                $query = "DELETE FROM wikis WHERE id = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->execute();
                return true;
            } catch (Exception $e) {
                echo "Erreur : " . $e->getMessage();
                return false;
            }
        }

        public function update($id){
            try {
                $query = "UPDATE `wikis` SET `description`=?, `title`=?, `img`=? WHERE id = ?";
                $stmt = $this->db->prepare($query);
                $stmt->execute([
                    $this->description,
                    $this->title,
                    $this->img,
                    $id
                ]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        
        

        public function InsertWiki($tagId)
        {
            $query = "INSERT INTO `wikis`(`description`, `title`, `status`, `img`,`categorie_id`, `user_id`) VALUES (?, ?, ?, ?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1,$this->description);
            $stmt->bindParam(2,$this->title);
            $stmt->bindParam(3,$this->status);
            $stmt->bindParam(4,$this->img);
            $stmt->bindParam(5,$this->categories_id);
            $stmt->bindParam(6,$this->user_id);
            $result = $stmt->execute();
            $wikiId = $this->db->lastInsertId();
            if($result){
                $query = "INSERT INTO `wikis_tags`(`wiki_id`, `tags_id`) VALUES (? , ?)";
                $stmt = $this->db->prepare($query);
                $stmt->execute([$wikiId , $tagId]);
            }
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
                $query = "SELECT * FROM `wikis` WHERE status = 'accepted' ORDER BY id DESC LIMIT 4";
                
                $stmt = $this->db->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll();
                return $result;
                header("location:../../views/admin/DchboardWiki.php");
            }
            catch(PDOException $e){
                echo "Error".$e->getMessage();
            }
        }


        public function selectWikiById($id) {
            try {
                $query = "SELECT wikis.id AS wiki_id,
 wikis.title,
    wikis.description,
    wikis.status,
    wikis.img,
    categories.name AS category_name, GROUP_CONCAT(tags.name) AS tag_names
FROM
    wikis
JOIN
    categories ON wikis.categorie_id = categories.id
LEFT JOIN
    wikis_tags ON wikis.id = wikis_tags.wiki_id
LEFT JOIN
    tags ON wikis_tags.tags_id = tags.id
WHERE
    wikis.id = ? 
GROUP BY
    wikis.id, wikis.title, wikis.description, wikis.status, wikis.img, categories.name;";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $result = $stmt->fetch();
        
                if (!$result) {
                    throw new Exception("Wiki not found with ID: " . $id); 
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
        
        public function acceptWiki($id){
                $sql="UPDATE wikis SET status = :status
                WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $archivedValue = 'accepted';
                $stmt->bindParam(':status',$archivedValue);
                $stmt->bindParam(':id',$id);
                $stmt->execute();
            }

            public function refuseWiki($id){
                $sql="UPDATE wikis SET status = :status
                WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $archivedValue = 'refused';
                $stmt->bindParam(':status',$archivedValue);
                $stmt->bindParam(':id',$id);
                $stmt->execute();
            }

            public function getAcceptedWiki(){
                $sql="SELECT wikis.*, categories.name AS category, GROUP_CONCAT(tags.name) AS tags
                FROM wikis
                LEFT JOIN categories ON wikis.categorie_id = categories.id
                LEFT JOIN wikis_tags ON wikis.id = wikis_tags.wiki_id
                LEFT JOIN tags ON wikis_tags.tags_id = tags.id
                WHERE status = 'accepted'
                GROUP BY wikis.id";
                $stmt = $this->db->prepare($sql) ;
                $stmt->execute();
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $row;
            }



        }
        
        




    


?>