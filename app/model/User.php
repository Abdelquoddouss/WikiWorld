<?php
 namespace app\model;
 include __DIR__ . '/../../vendor/autoload.php';

 use app\connection\Connection;
 use PDO;


 class user
 {
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $db;
    private $id;


    public function __construct($id,$firstname,$lastname,$email,$password,$db)
    {
        $this->db = Connection::getInstence()->getConnect();
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
    }

    public function createUser()
    {

        $query = "INSERT INTO `users` (firstName, lastName, email, password,role_id) VALUES (?, ?, ?, ?,2)";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $this->firstname);
        $stmt->bindParam(2, $this->lastname);
        $stmt->bindParam(3, $this->email);
        $stmt->bindParam(4, $this->password);
        $stmt->execute();

    }














 }



?>