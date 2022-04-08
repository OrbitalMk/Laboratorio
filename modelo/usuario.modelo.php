<?php

require_once "conexion.php";

class ModeloUsuario{

    static public function mdlMostarUsuario($tabla, $item, $valor){
        $stmt = Conexion::conectar() -> prepare(
            "SELECT * FROM $tabla WHERE $item = :$item");

        $stmt -> bindParam(":$item", $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();
    }

}