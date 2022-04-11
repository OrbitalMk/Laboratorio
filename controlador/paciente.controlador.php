<?php

class ControladorPaciente{

    static public function ctrMostrarPaciente(){

        $respuesta = new ModeloPaciente();

        return $respuesta->read();
    }

}