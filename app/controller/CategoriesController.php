<?php

namespace app\controller;
include __DIR__ . '/../../vendor/autoload.php';

use app\model\Categories;


class CategoriesController
{

    public function AjouteCategories()
    {
        $name = $_POST['name'];

        $result= new Categories(null,$name);
        $result->InsertCategorie();
        if($result){
            header("location: ../../views/admin/Ajoute.php");
        }
    }

    public function selectCategories()
{
    $obj = new Categories(null, null);
    return $obj->AllCategories();
}

public function deletCategory()
{
    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        
        $category = new Categories($id, null);
        $result = $category->deleteCategory();
    }

}

// public function updateCategory()
// {
//     if (isset($_POST['update_categories'])) {
//         $id = $_POST['category_id'];
//         $name = $_POST['name'];

//         $category = new Categories($id, $name);
//         $result = $category->updateRecord($id, $name);
//     }
// }



}


if (isset($_POST['submit_categories'])) {
    $auth = new CategoriesController();
    $auth->AjouteCategories();
}

if (isset($_GET['delete_id'])) {
    $auth = new CategoriesController();
    $auth->deletCategory();
}


?>