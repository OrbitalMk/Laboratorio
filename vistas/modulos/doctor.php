<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1>Administrar doctor</h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar doctor</li>
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
                <th>Cod. Sanitario</th>
                <th>Telefono</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Jonathan Alexander Guillen Lainez</td>
                <td>1154</td>
                <td>882857411</td>
                <td><button class="btn btn-success btn-sm">Activado</button></td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btn-sm" style="color: white;"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
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