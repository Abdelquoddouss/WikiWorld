<?php
 namespace app\model;

 include __DIR__ . '/../../vendor/autoload.php';

 use app\connection\connection;
 use PDO;


 class User
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

    public function getUserByUsername(){ 
        $sql="SELECT u.*, r.name AS role_name FROM users as u
        INNER JOIN role as r ON r.id = u.role_id WHERE u.email =? ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->email]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        // $stmt->closeCursor();
        return $row;
        
    }














 }



?>