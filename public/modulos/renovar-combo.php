<div class="content-wrapper">
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
                      <?php
                        $item = "id";
                        $valor = $_GET["idCombo"];

                        $combo = ControladorCombos::ctrMostrarCombos($item, $valor);                  
                      ?>

                      <!--=====================================
                      ENTRADA DEL VENDEDOR
                      ======================================-->            
                      <div class="form-group">                
                        <div class="input-group">                    
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="nav-icon fa fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" name="nuevoCombo" value="<?php echo $combo["nombre_combo"]; ?>">
                          <input type="hidden" name="idCombo" value="<?php echo $combo["id"]; ?>">
                          <input type="hidden" name="nuevoCodigo" value="<?php echo $combo["codigo"]; ?>">
                        </div>
                      </div> 

                      <!--=====================================
                      ENTRADA DEL CÓDIGO
                      ======================================-->
                      <div class="form-group">                  
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="nav-icon fa fa-phone"></i></span>
                          </div>
                         <input type="number" class="form-control" id="nuevoTelefono" name="nuevoTelefono" value="<?php echo $combo["telefono"]; ?>">
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
                          <input type="text" class="form-control" id="nuevoCliente" name="nuevoCliente" value="<?php echo $combo["cliente"]; ?>" required>
                        </div>             
                      </div>

                      <!--=====================================
                      ENTRADA PARA AGREGAR PRODUCTO
                      ======================================--> 
                      <div class="form-group row nuevoProducto">
                      <?php

                        $listaProducto = json_decode($combo["productos"], true);

                        $arrayId = array();
                        $arrayCantidad = array();
                        $sumaCantidad = array();
                        $arrayIdC = array();

                        foreach ($listaProducto as $key => $value) {
                          $correo = $value["descripcion"];
                          $id = $value["id"];

                          #Introducir las id
                          array_push($arrayId, $correo);

                          #Capturamos las cantidades
                          $arrayCantidad = array($correo => $value["cantidad"]);

                          #Sumamos los pagos que ocurrieron el mismo mes
                          foreach ($arrayCantidad as $key => $value1) {   
                            $sumaCantidad[$key] += $value1;
                          }

                          array_push($arrayIdC, $id);
                        }

                        $noRepetirFechas = array_unique($arrayId);
                        $valor2 = array_unique($arrayIdC);
                        
                        if($noRepetirFechas != null){
                          foreach(array_combine($noRepetirFechas, $valor2) as $key => $valor){
                            $item = "id";
                            $valor = $valor;
                            $orden = "id";

                            $respuesta = ControladorCuentas::ctrMostrarCuentas($item, $valor, $orden);
                            
                            $stockAntiguo = $sumaCantidad[$key];
                          }       
                        }

                        foreach ($listaProducto as $key => $value) {
                          $item = "id";
                          $valor = $value["id"];
                          $orden = "id";

                          $respuesta = ControladorCuentas::ctrMostrarCuentas($item, $valor, $orden);

                          $stockAntiguo = $respuesta["pantallas"] + $value["cantidad"];
                          
                          echo '<div class="row" style="padding:5px 15px">            
                                <div class="col-xs-6 col-md-6" style="padding-right:0px">            
                                  <div class="input-group">                
                                    <span class="input-group-addon"><button type="button" class="btn btn-danger btn-ls quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>
                                    <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>
                                  </div>
                                </div>
                                <div class="col-xs-2 col-md-2">         
                                  <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>
                                </div>
                                <div class="">              
                                   <input type="hidden" class="form-control nuevaCategoria" name="nuevaCategoria" value="'.$value["categoria"].'" required>
                                </div>
                                <div class="col-xs-3 col-md-2">              
                                  <input type="text" class="form-control passNueva" name="passNueva" value="'.$value["Pass"].'" passNueva="'.$value["Pass"].'" required>
                                </div>
                                <div class="col-xs-3 col-md-2">            
                                  <input type="text" class="form-control nuevaContrasena" name="nuevaContrasena" id="cambioContrasena" placeholder="N.Pantalla" value="'.$value["password"].'" nuevaPass="'.$value["password"].'" required>
                                </div>';                        
                             echo '</div>';
                        }
                      ?>
                      </div>
                      <input type="hidden" id="listaProductos" name="listaProductos">

                      <!--=====================================
                      BOTÓN PARA AGREGAR PRODUCTO
                      ======================================-->
                      <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>
                      <hr>
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
                                    <input type="text" class="form-control input-lg" name="totalVenta" total="<?php echo $combo["precio"] ?>" value="<?php echo $combo["precio"] ?>" required>
                                  </div>
                                </td>
                                <td style="width: 60%">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="nuevaFinicio" id="datepicker1" placeholder="Fecha de inicio" value="<?php echo $combo["fecha_inicio"]; ?>" required>
                                    <input type="text" class="form-control" name="nuevaFtermino" value="<?php echo $combo["fecha_final"]; ?>" id="datepicker" placeholder="Fecha de Terminacion" required>
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
                  <button type="submit" class="btn btn-danger pull-right">Guardar cambios</button>
                </div>
                <?php
                  $renovarCombo = new ControladorCombos();
                  $renovarCombo -> ctrRenovarCombo();          
                ?>
              </form>
            </div>
          </div>
          <!--=====================================
          LA TABLA DE PRODUCTOS
          ======================================-->
          <div class="col-lg-5 hidden-md hidden-sm hidden-xs">        
            <div class="box box-warning">
              <div class="box-header with-border"></div>
              <div class="box-body">            
                <table class="table table-bordered table-striped dt-responsive tablaCombo">
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
  </section>
</div>