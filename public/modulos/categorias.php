<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Categorias</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar categorias</li>
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
            echo '<button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarCategoria">Categoria Streaming</button>';
          }
        ?>        
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped dt-responsive tablas" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Streaming</th>
              <th>Cantidad Pantallas</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>          
          <tbody>
            <?php 
              $item = null;
              $valor = null;

              $streaming = ControladorStreaming::ctrMostrarStreaming($item, $valor);

              foreach ($streaming as $key => $value){
                echo '
                <tr>
                  <td>'.($key+1).'</td>
                  <td style="text-transform: uppercase;">'.$value["nombre"].'</td>
                  <td>'.$value["pantallas"].' PERFILES</td>';
                  if($value["estado"] != 0){
                    echo '<td><button class="btn btn-success btn-xs btnActivarCategoria" idCategoria="'.$value["id"].'" estadoCategoria="0">Activado</button></td>';
                  }else{
                    echo '<td><button class="btn btn-danger btn-xs btnActivarCategoria" idCategoria="'.$value["id"].'" estadoCategoria="1">Bloqueado</button></td>';
                  }
                  
                 echo '<td>
                        <div class="btn-group">                        
                          <button class="btn btn-warning btnEditarStreaming" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarStreaming"><i class="nav-icon fas fa-edit"></i> Editar</button>
                          <button class="btn btn-danger btnEliminarStreaming" idCategoria="'.$value["id"].'"><i class="fa fa-times"></i> Eliminar</button>
                        </div>
                      </td>
                </tr>';
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

<!--=====================================
MODAL AGREGAR ADMINISTRADOR
======================================-->
<div class="modal fade" id="modalAgregarCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar Categoria Streaming</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="row">
              <div class="col-7" style="padding-left: 1px; padding-right: 5px">
                <div class="form-group">
                  <label>Nombre Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-file-invoice"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Ingresa el nombre" name="nuevoNombre" required>
                  </div>
                </div>
              </div>

              <div class="col-5" style="padding-left: 1px; padding-right: 5px">
              <!-- ENTRADA PARA LA CANTIDAD DE PANTALLAS -->
                <div class="form-group">
                  <label>Cantidad Pantallas:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-tv"></i></span>
                    </div>
                    <input type="number" class="form-control" placeholder="Pantallas" name="nuevaCantidad" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar Streaming</button>
        </div> 
      </form>
      <?php
        $crearStreaming = new ControladorStreaming();
        $crearStreaming -> ctrRegistroStreaming();
      ?>     
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--=====================================
MODAL AGREGAR ADMINISTRADOR
======================================-->
<div class="modal fade" id="modalEditarStreaming">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar Categoria Streaming</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="row">
              <div class="col-7" style="padding-left: 1px; padding-right: 5px">
                <div class="form-group">
                  <label>Nombre Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-file-invoice"></i></span>
                    </div>
                    <input type="text" class="form-control" style="text-transform: uppercase;" placeholder="Edita el nombre" id="editarNombre" name="editarNombre" required>
                    <input type="hidden" class="form-control" id="editarId" name="editarId" required>
                  </div>
                </div>
              </div>

              <div class="col-5" style="padding-left: 1px; padding-right: 5px">
              <!-- ENTRADA PARA LA CANTIDAD DE PANTALLAS -->
                <div class="form-group">
                  <label>Cantidad Pantallas:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-tv"></i></span>
                    </div>
                    <input type="number" class="form-control" placeholder="Edita Pantallas" name="editarCantidad" id="editarCantidad" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Editar Streaming</button>
        </div>
      </form>
      <?php
        $editarStreaming = new ControladorStreaming();
        $editarStreaming -> ctrEditarStreaming();
      ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
  $borrarStreaming = new ControladorStreaming();
  $borrarStreaming -> ctrBorrarStreaming();
?>