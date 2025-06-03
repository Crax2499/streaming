<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado Pantallas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Cuenta Pantalla</li>
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
              echo '<button class="btn btn-success" data-toggle="modal" data-target="#modalAsociarPantalla">Asociar Cliente a Pantalla</button>';
            }
          ?>        
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped tablas" width="100%">
            <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Cuenta</th>
              <th>Pass Cuenta</th>
              <th>Pantalla</th>
              <th>Contraseña</th>
              <th>Corte</th>
              <th>Cliente</th>
              <th>Telefono</th>
              <th>F.Termino</th>
              <th>Días</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
              <?php 
                $item = null;
                $valor = null;

                $respuesta = ControladorPantalla::ctrMostrarPantalla($item, $valor);

                foreach ($respuesta as $key => $value) {
                  $item1 = "id";
                  $valor1 = $value["id_cuenta"];

                  $cuenta = ControladorCuentas::ctrMostrarCuentas($item1, $valor1);

                  $valor2 = $cuenta["id_categoria"];      

                  $streaming = ControladorStreaming::ctrMostrarStreaming($item1, $valor2);

                  $item2 = "tipo_cuenta";
                  $valor3 = "2";

                  $anexos = ControladorAnexos::ctrMostrarAnexo($item2, $valor3);

                  if($anexos["estado"]=="1"){
                    $completa = $anexos["recordatorio"];
                  }else{
                    $completa="";
                  }

                  date_default_timezone_set("America/Bogota");
                  $fecha = date("Y-m-d");
                  /*=============================================
                  FECHAS DÍAS RESTANTES
                  =============================================*/
                  $fecha1= new DateTime($fecha);
                  $fecha2= new DateTime($value["fecha_termino"]);
                  $diff = $fecha1->diff($fecha2);

                  // El resultados sera 3 dias
                  if ($value["fecha_termino"] < $fecha){
                    $diasF = "0 dias";
                  }else{
                    $diasF = "".$diff->days." días";
                  }

/*=============================================
                    ESTADO
                    =============================================*/
                    if($_SESSION["perfil"] == "Administrador"){
                      if($fecha == $value["fecha_termino"]){
                        $buttonEstado = "<a href='https://api.whatsapp.com/send?phone=".$value["telefono"]."&text=Buen%20d%C3%ADa%20¿c%C3%B3mo%20vas?%0AYa%20hoy%20a%20las%206:00%20p.m.%20es%20tu%20corte%20del%20servicio%20%2A".urlencode($value["pantalla"])."-".$streaming["nombre"]."%2A%0AQuer%C3%ADa%20confirmar%20si%20desea%20renovarla%20Cualquier%20cosa%20qued%C3%B3%20atento...📝%0A".$completa."' target='_blank'><button class='btn btn-warning btn-sm'>Aviso Corte HOY</button></a>";
                    }else if($fecha > $value["fecha_termino"]){
                      $buttonEstado = "<a href='https://api.whatsapp.com/send?phone=".$value["telefono"]."&text=Buen%20d%C3%ADa%20¿c%C3%B3mo%20vas?...%20Queremos%20informarte%20que%20tu%20cuenta%20ha%20sido%20desactivada...%20Quer%C3%ADamos%20confirmar%20si%20desea%20renovarla...%20Cualquier%20cosa%20qued%C3%B3%20atento...%F0%9F%93%9D' target='_blank'><button class='btn btn-danger btn-sm'>Cuenta Desactivada</button></a>";
                    }else if($diff->days <= "3" and $diff->days >= "2"){
                      $buttonEstado = "<a href='https://api.whatsapp.com/send?phone=".$value["telefono"]."&text=Buen%20día%20¿Cómo%20vas?...%0A%0AServicio:%20".urlencode($value["pantalla"])."-".$streaming["nombre"]."%0ACorte:%20".$value["fecha_termino"]."%0A%0AQuería%20confirmar%20renovación...%20Cualquier%20cosa%20quedó%20atento...%20📝%20Gracias%20😁%0A%0A".$completa."' target='_blank'><button class='btn btn-warning btn-sm'>Aviso Corte</button></a>";
                    }else if($diff->days == "1"){
                      $buttonEstado = "<a href='https://api.whatsapp.com/send?phone=".$value["telefono"]."&text=Buen%20día%20¿Cómo%20vas?...%0A%0AServicio:%20".urlencode($value["pantalla"])."-".$streaming["nombre"]."%0ACorte:%20".$value["fecha_termino"]."%0A%0AQuería%20confirmar%20renovación...%20Cualquier%20cosa%20quedó%20atento...%20📝%20Gracias%20😁%0A%0A".$completa."' target='_blank'><button class='btn btn-warning btn-sm'>Aviso Corte</button></a>";
                    }else if($diff->days > "3"){
                      $buttonEstado = "<a href='https://api.whatsapp.com/send?phone=".$value["telefono"]."&text=%2ABienvenid%40%20a%20FAV%20Stream%20EC%20🍿🎬%2A%0A_%2A📲Plataforma:%2A_%20".$streaming["nombre"]."%0A_%2A📩Correo:%2A_%20".urlencode($cuenta["correo"])."%0A_%2A🔓Clave:%2A_%20".urlencode($cuenta["password"])."%0A_%2A🗣Usuario:%2A_%20".$value["pantalla"]."%0A_%2A🔐Pin%20Perfil:%2A_%20".$value["pass"]."%0A_%2A📅Vence:%2A_%20".$value["fecha_termino"]."%0A%0A-%20♻%20Si%20desea%20renovar%20cancelar%20unos%20dias%20antes%0A-%20⏯️%20Disfrute%20de%20nuestro%20servicio%20😊' target='_blank'><button class='btn btn-success btn-sm'>pantalla Activa</button></a>";
                    }
                  }else{
                    if($fecha < $value["fecha_termino"]){
                      $buttonEstado = "<button class='btn btn-success btn-sm'>Cuenta Activa</button>";
                    }else if($fecha == $value["fecha_termino"]){
                      $buttonEstado = "<button class='btn btn-warning btn-sm'>Aviso Corte</button>";
                    }else{
                      $buttonEstado = "<button class='btn btn-danger btn-sm'>Renovar Cuenta</button>";
                    }
                  }

                  if($_SESSION["perfil"] == "Administrador" && $fecha < $value["fecha_termino"]){
                    $editar = "<div class='btn-group pull-right'><button class='btn btn-warning btnEditarPantalla' idPantalla='".$value["id"]."' data-toggle='modal' data-target='#modalEditarPantalla'><i class='fa fa-pen'></i> Editar</button></div>";
                  }else{  
                    $editar = "<div class='btn-group'><button type='button' class='btn btn-success'>Acciones</button><button type='button' class='btn btn-success dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item btnRenovarPantalla' idPantalla='".$value["id"]."' data-toggle='modal' data-target='#modalRenovarPantalla' href=''>Renovar Pantalla</a><a class='dropdown-item btnEliminarPantalla' idPantalla=".$value["id"]." idCuenta=".$value["id_cuenta"]." href='#'>Eliminar Pantalla</a></div></div>";    
                  }
                  echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$cuenta["correo"].'-'.$streaming["nombre"].'</td>
                          <td>'.$cuenta["password"].'</td>
                          <td>'.$value["pantalla"].'</td>
                          <td>'.$value["pass"].'</td>
                          <td>'.$cuenta["corte"].'</td>
                          <td>'.$value["cliente"].'</td>
                          <td>'.$value["telefono"].'</td>
                          <td>'.$value["fecha_termino"].'</td>
                          <td>'.$diasF.'</td>
                          <td>'.$buttonEstado.'</td>
                          <td>'.$editar.'</td>
                  </tr>';
                }
              ?>
            </tbody>
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
<div class="modal fade" id="modalAsociarPantalla">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Asociar Pantalla</h4>
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
                    <select class="form-control select2" style="width: 270px" id="terminoCuenta" onchange="ShowSelectedTerminoPan();" name="nuevaAsocion">
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
                            if($value["modo_cuenta"] == "0" AND $value["pantallas"] != "0" AND $value["desactivado"] == "0"){
                            echo '<option value="'.$value["id"].'">'.$value["correo"].' - '.$categoria["nombre"].'</option>';
                            }
                          }else{
                            if($value["modo_cuenta"] == "0" AND $value["corte"] >= $fecha AND $value["pantallas"] != "0" AND $value["desactivado"] == "0"){
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
                    <input type="hidden" class="form-control" name="nuevaPantallas" id="nuevaPantallas" required>
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
                    <div id="clienteN" style="display:block;">
                      <input type="text" class="form-control" name="nuevaCliente" style="width: 270px;" placeholder="Nombre del Cliente">
                    </div>
                    <div id="clienteR" style="display:none;">
                      <select class="form-control select2" style="width: 270px;" id="nuevaCuentaR" name="nuevaClienteR" onchange="ShowSelectedTelefono();">
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
                  <div class="input-group" id="opciones">
                    <div class="form-check col-3">
                      <input type="radio" class="form-check-input" name="opc" value="1" onchange="mostrar(this.value);" checked>
                      <label class="form-check-label">Cliente</label>
                    </div>
                    <div class="form-check col-3">
                       <input type="radio" class="form-check-input" name="opc" value="0" onchange="mostrar(this.value);">
                      <label class="form-check-label">Revendedor</label>
                    </div>
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
                    <input type="number" class="form-control" placeholder="Número de teléfono" name="nuevoNumero" id="nuevoNumero" value="57">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Nombre Pantalla:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-tv"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nuevaNombrePantalla" placeholder="Nombre de la Pantalla" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA LA CONTRASEÑA -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Contraseña Pantalla:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Contraseña de Pantalla" name="nuevoPasswordP">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar Asociación</button>
        </div> 
      </form>
      <?php
        $crearAcociar = new ControladorPantalla();
        $crearAcociar -> ctrAsociarPantalla();
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
<div class="modal fade" id="modalEditarPantalla">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar Pantalla</h4>
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
                      <?php
                        $item = null;
                        $valor = null;

                        $fecha = date('Y-m-d');

                        $cuentas = ControladorCuentas::ctrMostrarCuentas($item, $valor); 
                        
                        foreach ($cuentas as $key => $value) {

                          $item1 = "id";
                          $valor1 = $value["id_categoria"];

                          $categoria = ControladorStreaming::ctrMostrarStreaming($item1, $valor1);  

                          if($value["modo_cuenta"] == "0" AND $value["ocupada"] == "0" AND $value["corte"] >= $fecha AND $value["desactivado"] == "0" AND $value["pantallas"] > "0"){
                            echo '<option value="'.$value["id"].'">'.$value["correo"].' - '.$categoria["nombre"].'</option>';
                          }                          
                        }
                      ?>
                    </select>
                    <input type="hidden" class="form-control" name="editarId" id="editarId" readonly>
                    <input type="text" class="form-control" name="editarComparar" id="editarComparar">
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
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Nombre Pantalla:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-tv"></i></span>
                    </div>
                    <input type="text" class="form-control" name="editarNombrePantalla" id="editarNombrePantalla" placeholder="Nombre de la Pantalla" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA LA CONTRASEÑA -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Contraseña Pantalla:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Contraseña de Pantalla" id="editarPasswordP" name="editarPasswordP">
                    <input type="hidden" class="form-control input-md" name="editarCodigoSecret" id="editarCodigoSecret">
                  </div>
                </div>
              </div>
            </div>         
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Editar Cuenta Pantalla</button>
        </div> 
      </form>
      <?php
        $editarCuenta = new ControladorPantalla();
        $editarCuenta -> ctrEditarPantalla();
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
<div class="modal fade" id="modalRenovarPantalla">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Renovar Pantalla</h4>
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
                    <select class="form-control" style="width: 270px" id="renovarTerminoCuenta" onchange="ShowSelectedTerminoR();" name="editarAsociacionR">
                      <option selected="selected" id="editarAsociacionR"></option>
                      <?php
                        $item = null;
                        $valor = null;

                        $fecha = date('Y-m-d');

                        $cuentas = ControladorCuentas::ctrMostrarCuentas($item, $valor); 
                        
                        foreach ($cuentas as $key => $value) {

                          $item1 = "id";
                          $valor1 = $value["id_categoria"];

                          $categoria = ControladorStreaming::ctrMostrarStreaming($item1, $valor1);  

                          if($value["modo_cuenta"] == "0" AND $value["ocupada"] == "0" AND $value["corte"] >= $fecha AND $value["pantallas"] > "0" AND $value["desactivado"] == "0"){
                            echo '<option value="'.$value["id"].'">'.$value["correo"].' - '.$categoria["nombre"].'</option>';
                          }                          
                        }
                      ?>
                    </select>
                    <input type="hidden" class="form-control" name="renovarId" id="editarIdR" readonly>
                    <input type="hidden" class="form-control" name="nuevaPantallasR" id="nuevaPantallasR" required>
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
                    <input type="text" class="form-control" name="editarFcorteR" id="editarFcorteR" placeholder="Fecha de corte" readonly>
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
                    <input type="text" class="form-control editarFterminoR" name="editarFterminoR" id="datepicker2" placeholder="Fecha de Terminacion" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA LA CONTRASEÑA -->  
              <div class="col-6" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Valor Cuenta:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Valor de la cuenta" id="editarPrecioCR" name="editarPrecioCR">
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
                    <input type="text" class="form-control" id="editarClienteR" name="editarClienteR" placeholder="Nombre del Cliente" required>
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
                    <input type="number" class="form-control" placeholder="Número de teléfono" id="editarNumeroR" name="editarNumeroR">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- ENTRADA PARA EL NOMBRE -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Nombre Pantalla:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-tv"></i></span>
                    </div>
                    <input type="text" class="form-control" name="editarNombrePantallaR" id="editarNombrePantallaR" placeholder="Nombre de la Pantalla" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA LA CONTRASEÑA -->  
              <div class="col-md-6 col-sm-12" style="padding-left: 1px; padding-right: 5px">          
                <div class="form-group">
                  <label>Contraseña Pantalla:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Contraseña de Pantalla" id="editarPasswordPR" name="editarPasswordPR">
                    <input type="hidden" class="form-control" name="renovaCodigoSecret" id="renovaCodigoSecret">
                  </div>
                </div>
              </div>
            </div>         
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Renovar Cuenta Pantalla</button>
        </div> 
      </form>
      <?php
        $renovarCuenta = new ControladorPantalla();
        $renovarCuenta -> ctrRenovarPantalla();
      ?> 
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
  $borrarPantalla = new ControladorPantalla();
  $borrarPantalla -> ctrBorrarPantalla();
?>