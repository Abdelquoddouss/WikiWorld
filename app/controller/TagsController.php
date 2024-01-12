<?php
namespace app\controller;
include __DIR__ . '/../../vendor/autoload.php';

use app\model\Tags;

class TagsController
{
    public function AjouteTag()
    {
        $name = $_POST['name'];

        $result= new Tags(null,$name);
        $result->InsertTag();
        if($result){
            header("location: ../../views/admin/AjouteTags.php");
        }
    }

    public function selectTags()
{
    $obj = new Tags(null, null);
    $tags =  $obj->AllTags();
    return $tags;

}


public function deletTags()
{
    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        
        $category = new Tags($id, null);
        $result = $category->deleteTags();
    }

}


}

if (isset($_POST['submit_Tags'])) {
    $auth = new TagsController();
    $auth->AjouteTag();
}


if (isset($_GET['delete_id'])) {
    $auth = new TagsController();
    $auth->deletTags();
}




?>