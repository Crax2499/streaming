<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado cuentas Inhabilitadas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Cuentas Inhabilitadas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped tablas" width="100%">
            <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Cuenta</th>
              <th>Contraseña</th>
              <th>Fechas</th>
              <th>Plataforma</th>
              <th>Estado</th>
            </tr>
            </thead>
            <tbody>
              <?php
                $item = null;
                $valor = null;

                $cuentas = ControladorCuentas::ctrMostrarCuentas($item, $valor);

                foreach ($cuentas as $key => $value){
                  if($value["desactivado"] == 1){
                    $item = "id";
                    $valor = $value["id_categoria"];

                    $categoria = ControladorStreaming::ctrMostrarStreaming($item, $valor);

                    echo '
                        <tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["correo"].'</td>
                          <td class="text-start">'.$value["password"].'</td>
                          <td class="text-start">activacion: '.$value["activacion"].'</td>
                          <td>'.$categoria["pin"].'</td>
                          <td><button class="btn btn-success btn-sm btnActivarC" idCuenta="'.$value["id"].'" estadoCuenta="0">Activar Cuenta</button></td>
                        </tr>';
                  }                  
                }
              ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->