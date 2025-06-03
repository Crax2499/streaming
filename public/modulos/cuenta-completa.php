<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado cuentas completas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Cuenta Completa</li>
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
              echo '<button class="btn btn-success" data-toggle="modal" data-target="#modalAsociarCuenta">Asociar Cliente a Cuenta</button>';
            }
          ?>        
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered table-striped tablaAsociacion" width="100%">
            <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Cuenta</th>
              <th>Contraseña</th>
              <th>Corte</th>
              <th>Cliente</th>
              <th>Telefono</th>
              <th>F. Termino</th>
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
<div class="modal fade" id="modalAsociarCuenta">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Asociar Cuenta</h4>
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
                            if($value["modo_cuenta"] == "1" AND $value["ocupada"] == "0" AND $value["desactivado"] == "0"){
                              echo '<option value="'.$value["id"].'">'.$value["correo"].' - '.$categoria["nombre"].'</option>';
                            }
                          }else{
                            if($value["modo_cuenta"] == "1" AND $value["ocupada"] == "0" AND $value["corte"] >= $fecha AND $value["desactivado"] == "0"){
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
                  <label>Fecha Termino Cliente:</label>
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
                    <input type="text" class="form-control" name="nuevaCliente" placeholder="Nombre del Cliente" required>
                  </div>
                </div>
              </div> 
              <!-- ENTRADA PARA LA CONTRASEÑA -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Numero de Teléfono:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="number" class="form-control" placeholder="Número de teléfono" name="nuevoNumero" value="57">
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
        $crearCuenta = new ControladorAsociar();
        $crearCuenta -> ctrAsociarCuenta();
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
<div class="modal fade" id="modalEditarAsociacion">
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
                    <select class="form-control" style="width: 270px" id="editarTerminoCuenta" onchange="ShowSelectedTerminoE();" name="editarAsociacion">
                      <option selected="selected" id="editarAsociacion"></option>
                    </select>
                    <input type="hidden" class="form-control" name="editarId" id="editarId" readonly>
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
                  <label>Fecha Termino Cliente:</label>
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
                  <label>Nombre Cliente:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="editarCliente" name="editarCliente" placeholder="Nombre del Cliente" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA LA CONTRASEÑA -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Numero de Teléfono:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="number" class="form-control" placeholder="Número de teléfono" id="editarNumero" name="editarNumero">
                  </div>
                </div>
              </div>
            </div>            
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Editar Cuenta Asociada</button>
        </div> 
      </form>
      <?php
        $editarCuenta = new ControladorAsociar();
        $editarCuenta -> ctrEditarAsociar();
      ?> 
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--=====================================
MODAL RENOVAR CUENTA COMPLETA
======================================-->
<div class="modal fade" id="modalRenovarAsociacion">
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
                    <select class="form-control" style="width: 270px" id="editarTerminoCuenta" onchange="ShowSelectedTerminoE();" name="renovarAsociacion">
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
                  <label>Fecha Termino Cliente:</label>
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
                  <label>Nombre Cliente:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="renovarCliente" name="renovarCliente" placeholder="Nombre del Cliente" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA LA CONTRASEÑA -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Numero de Teléfono:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="number" class="form-control" placeholder="Número de teléfono" id="renovarNumero" name="renovarNumero">
                  </div>
                </div>
              </div>
            </div>            
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Renovar Cuenta Asociada</button>
        </div> 
      </form>
      <?php
        $renovarCuenta = new ControladorAsociar();
        $renovarCuenta -> ctrRenovarAsociar();
      ?> 
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
  $borrarAsociacion = new ControladorAsociar();
  $borrarAsociacion -> ctrBorrarAsociacion();
?>