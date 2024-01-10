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
 
        // $_SESSION['email'] = $email;
        // $_SESSION['firstname'] = $firstname;
        // $_SESSION['lastname']=$lastname;
        // $_SESSION['password']= $password;
      
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
            // var_dump($data);
            
          
       $_SESSION['email'] = $email;
                $_SESSION['role'] = $data->role_name;
                $_SESSION['id'] = $data->id;
            if(password_verify($password,$data->password)){

                    if ($data->role_name ==='admin') {
                        echo"admin";
                        }
                        else{
                            echo"user";
                        }
        }
            // if (!$data) {
            //     echo"email not on data base";
            //     $data->password;
            // }elseif(password_verify($password,$data->password)){
               
            //     $_SESSION['email'] = $email;
            //     $_SESSION['role'] = $data->role_name;
            //     $_SESSION['id'] = $data->id;
            //     if ($data->role_name ==='admin') {
            //         echo"admin";

            //         }else{
            //             echo"user";
            //         }
            // }
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
    // var_dump($res);
}




?>