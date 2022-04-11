<?php

class ControladorUsuarios{

    static public function ctrIngresoUsuario(){
        if(isset($_POST["entryUsuario"]) && isset($_POST["entryPassword"]))
        {
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["entryUsuario"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["entryPassword"])){

                $usuario = new ModeloUsuario();
                $usuario->readByUsername($_POST["entryUsuario"]);

                if($usuario->getPassword() == $_POST["entryPassword"])
                {
                    $_SESSION["iniciarSesion"] = True;

                    echo '<script>
                        window.location = "inicio";
                    </script>';
                }else{
                    echo '<br>';
                    echo '<div class="alert alert-danger">Error al ingresar</div>';
                }
            }
        }
    }

    static public function ctrMostrarUsuario(){

        $respuesta = new ModeloUsuario();

        return $respuesta->read();
    }

}