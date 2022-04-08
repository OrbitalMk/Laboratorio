<?php

class ControladorUsuarios{

    public function ctrIngresoUsuario(){
        if(isset($_POST["entryUsuario"]) && isset($_POST["entryPassword"]))
        {
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["entryUsuario"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["entryPassword"])){
                $result = ModeloUsuario::mdlMostarUsuario("Recepcionista",
                    "usuario", $_POST["entryUsuario"]);

                if($result["pass"] == $_POST["entryPassword"])
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

}