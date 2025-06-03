<?php 
  error_reporting(0);
?>
<div id="back"></div>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="public/img/plantilla/logo.png" class="img-responsive" width="100%" style="padding:0px 50px 0px 50px">
    </div>
    <div class="card-body">
      <p class="login-box-msg">Iniciar sesión</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="ingUsuario" placeholder="Ingresar Usuario" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="ingPassword" placeholder="Contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <?php
            $ingreso = new ControladorUsuarios();
            $ingreso -> ctrIngresoUsuario();
          ?>       
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block btnIngreso">Iniciar Sesión</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->