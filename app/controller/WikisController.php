<?php

 namespace app\controller;

include __DIR__ . '/../../vendor/autoload.php';

 use app\model\Wikis;
 use Exception;



 class WikisController
 {
    public function processForm() {
       
            $description = $_POST['description'];
            $title = $_POST['title'];
            $categories_id = $_POST['categories_id'];
            $status = $_POST['status'];
            $name = $_FILES['img']['name'];
            $temp = $_FILES['img']['tmp_name'];
            $upload_folder = "../../public/imgs/".$name;
            // var_dump($img);
            if(move_uploaded_file($temp , $upload_folder)){
               $result= new Wikis($description, $title, $status,null,null, $upload_folder,$categories_id);
               $result->InsertWiki();
            }
               
          

    }

    public function selectWikis()
    {
        $obj = new Wikis('','','','','','','');
        $wikis = $obj->getAllWikis();
        return $wikis;
    
    }



    public function selectWikis2()
    {
        $obj = new Wikis('','','','','','','');
        $wikis = $obj->getAllWikis2();
        return $wikis;
    
    }



    public function selectWikiById($id) {
        try {
            $obj = new Wikis('','','', $id,'','',''); 
            $wiki = $obj->selectWikiById($id);
            return $wiki;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    

 }

 if(isset($_GET['search'])){
    $search = $_GET['search'];
    $wiki= new Wikis(null,null,null,null,null,null,null);
 $wikis= $wiki->searchWiki($search);
  header("content-type:application/json");
  echo json_encode($wikis);
 }

 if (isset($_POST['submit_wiki'])) {
    $auth = new WikisController();
    $auth->processForm();
}



?>