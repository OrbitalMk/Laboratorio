<?php

class ControladorDoctor{

    static public function ctrMostrarDoctor(){

        $respuesta = new ModeloDoctor();

        return $respuesta->read();
    }

}