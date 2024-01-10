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
            $img = file_get_contents($_FILES['img']['tmp_name']);
            // var_dump($img);
            $result= new Wikis($description, $title, $status,null,null, $img);
            $result->InsertWiki();
          

    }


 }



 if (isset($_POST['submit_wiki'])) {
    $auth = new WikisController();
    $auth->processForm();
}


?>