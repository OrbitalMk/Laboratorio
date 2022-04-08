<?php

require_once "controlador/plantilla.controlador.php";
require_once "controlador/usuario.controlador.php";
require_once "controlador/paciente.controlador.php";
require_once "controlador/doctor.controlador.php";
require_once "controlador/centro-medico.controlador.php";

require_once "modelo/usuario.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();