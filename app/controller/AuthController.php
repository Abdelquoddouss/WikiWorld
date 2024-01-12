<?php

namespace app\controller;
include __DIR__ . '/../../vendor/autoload.php';

use app\model\User;
session_start();



class AuthController
{
    public function Register()
    {
        $email=$_POST['email'];
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $password=$_POST['password'];

        $password = password_hash($password,PASSWORD_DEFAULT);
        $objuser= new User(null,$firstname,$lastname,$email,$password,null);
        $objuser->createUser();

        header('location:../../views/auth/login.php  ');  
    }

    public function login()
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email) || empty($password)){
            echo"von avez pas enregistrer le nom et prenom";
        }else {
            $obj= new User(null,null,null,$email,$password,null);
            $data=$obj->getUserByUsername();
            
            if(password_verify($password,$data->password)){

                    if ($data->role_name ==='admin') {
                        $_SESSION['role'] = $data->role_name;
                        header('location:../../views/admin/Dachboard.php');
                    }else{
                            $_SESSION['role'] = $data->role_name;
                            var_dump($_SESSION['role']);
                            header('location:../../index.php');
                        }
        }
            
      }
    }

    public function SelectUser(){
        $obj = new User('','','','','','');
        $users = $obj->SelectAllUser();
        return $users;


      }

      public function deletUser(){
        if (isset($_GET['delete_id'])) {
            $id = $_GET['delete_id'];
            
            $use = new User($id, null,null,null,null,null);
            $result = $use->deleteUser();
        }
      }

}


if (isset($_POST['submit_register'])) {
    $auth = new AuthController();
    $auth->Register($_POST["firstname"],$_POST["lastname"],$_POST["email"],$_POST["password"]);
}

if (isset($_POST['login_submit'])) {
    $auth = new AuthController();
    $res= $auth->login($_POST["email"],$_POST["password"]);
}

if (isset($_GET['delete_id'])) {
    $auth = new AuthController();
    $auth->deletUser();
}


?>