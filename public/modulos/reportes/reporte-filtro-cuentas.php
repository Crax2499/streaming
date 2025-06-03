<?php
error_reporting(0);

$item = null;
$valor = null;

$cuentapantalla = ControladorPantalla::ctrMostrarPantalla($item, $valor);

$cuentacombo = ControladorCombos::ctrMostrarCombos($item, $valor);

$cuentacompleta = ControladorAsociar::ctrMostrarAsociar($item, $valor);

$cuentarevendedor = ControladorRevendedor::ctrMostrarRevendedor($item, $valor);

?>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header"></div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>         
         <tr>           
           <th style="width:10px">#</th>
           <th>Cuenta</th>
           <th>Streaming</th>
           <th>Pantalla</th>
           <th>cliente</th>
           <th>T. Cuenta</th>
           <th>Fecha Termino</th>
         </tr>
        </thead>
        <tbody>
          <?php
            if($cuentapantalla != ""){
              $fecha = date('Y-m-d');
              foreach ($cuentapantalla as $key => $value){
                $item = "id";
                $valor = $value["id_cuenta"];

                $cuentaemail = ControladorCuentas::ctrMostrarCuentas($item, $valor);

                $item1 = "id";
                $valor1 = $cuentaemail["id_categoria"];

                $cuentastreaming = ControladorStreaming::ctrMostrarStreaming($item1, $valor1);
                echo '<tr>
                        <td>'.($key+1).'</td>
                        <td>'.$cuentaemail["correo"].'</td>
                        <td>'.$cuentastreaming["nombre"].'</td>
                        <td>'.$value["pantalla"].'</td>
                        <td>'.$value["cliente"].'</td>
                        <td>Pantalla</td>
                        <td>'.$value["fecha_termino"].'</td>
                    </tr>';
              }
            }

            if($cuentacombo != ""){
              $fecha = date('Y-m-d');
              foreach ($cuentacombo as $key => $value){
                $listaProducto = json_decode($value["productos"], true);
                foreach ($listaProducto as $key => $valuec) {
                  $item = "id";
                  $valor = $valuec["id"];

                  $cuentaemail = ControladorCuentas::ctrMostrarCuentas($item, $valor);

                  $item1 = "id";
                  $valor1 = $valuec["categoria"];

                  $cuentastreaming = ControladorStreaming::ctrMostrarStreaming($item1, $valor1);
                  echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$cuentaemail["correo"].'</td>
                          <td>'.$cuentastreaming["nombre"].'</td>
                          <td>'.$valuec["password"].'</td>
                          <td>'.$value["cliente"].'</td>
                          <td>'.$value["nombre_combo"].'</td>
                          <td>'.$value["fecha_final"].'</td>
                      </tr>';
                }                  
              }
            }

            if($cuentacompleta != "" or $cuentapantalla["fecha_termino"] < $fecha){
              $fecha = date('Y-m-d');
              foreach ($cuentacompleta as $key => $value){
                $item = "id";
                $valor = $value["id_cuenta"];

                $cuentaemail = ControladorCuentas::ctrMostrarCuentas($item, $valor);

                $item1 = "id";
                $valor1 = $cuentaemail["id_categoria"];

                $cuentastreaming = ControladorStreaming::ctrMostrarStreaming($item1, $valor1);
                echo '<tr>
                        <td>'.($key+1).'</td>
                        <td>'.$cuentaemail["correo"].'</td>
                        <td>'.$cuentastreaming["nombre"].'</td>
                        <td>Completa</td>
                          <td>'.$value["nombre_cliente"].'</td>
                          <td>Cuenta Completa</td>
                          <td>'.$value["fecha_termino"].'</td>
                      </tr>';     
              }
            }

            if($cuentarevendedor != ""){
              $fecha = date('Y-m-d');
              foreach ($cuentarevendedor as $key => $value){
                $item = "id";
                $valor = $value["id_cuenta"];

                $cuentaemail = ControladorCuentas::ctrMostrarCuentas($item, $valor);

                $item1 = "id";
                $valor1 = $cuentaemail["id_categoria"];

                $cuentastreaming = ControladorStreaming::ctrMostrarStreaming($item1, $valor1);
                echo '<tr>
                        <td>'.($key+1).'</td>
                        <td>'.$cuentaemail["correo"].'</td>
                        <td>'.$cuentastreaming["nombre"].'</td>
                        <td>Revendedor</td>
                        <td>'.$value["nombre_revendedor"].'</td>
                        <td>Cuenta Revendedor</td>
                        <td>'.$value["fecha_termino"].'</td>
                    </tr>';      
              } 
            }        
          ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->