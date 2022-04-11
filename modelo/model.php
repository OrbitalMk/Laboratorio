<?php

class Model{

    public function __construct(){
        $this->db = new Conexion();
    }

    function query($query){
        return $this->db->conectar()->query($query);
    }

    function prepare($query){
        return $this->db->conectar()->prepare($query);
    }

}