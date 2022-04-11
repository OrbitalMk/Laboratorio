<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1>Administrar usuario</h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administar usuarios</li>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
            Agregar paciente
          </button>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover table-striped tablas">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Cedulas</th>
                <th>Telefono</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $usuarios = ControladorUsuarios::ctrMostrarUsuario();

                foreach($usuarios as $usuario){
                  echo '<tr>';
                    echo '<td>'.$usuario->getId().'</td>';
                    echo '<td>'.$usuario->getNombres().' '.$usuario->getApellidos().'</td>';
                    echo '<td>'.$usuario->getUsuario().'</td>';
                    echo '<td><img src="vistas/resources/zoe.png" class="btn-thumbnail" width="30px"></td>';
                    echo '<td>'.$usuario->getCedula().'</td>';
                    echo '<td>'.$usuario->getTelefono().'</td>';
                    echo '<td>'.$usuario->getPerfil().'</td>';

                    if($usuario->getEstado()){
                      echo '<td><button class="btn btn-success btn-sm">Activado</button></td>';
                    }else{
                      echo '<td><button class="btn btn-danger btn-sm">Desactivado</button></td>';
                    }
                    
                    echo '<td>';
                      echo '<div class="btn-group">';
                        echo '<button class="btn btn-warning btn-sm" style="color: white;"><i class="fa fa-pencil"></i></button>';
                        echo '<button class="btn btn-danger btn-sm"><i class="fa fa-x"></i></button>';
                      echo '</div>';
                    echo '</td>';
                  echo '</tr>';
                }

              ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->