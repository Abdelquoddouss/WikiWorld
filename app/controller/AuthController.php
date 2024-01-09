<?php

namespace app\controller;
include __DIR__ . '/../../vendor/autoload.php';

use app\model\User;

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
      
        header('location:../login   ');  
    }













}






?>