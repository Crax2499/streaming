<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cuentas combo</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Combos</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <!--=====================================
              EL FORMULARIO
              ======================================-->
              <div class="box box-success">
                <div class="box-header with-border"></div>
                <form role="form" method="post" class="formularioAsociar">
                  <div class="box-body">  
                    <div class="box">

                      <!--=====================================
                      ENTRADA DEL CLIENTE NUEVO
                      ======================================-->            
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="nav-icon fa fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" name="nuevoCombo" placeholder="Nombre del Combo">
                        </div>
                      </div> 

                      <!--=====================================
                      ENTRADA DEL VENDEDOR
                      ======================================-->
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="nav-icon fa fa-phone"></i></span>
                          </div>
                         <input type="number" class="form-control" id="nuevoTelefono" name="nuevoTelefono" placeholder="número de Teléfono" value="57">
                          
                        </div>               
                      </div>

                      <!--=====================================
                      ENTRADA DEL CLIENTE
                      ======================================-->
                      <div class="form-group">                  
                        <div class="input-group mb-3">                    
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="nav-icon fa fa-users"></i></span>
                          </div>
                          <div id="clienteN" style="display:block;">
                            <input type="text" class="form-control" name="nuevoCliente" placeholder="Nombre de persona">
                          </div>
                          <div id="clienteR" style="display:none;">
                            <select class="form-control select2" id="nuevaCuentaR" name="nuevoClienteR" onchange="ShowSelectedTelefonoC();">
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
                      <div class="form-group">  
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

                      <!--=====================================
                      ENTRADA PARA AGREGAR PRODUCTO
                      ======================================-->
                      <div class="form-group row nuevoProducto">
                        
                      </div>
                      <input type="hidden" id="listaProductos" name="listaProductos">
                      <!--=====================================
                      BOTÓN PARA AGREGAR PRODUCTO
                      ======================================-->
                      <div class="row">
                      <!--=====================================
                      ENTRADA IMPUESTOS Y TOTAL
                      ======================================-->                  
                        <div class="col-xs-8 pull-right">                    
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Precio Combo</th>
                                <th>Fechas</th>      
                              </tr>
                            </thead>
                            <tbody>          
                              <tr>
                                <td style="width: 40%">                            
                                  <div class="input-group">
                                    <div class="input-group-prepend">                         
                                      <span class="input-group-text"><i class="fas fa-comment-dollar"></i></span>
                                    </div>
                                    <input type="number" class="form-control input-lg" id="nuevoTotalVenta" name="totalVenta" total="" placeholder="00000" required>
                                  </div>
                                </td>
                                <td style="width: 60%">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="nuevaFinicio" id="datepicker1" placeholder="F. Inicio" required>
                                    <input type="text" class="form-control" name="nuevaFtermino" id="datepicker" placeholder="F. Terminacion" required>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <hr>   
                    </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Guardar Combo</button>
                    <a href="combos" class="btn btn-success pull-left">Lista de Combos</a>
                  </div>
                </form>
                <?php
                  $guardarCombo = new ControladorCombos();
                  $guardarCombo -> ctrCrearCombo();            
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <hr>
              <!--=====================================
              LA TABLA DE PRODUCTOS
              ======================================-->
              <div class="col-lg-12">          
                <div class="box box-warning">
                  <div class="box-header with-border"></div>
                  <div class="box-body">              
                    <table class="table table-bordered table-striped tablaCombo" width="100%">
                      <thead>
                        <tr>
                          <th>Cuenta</th>
                          <th>Pantallas</th>                          
                          <th>Acciones</th>
                          <th>Corte</th>
                        </tr>
                      </thead>                      
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>          
        </div>
      </div>
    </div>
  </section>
</div>