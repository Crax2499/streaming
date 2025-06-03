<?php
error_reporting(0);

if(isset($_GET["fechaInicial"])){
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
}else{
    $fechaInicial = null;
    $fechaFinal = null;
}

$sumas = ControladorAsociar::ctrRangoFechasCuentasCompletas($fechaInicial, $fechaFinal);

$arrayFechas1 = array();
$arrayVentas1 = array();
$arrayVentas2 = array();
$sumaPagosMes1 = array();

foreach ($sumas as $key => $value){

    $item = "id";
    $valor = $value["id_cuenta"];

    $cuentas = ControladorCuentas::ctrMostrarCuentas($item, $valor);

    #Capturamos sólo el año y el mes
    $fecha = substr($value["fecha"],0,10);

    #Introducir las fechas en arrayFechas
    array_push($arrayFechas1, $fecha);

    #Capturamos la inversión
    $arrayVentas1 = array($fecha => $cuentas["valor_pin"]);

     #Capturamos las ventas
    $arrayVentas2 = array($fecha => $value["precio"]);

    #Sumamos los pagos que ocurrieron el mismo mes
    foreach ($arrayVentas1 as $key => $value) {
      $sumaPagos += $value;
    }

    #Sumamos los pagos que ocurrieron el mismo mes
    foreach ($arrayVentas2 as $key => $value1) {
      $sumaPagos2 += $value1;
    }
}

$noRepetirFechas = array_unique($arrayFechas1);
?>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <?php
        $resta = $sumaPagos2 - $sumaPagos;
        echo '<h4 class="box-title"><b>Ganancia:</b> $'.number_format($resta,2).' - <b>Inversion:</b> $'.number_format($sumaPagos,2).' - <b>Ventas:</b> $'.number_format($sumaPagos2,2).'</h4>'
      ?>      
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>         
         <tr>           
           <th style="width:10px">#</th>
           <th>Cliente</th>
           <th>Cuenta</th>
           <th>Corte</th>
           <th>Precio</th>
           <th>Fecha de compra</th>
           <th>Estado</th>
         </tr>
        </thead>
        <tbody>
          <?php
            $fecha = date('Y-m-d');
            foreach ($sumas as $key => $value){
              $item = "id";
              $valor = $value["id_cuenta"];

              $cuentas = ControladorCuentas::ctrMostrarCuentas($item, $valor);

              $item = "id";
              $valor = $cuentas["id_categoria"];

              $streaming = ControladorStreaming::ctrMostrarStreaming($item, $valor);

              echo '<tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value["nombre_cliente"].'</td>
                      <td>'.$cuentas["correo"].' - '.$streaming["nombre"].'</td>
                      <td>'.$value["fecha_corte"].'</td>
                      <td>'.number_format($value["precio"],2).'</td>
                      <td>'.substr($value["fecha"],0,10).'</td>
                      <td>';
                      if ($value["fecha_termino"] > $fecha){
                        echo '<button class="btn btn-success btn-sm">Activa</button>';
                      }else{                        
                        echo '<button class="btn btn-danger btn-sm">Desactivada</button>';
                      }
                      echo '</td>
                  </tr>';
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