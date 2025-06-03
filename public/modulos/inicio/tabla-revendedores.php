<!-- Main content -->
<section class="content">
  <div class="card">
    <div class="card-header">
      <?php
        if($_SESSION["perfil"] == "Administrador"){
          echo '<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Agregar Administradores</button>';
        }
      ?>        
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
        <tr>
          <th style="width:10px">#</th>
          <th>Correo</th>
          <th>Fecha de Termino</th>
          <th>Precio</th>
          <th>T. Cuenta</th>
          <th>Días</th>
          <th>Estado</th>
        </tr>
        </thead>
        <tbody>
        <?php
          $item = null;
          $valor = null;

          $cuentas = ControladorRevendedor::ctrMostrarRevendedor($item, $valor);

          $pantallas = ControladorPantalla::ctrMostrarPantalla($item, $valor);

          $combos = ControladorCombos::ctrMostrarCombos($item, $valor);

          if($cuentas != ""){
            foreach ($cuentas as $key => $value) {
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

              $item = "id";
              $valor = $value["id_cuenta"];

              $correo = ControladorCuentas::ctrMostrarCuentas($item, $valor);

              $item1 = "id";
              $valor1 = $correo["id_categoria"];

              $categoria = ControladorStreaming::ctrMostrarStreaming($item1, $valor1);

              if($value["nombre_revendedor"] == $_SESSION["nombre"]){
                echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$correo["correo"].' - '.$categoria["nombre"].'</td>
                          <td>'.$value["fecha_termino"].'</td>
                          <td>'.number_format($value["precio"],2).'</td>
                          <td>Completa</td>
                          <td>'.$diasF.'</td>';
                          if($fecha == $value["fecha_termino"] or $fecha > $value["fecha_termino"]){
                            echo '<td><button class="btn btn-danger btn-sm">Cuenta Desactivada</button></td>';
                          }else{
                            echo '<td><button class="btn btn-success btn-sm">Cuenta Activada</button></td></td>';
                          }
                     echo '</tr>
                      ';
              }        
            }
          }

          if($pantallas != ""){
            foreach ($pantallas as $key => $value) {
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

              $item = "id";
              $valor = $value["id_cuenta"];

              $correo = ControladorCuentas::ctrMostrarCuentas($item, $valor);

              $item1 = "id";
              $valor1 = $correo["id_categoria"];

              $categoria = ControladorStreaming::ctrMostrarStreaming($item1, $valor1);

              if($value["cliente"] == $_SESSION["nombre"]){
                echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$correo["correo"].' - '.$categoria["nombre"].'</td>
                          <td>'.$value["fecha_termino"].'</td>
                          <td>'.number_format($value["costo"],2).'</td>
                          <td>Pantalla</td>
                          <td>'.$diasF.'</td>';
                          if($fecha == $value["fecha_termino"] or $fecha > $value["fecha_termino"]){
                            echo '<td><button class="btn btn-danger btn-sm">Cuenta Desactivada</button></td>';
                          }else{
                            echo '<td><button class="btn btn-success btn-sm">Cuenta Activada</button></td></td>';
                          }
                     echo '</tr>
                      ';
              }        
            }
          }

          if($combos != ""){
            foreach ($combos as $key => $value) {
              date_default_timezone_set("America/Bogota");
              $fecha = date("Y-m-d");
              /*=============================================
              FECHAS DÍAS RESTANTES
                =============================================*/
              $fecha1= new DateTime($fecha);
              $fecha2= new DateTime($value["fecha_final"]);
              $diff = $fecha1->diff($fecha2);

              // El resultados sera 3 dias
              if ($value["fecha_final"] < $fecha){
                $diasF = "0 dias";
              }else{
                $diasF = "".$diff->days." días";
              }

              if($value["cliente"] == $_SESSION["nombre"]){
                echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["nombre_combo"].'</td>
                          <td>'.$value["fecha_final"].'</td>
                          <td>'.number_format($value["precio"],2).'</td>
                          <td>Combo</td>
                          <td>'.$diasF.'</td>';
                          if($fecha == $value["fecha_final"] or $fecha > $value["fecha_final"]){
                            echo '<td><button class="btn btn-danger btn-sm">Cuenta Desactivada</button></td>';
                          }else{
                            echo '<td><button class="btn btn-success btn-sm">Cuenta Activada</button></td></td>';
                          }
                     echo '</tr>
                      ';
              }        
            }
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
