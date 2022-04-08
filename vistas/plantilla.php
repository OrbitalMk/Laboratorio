<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Blank Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <!--<link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">-->
  <link rel="stylesheet" href="../font-awesome/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">

  <!--DataTables-->
  <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link rel="icon" href="vistas/resources/logo-simalsi.svg">
</head>

<?php
  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"]){
    
    echo '<body class="hold-transition sidebar-mini">';
    echo '<div class="wrapper">';
    include "vistas/modulos/header.php";
    include "vistas/modulos/menu.php";

    if(isset($_GET["ruta"])){

      if($_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "usuario" ||
        $_GET["ruta"] == "paciente" ||
        $_GET["ruta"] == "doctor" ||
        $_GET["ruta"] == "centro-medico" ||
        $_GET["ruta"] == "salir"){
          include "vistas/modulos/".$_GET["ruta"].".php";
        }
        else{
          include "vistas/modulos/404.php";
        }
    }

    include "vistas/modulos/footer.php";

  }else{

    echo '<body class="hold-transition  login-page" style="background: blue;">';
    echo '<div class="login-box">';
    include "vistas/modulos/login.php";
  }
?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="vistas/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="vistas/dist/js/demo.js"></script>
<!-- DataTables  & Plugins -->
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="vistas/plugins/jszip/jszip.min.js"></script>
<script src="vistas/plugins/pdfmake/pdfmake.min.js"></script>
<script src="vistas/plugins/pdfmake/vfs_fonts.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="vistas/js/plantilla.js"></script>

</body>
</html>
