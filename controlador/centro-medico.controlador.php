<?php

class ControladorCentroMedico{

    static public function ctrMostrarCentroMedico(){

        $respuesta = new ModeloCentroMedico();

        return $respuesta->read();
    }

}