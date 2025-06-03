<?php
error_reporting(0);

if(isset($_GET["fechaInicial"])){
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
}else{
    $fechaInicial = null;
    $fechaFinal = null;
}

$sumas = ControladorCombos::ctrRangoFechasCuentasCombos($fechaInicial, $fechaFinal);

$arrayFechas1 = array();
$arrayVentas1 = array();
$arrayVentas2 = array();
$sumaPagosMes1 = array();

foreach ($sumas as $key => $value){

    #Capturamos sólo el año y el mes
    $fecha = substr($value["fecha"],0,10);

    #Introducir las fechas en arrayFechas
    array_push($arrayFechas1, $fecha);

     #Capturamos las ventas
    $arrayVentas2 = array($fecha => $value["precio"]);

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
        echo '<h4 class="box-title"><b>Ventas:</b> $'.number_format($sumaPagos2,2).'</h4>'
      ?>      
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>         
         <tr>           
           <th style="width:10px">#</th>
           <th>Cliente</th>
           <th>Combo</th>
           <th>Termino</th>
           <th>Precio</th>
           <th>Estado</th>
         </tr>
        </thead>
        <tbody>
          <?php
            $fecha = date('Y-m-d');
            foreach ($sumas as $key => $value){
              echo '<tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value["cliente"].'</td>
                      <td>'.$value["nombre_combo"].'</td>
                      <td>'.$value["fecha_final"].'</td>
                      <td>'.number_format($value["precio"],2).'</td>
                      <td>';
                      if ($value["fecha_final"] > $fecha){
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