<?php
 namespace app\controller;
 if (session_status() === PHP_SESSION_NONE) {
    session_start();
}  
 
 
 use app\model\Wikis;
 
 use Exception;
 include __DIR__ . '/../../vendor/autoload.php';
 


 class WikisController
 {
    public function processForm() {
       
            $description = $_POST['description'];
            $title = $_POST['title'];
            $categories_id = $_POST['categories_id'];
            $user_id = $_SESSION['userid'];
            $tagId = $_POST['tagId'];
            $name = $_FILES['img']['name'];
            $temp = $_FILES['img']['tmp_name'];
            $upload_folder = "../../public/imgs/".$name;
            if(move_uploaded_file($temp , $upload_folder)){
                $result= new Wikis($description, $title, null, null, null, $upload_folder, $categories_id, $user_id);
                $result->InsertWiki($tagId);

             header("location:../../views/client/wiki.php");
            }
               
    }

    public function selectWikis()
    {
        $obj = new Wikis('','','','','','','','');
        $wikis = $obj->getAcceptedWiki();
        return $wikis;
    
    }


    public function deletewiki($id)
    {
        $id = $_GET['id'];
        $obj = new Wikis($id,'','','','','','','');
        $obj->delete($id);
        
    }
    


    public function selectWikis2()
    {
        $obj = new Wikis('','','','','','','','');
        $wikis = $obj->getAllWikis2();
       
        return $wikis;
    
    }
    

    public function selectWikiById($id) {
        try {
            $obj = new Wikis('','','', $id,'','','',''); 
            $wiki = $obj->selectWikiById($id);
            return $wiki;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }



 }



 if(isset($_GET['search'])){
    $search = $_GET['search'];
    $wiki= new Wikis(null,null,null,null,null,null,null,null);
   $wikis= $wiki->searchWiki($search);
  header("content-type:application/json");
  echo json_encode($wikis);
 }


 if (isset($_POST['submit_wiki'])) {
    $auth = new WikisController();
    $auth->processForm();
}

if(isset($_GET['acceptid'])){
    $wikiaccept = $_GET['acceptid'];
    $wiki = new Wikis(null,null,null,null,null,null,null,null);
    $wiki->acceptWiki($wikiaccept);
    header("location:../../views/admin/DachboardWiki.php");
}

if(isset($_GET['refuseid'])){
    $wikirefuse = $_GET['refuseid'];
    $wiki = new Wikis(null,null,null,null,null,null,null,null);
    $wiki->refuseWiki($wikirefuse);
    header("location:../../views/admin/DachboardWiki.php");
}

if (isset($_GET['id']) && isset($_POST['update'])) {
    $id = $_GET['id']; 
    $description = $_POST['description'];
    $title = $_POST['title'];
    $img = $_POST['img'];    
    $update = new Wikis($description, $title, '', '', '', $img, '', '');
    $update->update($id);
    header("location:../../views/client/Wiki.php");
} 
?>