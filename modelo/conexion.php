<?php

class Conexion{

    public function conectar(){
        $link = new PDO("mysql:host=localhost; dbname=Laboratorio",
            "root",
            "");

        $link -> exec("set names utf-8");

        return $link;
    }

}