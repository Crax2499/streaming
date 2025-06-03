<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Cuentas Streaming</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Streaming</li>
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
              echo '<button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarCuenta">Crear Cuenta</button>';
            }
          ?>        
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered table-striped tablaCuentas" width="100%">
            <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Producto</th>
              <th>Correo</th>
              <th>contraseña</th>
              <th>Pin</th>
              <th>Precio</th>
              <th>Activación</th>
              <th>Facturación</th>
              <th>Corte</th>
              <th>Corte Cliente</th>
              <th>Cuenta</th>              
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
<div class="modal fade" id="modalAgregarCuenta">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Nueva Cuenta</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">              
              <!-- ENTRADA PARA EL TIPO DE CUENTA -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-key"></i></span>
                    </div>
                    <select style="text-transform: uppercase;" class="form-control input-lg" id="tipoCuenta" name="nuevoTipoCuenta" onchange="ShowSelected();">
                      <option value="">SELECCIONAR</option>
                      <?php
                        $item = null;
                        $valor = null;

                        $cuentas = ControladorStreaming::ctrMostrarStreaming($item, $valor); 
                        
                        foreach ($cuentas as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-5 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Correo electronico:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="text" class="form-control" id="_texto" placeholder="Ingresa el correo electronico" name="nuevoEmail" required>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Password Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-key"></i></span>
                    </div>
                    <input type="password" class="form-control" id="_textoPass" placeholder="Contraseña" name="nuevoPassword" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>PIN:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-code"></i></span>
                    </div>
                    <input type="text" class="form-control" id="_textoPin" placeholder="PIN" name="nuevoPin">
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA LA CONTRASEÑA -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Valor Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Valor de la cuenta" name="nuevoCostoPin">
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA TIPO DE CUENTA -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>TIPO DE CUENTA:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-tv"></i></span>
                    </div>
                    <select class="form-control input-lg" name="nuevoTipoCuentaP">
                      <option value="">Seleccionar</option>
                      <option value="1">Completa</option>
                      <option value="0">Pantallas</option>                      
                      <option value="2">Re-vendedor</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Activación:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nuevaFactivacion" id="datepicker" placeholder="Fecha de Activación">
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA EL TIPO SEGURIDAD -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Facturación:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nuevaFacturacion" id="datepicker1" placeholder="Fecha de Facturación">
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Corte:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nuevaFcorte" id="datepicker2" placeholder="Fecha de corte">
                    <input type="hidden" name="nuevaPantallas" id="nuevaPantallas" required>
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
        $crearCuenta = new ControladorCuentas();
        $crearCuenta -> ctrRegistroCuenta();
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
<div class="modal fade" id="modalEditarCuenta">
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
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-key"></i></span>
                    </div>
                    <select style="text-transform: uppercase;" class="form-control input-lg" name="editarTipoCuenta" id="editarTipoCuenta1" onchange="ShowSelected1();">
                      <option value="" id="editarTipoCuenta">SELECCIONAR</option>
                      <?php
                        $item = null;
                        $valor = null;

                        $cuentas = ControladorStreaming::ctrMostrarStreaming($item, $valor); 
                        
                        foreach ($cuentas as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-5 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Correo electronico:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="text" class="form-control editarEmail" placeholder="Ingresa el correo electronico" id="nuevoEmailCopia" name="editarEmail" required>
                    <input type="hidden" class="form-control" id="editarCodigo" name="editarCodigo" required>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Password Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-key"></i></span>
                    </div>
                    <input type="password" class="form-control" placeholder="Contraseña" id="editarPassword" name="editarPassword">
                    <input type="hidden" id="passwordActual" name="passwordActual">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>PIN:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-code"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="PIN" name="editarPin" id="editarPin">
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA LA CONTRASEÑA -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Valor Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Valor de la cuenta" id="editarCostoPin" name="editarCostoPin">
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA TIPO DE CUENTA -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>TIPO DE CUENTA:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-tv"></i></span>
                    </div>
                    <select class="form-control input-lg" name="editarTipoCuentaP">
                      <option value="" id="editarTipoCuentaP">Seleccionar</option>
                      <option value="1">Completa</option>
                      <option value="0">Pantallas</option>
                      <option value="2">Re-vendedor</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Activación:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control editarFactivacion" name="editarFactivacion" id="datepickerE" placeholder="Fecha de Activación" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA EL TIPO SEGURIDAD -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Facturación:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control editarFacturacion" name="editarFacturacion" id="datepicker1E" placeholder="Fecha de Facturación" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Corte:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control editarFcorte" name="editarFcorte" id="datepicker2E" placeholder="Fecha de corte" required>
                  </div>                    
                </div>
              </div>
            </div>
            <div class="row">
              <!-- EDITAR PARA LAS PANTALLAS -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Cantidad Pantallas:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-tv"></i></span>
                    </div>
                    <input type="text" class="form-control" id="editarPantallas" name="editarPantallas">
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA TIPO DE CUENTA -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Estado Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-tv"></i></span>
                    </div>
                    <select class="form-control input-lg" name="editarEstadoCuentaP">
                      <option value="" id="editarEstadoCuentaP">Seleccionar</option>
                      <option value="1">Ocupada</option>
                      <option value="0">Libre</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Editar Cuenta</button>
        </div> 
      </form>
      <?php
        $editarCuenta = new ControladorCuentas();
        $editarCuenta -> ctrEditarCuenta();
      ?> 
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--=====================================
MODAL RENOVAR USUARIO
======================================-->
<div class="modal fade" id="modalRenovarCuenta">
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
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-key"></i></span>
                    </div>
                    <select style="text-transform: uppercase;" class="form-control input-lg" name="renovarTipoCuenta" id="renovarTipoCuenta1" onchange="ShowSelected2();">
                      <option value="" id="renovarTipoCuenta">SELECCIONAR</option>
                      <?php
                        $item = null;
                        $valor = null;

                        $cuentas = ControladorStreaming::ctrMostrarStreaming($item, $valor); 
                        
                        foreach ($cuentas as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-5 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Correo electronico:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="text" class="form-control renovarEmail" placeholder="Ingresa el correo electronico" id="renovarEmail" name="renovarEmail" required>
                    <input type="hidden" class="form-control" id="renovarCodigo" name="renovarCodigo" required>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Password Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-key"></i></span>
                    </div>
                    <input type="password" class="form-control" placeholder="Contraseña" id="renovarPassword" name="renovarPassword">
                    <input type="hidden" id="passwordActualR" name="passwordActualR">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>PIN:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-code"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="PIN" name="renovarPin" id="renovarPin">
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA LA CONTRASEÑA -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Valor Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Valor de la cuenta" id="renovarCostoPin" name="renovarCostoPin">
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA TIPO DE CUENTA -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>TIPO DE CUENTA:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-tv"></i></span>
                    </div>
                    <select class="form-control input-lg" name="renovarTipoCuentaP">
                      <option value="" id="renovarTipoCuentaP">Seleccionar</option>
                      <option value="1">Completa</option>
                      <option value="0">Pantallas</option>
                      <option value="2">Re-vendedor</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Activación:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control renovarFactivacion" name="renovarFactivacion" id="datepickerR" placeholder="Fecha de Activación" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA EL TIPO SEGURIDAD -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Facturación:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control renovarFacturacion" name="renovarFacturacion" id="datepicker1R" placeholder="Fecha de Facturación" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Fecha Corte:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control renovarFcorte" name="renovarFcorte" id="datepicker2R" placeholder="Fecha de corte" required>
                  </div>                    
                </div>
              </div>
            </div>
            <div class="row">
              <!-- EDITAR PARA LAS PANTALLAS -->  
              <div class="col-md-4 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Cantidad Pantallas:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-tv"></i></span>
                    </div>
                    <input type="text" class="form-control" id="renovarPantallas" name="renovarPantallas">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Renovar Cuenta</button>
        </div> 
      </form>
      <?php
        $renovarCuenta = new ControladorCuentas();
        $renovarCuenta -> ctrRenovarCuenta();
      ?> 
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
  $eliminarCuenta = new ControladorCuentas();
  $eliminarCuenta -> ctrBorrarCuenta();
?>