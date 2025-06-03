<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado cuentas Revendedores</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Cuenta Revendedor</li>
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
              echo '<button class="btn btn-success" data-toggle="modal" data-target="#modalAsociarCuentaR">Asociar Cuenta Revendedor</button>';
            }
          ?>        
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered table-striped tablaAsociacionR" width="100%">
            <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Cuenta</th>
              <th>Password</th>
              <th>Corte</th>
              <th>Re-vendedor</th>
              <th>Telefono</th>
              <th>F. Termino</th>
              <th>Precio</th>
              <th>Días</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
            </thead>
          </table>
          <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!--=====================================
MODAL AGREGAR CUENTA
======================================-->
<div class="modal fade" id="modalAsociarCuentaR">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Asociar Cuenta Revendedor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">                         
              <!-- ENTRADA PARA EL TIPO DE CUENTA -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Cuenta Streaming:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <select class="form-control select2" style="width: 270px" id="terminoCuenta" onchange="ShowSelectedTermino();" name="nuevaAsocion">
                      <option selected="selected">Seleccionar Cuenta</option>
                      <?php
                        $item = null;
                        $valor = null;

                        $fecha = date('Y-m-d');

                        $cuentas = ControladorCuentas::ctrMostrarCuentas($item, $valor); 
                        
                        foreach ($cuentas as $key => $value) {

                          $item1 = "id";
                          $valor1 = $value["id_categoria"];

                          $categoria = ControladorStreaming::ctrMostrarStreaming($item1, $valor1);  
                          if($value["corte"] == "0000-00-00"){
                            if($value["modo_cuenta"] == "2" AND $value["ocupada"] == "0" AND $value["desactivado"] == "0"){
                            echo '<option value="'.$value["id"].'">'.$value["correo"].' - '.$categoria["nombre"].'</option>';
                            } 
                          }else{
                            if($value["modo_cuenta"] == "2" AND $value["ocupada"] == "0" AND $value["corte"] >= $fecha AND $value["desactivado"] == "0"){
                            echo '<option value="'.$value["id"].'">'.$value["correo"].' - '.$categoria["nombre"].'</option>';
                            } 
                          }                                                   
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA EL CORTE -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Corte:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nuevaFcorte" id="nuevaFcorte" placeholder="Fecha de corte" readonly>
                  </div>                    
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Termino cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nuevaFtermino" id="datepicker" placeholder="Fecha de Terminacion" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA LA CONTRASEÑA -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Valor Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Valor de la cuenta" name="nuevoPrecioC">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Nombre Cliente:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <select class="form-control select2" style="width: 270px" name="nuevoRevendedor">
                      <option selected="selected">Seleccionar Revendedor</option>
                      <?php
                        $item = null;
                        $valor = null;

                        $cuentas = ControladorUsuarios::ctrMostrarUsuario($item, $valor); 
                        
                        foreach ($cuentas as $key => $value) { 

                          if($value["perfil"] == "Revendedor"){
                            echo '<option value="'.$value["nombre"].'">'.$value["nombre"].'</option>';
                          }                          
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar Cuenta</button>
        </div> 
      </form>
      <?php
        $crearCuenta = new ControladorRevendedor();
        $crearCuenta -> ctrCuentaRevendedor();
      ?>     
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--=====================================
MODAL EDITAR USUARIO
======================================-->
<div class="modal fade" id="modalEditarRevendedor">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar Cuenta</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">              
              <!-- ENTRADA PARA EL TIPO DE CUENTA -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Cuenta Streaming:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <select class="form-control" style="width: 330px" id="editarTerminoCuenta" onchange="ShowSelectedTerminoE();" name="editarAsociacion">
                      <option selected="selected" id="editarAsociacion"></option>
                    </select>
                    <input type="hidden" class="form-control" name="editarCodigo" id="editarCodigo" readonly>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA EL CORTE -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Corte:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control" name="editarFcorte" id="editarFcorte" placeholder="Fecha de corte" readonly>
                  </div>                    
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Termino Revendedor:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control editarFtermino" name="editarFtermino" id="datepicker1" placeholder="Fecha de Terminacion" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA LA CONTRASEÑA -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Valor Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Valor de la cuenta" id="editarPrecioC" name="editarPrecioC">
                  </div>
                </div>
              </div>              
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Nombre Revendedor:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="editarRevendedor" name="editarRevendedor" placeholder="Nombre del Revendedor" required>
                  </div>
                </div>
              </div>
            </div>            
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Editar Cuenta Revendedor</button>
        </div> 
      </form>
      <?php
        $editarCuenta = new ControladorRevendedor();
        $editarCuenta -> ctrEditarRevendedor();
      ?> 
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--=====================================
MODAL EDITAR USUARIO
======================================-->
<div class="modal fade" id="modalRenovarRevendedor">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Renovar Cuenta</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">              
              <!-- ENTRADA PARA EL TIPO DE CUENTA -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Cuenta Streaming:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <select class="form-control" style="width: 270px" name="renovarAsociacion">
                      <option selected="selected" id="renovarAsociacion"></option>
                    </select>
                    <input type="hidden" class="form-control" name="renovarId" id="renovarId" readonly>
                    <input type="hidden" class="form-control" name="renovarCodigo" id="renovarCodigo" readonly>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA EL CORTE -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Corte:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control" name="renovarFcorte" id="renovarFcorte" placeholder="Fecha de corte" readonly>
                  </div>                    
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Termino Revendedor:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control renovarFtermino" name="renovarFtermino" id="datepicker2" placeholder="Fecha de Terminacion" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA LA CONTRASEÑA -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Valor Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Valor de la cuenta" id="renovarPrecioC" name="renovarPrecioC">
                  </div>
                </div>
              </div>              
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Nombre Revendedor:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="renovarRevendedor" name="renovarRevendedor" placeholder="Nombre del Revendedor" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Contraseña cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="text" class="form-control" id="renovarContrasena" name="renovarContrasena" placeholder="Renovar Contraseña" required>
                  </div>
                </div>
              </div>
            </div>            
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Renovar Cuenta Revendedor</button>
        </div> 
      </form>
      <?php
        $renovarCuenta = new ControladorRevendedor();
        $renovarCuenta -> ctrRenovarRevendedor();
      ?> 
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
  $borrarRevendedor = new ControladorRevendedor();
  $borrarRevendedor -> ctrBorrarRevendedor();
?>