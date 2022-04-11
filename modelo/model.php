<?php

class Model{

    private $host;
    private $db;
    private $user;
    private $password;
 
    public function __construct(){
        $this->host = constant('HOST');
        $this->db = constant('DATABASE');
        $this->user = constant('USER');
        $this->password = constant('PASSWORD');
    }

    private function conectar(){
        try{
            $connection = "mysql:host=".$this->host."; dbname=".$this->db;
            
            $pdo = new PDO($connection, $this->user, $this->password);

            return $pdo;
        }catch(PDOException $e){
            //
        }
    }

    function query($query){
        return $this->conectar()->query($query);
    }

    function prepare($query){
        return $this->conectar()->prepare($query);
    }

}