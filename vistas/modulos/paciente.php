<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1>Administrar paciente</h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar paciente</li>
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
            Agregar usuario
          </button>
        </div>
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover table-striped tablas">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Inss</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Sexo</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $pacientes = ControladorPaciente::ctrMostrarPaciente();

                foreach($pacientes as $paciente){
                  echo '<tr>';
                    echo '<td>'.$paciente->getId().'</td>';
                    echo '<td>'.$paciente->getNombres().' '.$paciente->getApellidos().'</td>';
                    echo '<td>'.$paciente->getEdad().'</td>';
                    echo '<td>'.$paciente->getInss().'</td>';
                    echo '<td>'.$paciente->getDireccion().'</td>';
                    echo '<td>'.$paciente->getTelefono().'</td>';
                    echo '<td>'.$paciente->getSexo().'</td>';
                    
                    if($paciente->getEstado()){
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