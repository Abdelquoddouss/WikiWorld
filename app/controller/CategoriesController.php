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
    $categories = $obj->AllCategories();
    return $categories ;
}

public function selectCategories2()
{
    $obj = new Categories(null, null);
    $categories = $obj->AllCategoriesby2();
    return $categories ;
}

public function deletCategory()
{
    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        $category = new Categories($id, null);
        $result = $category->deleteCategory();
    }

}


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