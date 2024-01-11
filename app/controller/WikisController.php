<?php

 namespace app\controller;

include __DIR__ . '/../../vendor/autoload.php';

 use app\model\Wikis;



 class WikisController
 {
    public function processForm() {
       
            $description = $_POST['description'];
            $title = $_POST['title'];
            $status = $_POST['status'];
            $name = $_FILES['img']['name'];
            $temp = $_FILES['img']['tmp_name'];
            $upload_folder = "../../public/imgs/".$name;
            // var_dump($img);
            if(move_uploaded_file($temp , $upload_folder)){
               $result= new Wikis($description, $title, $status,null,null, $upload_folder);
               $result->InsertWiki();
            }
               
          

    }

    public function selectWikis()
    {
        $obj = new Wikis('','','','','','');
        $wikis = $obj->getAllWikis();
        return $wikis;
    
    }


    public function selectWikiById($id) {
      $obj = new Wikis('', '', '', $id, '', ''); 
      $wiki = $obj->selectWikiById($id);
      return $wiki;
  }

 }



 if (isset($_POST['submit_wiki'])) {
    $auth = new WikisController();
    $auth->processForm();
}



?>