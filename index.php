<?php

require_once "controlador/plantilla.controlador.php";
require_once "controlador/usuario.controlador.php";
require_once "controlador/paciente.controlador.php";
require_once "controlador/doctor.controlador.php";
require_once "controlador/centro-medico.controlador.php";

require_once "modelo/model.php";
require_once "modelo/imodel.php";
require_once "modelo/usuario.modelo.php";
require_once "modelo/paciente.modelo.php";
require_once "modelo/doctor.modelo.php";
require_once "modelo/centro-medico.modelo.php";

require_once "config/config.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();