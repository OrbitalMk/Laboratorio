<?php

class Conexion{

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

    public function conectar(){
        try{
            $connection = "mysql:host=".$this->host."; dbname=".$this->db;
            
            $pdo = new PDO($connection, $this->user, $this->password);
            $pdo->exec("set names utf-8");

            return $pdo;
        }catch(PDOException $e){
            // Mandar error al errolog
        }
    }

}