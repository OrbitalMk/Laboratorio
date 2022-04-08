<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <img src="vistas/resources/logo-simalsi.svg">
        <br>
      <h1><b>SIMALSI</b></h1>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="entryUsuario" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="entryPassword" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>

        <?php
          $login = new ControladorUsuarios();
          $login -> ctrIngresoUsuario();
        ?>

      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->