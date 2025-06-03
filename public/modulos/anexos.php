<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Anexos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Anexos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <?php
            if($_SESSION["perfil"] == "Administrador"){
              echo '<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarAnexo">Agregar Anexos</button>';
            }
          ?>        
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped tablas" width="100%">
            <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Tipo Cuenta</th>
              <th>Recordatorio</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
              <?php 
                $item = null;
                $valor = null;

                $anexo = ControladorAnexos::ctrMostrarAnexo($item, $valor);

                foreach ($anexo as $key => $value) {
                  echo '<tr>
                          <td>'.($key+1).'</td>';
                          if($value["tipo_cuenta"] == 1){
                            echo '<td>Completa</td>';
                          }else if($value["tipo_cuenta"] == 2){
                            echo '<td>Pantalla</td>';
                          }else{
                            echo '<td>Combo</td>';
                          }
                    echo '<td>'.$value["recordatorio"].'</td>';
                          if($value["estado"] == 1){
                            echo '<td><button class="btn btn-success btn-xs btnActivarAnexo" idAnexo="'.$value["id"].'" estadoAnexo="0">Activado</button></td>';
                          }else{
                            echo '<td><button class="btn btn-danger btn-xs btnActivarAnexo" idAnexo="'.$value["id"].'" estadoAnexo="1">Bloqueado</button></td>';
                          }
                    echo '
                          <td><div class="btn-group">                        
                          <button class="btn btn-warning btnEditarAnexo" idAnexo="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarAnexo"><i class="nav-icon fas fa-edit"></i> Editar</button>
                          <button class="btn btn-danger btnEliminarAnexo" idAnexo="'.$value["id"].'"><i class="fa fa-times"></i> Eliminar</button>
                        </div></td>
                        </tr>';
                }
              ?>
              
            </tbody>
            
            <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!--=====================================
MODAL AGREGAR ADMINISTRADOR
======================================-->
<div class="modal fade" id="modalAgregarAnexo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar Anexo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA EL NOMBRE -->            
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-tv"></i></span>
                  </div>
                  <select name="nuevotCuenta" class="form-control input-lg">
                    <option value="1">Cuenta Completa</option>
                    <option value="2">Pantalla</option>
                    <option value="3">Combos</option>
                  </select>
                </div>
              </div>

            <!-- ENTRADA PARA EL USUARIO -->            
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-comment-dots"></i></span>
                </div>
                <input class="form-control" name="nuevoAnexo">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar Anexo</button>
        </div> 
      </form>
      <?php
        $crearAnexo = new ControladorAnexos();
        $crearAnexo -> ctrNuevoAnexo();
      ?>     
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--=====================================
MODAL EDITAR ANEXO
======================================-->
<div class="modal fade" id="modalEditarAnexo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar Anexo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA EL NOMBRE -->            
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-tv"></i></span>
                  </div>
                  <select name="editartCuenta" class="form-control input-lg">
                    <option id="editartCuenta" ></option>
                    <option value="1">Cuenta Completa</option>
                    <option value="2">Pantalla</option>
                    <option value="3">Combos</option>
                  </select>
                  <input type="hidden" class="form-control" name="editarId" id="editarId">
                </div>
              </div>

            <!-- ENTRADA PARA EL USUARIO -->            
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-comment-dots"></i></span>
                </div>
                <input class="form-control" id="editarAnexo" name="editarAnexo">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Editar Anexo</button>
        </div> 
      </form>
      <?php
        $crearAnexo = new ControladorAnexos();
        $crearAnexo -> ctrEditarAnexo();
      ?>     
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
  $borrarAnexo = new ControladorAnexos();
  $borrarAnexo -> ctrBorrarAnexo();
?>