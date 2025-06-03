<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Combos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Cuenta Combos</li>
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
              echo '<a href="crear-cuenta-combo" class="btn btn-success">Asociar Combo</a>';
            }
          ?>        
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped tablas" width="100%">
            <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Combo</th>
              <th>Cliente</th>
              <th>Telefono</th>
              <th>Precio</th>
              <th>F. Inicio</th>
              <th>F. Final</th>
              <th>Días</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
              <?php 
                $item = null;
                $valor = null;

                $combos = ControladorCombos::ctrMostrarCombos($item, $valor);                

                foreach ($combos as $key => $value){
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

                  echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["nombre_combo"].'</td>
                          <td>'.$value["cliente"].'</td>
                          <td>'.$value["telefono"].'</td>
                          <td>'.number_format($value["precio"],2).'</td>
                          <td>'.$value["fecha_inicio"].'</td>
                          <td>'.$value["fecha_final"].'</td>
                          <td>'.$diasF.'</td>
                          <td>';

                          $item2 = "tipo_cuenta";
                          $valor3 = "3";

                          $anexos = ControladorAnexos::ctrMostrarAnexo($item2, $valor3);

                          if($anexos["estado"]=="1"){
                            $completa = $anexos["recordatorio"];
                          }else{
                            $completa="";
                          }

                          if($fecha == $value["fecha_final"]){
                            echo '<a href="https://api.whatsapp.com/send?phone='.$value["telefono"].'&text=Buen%20d%C3%ADa%20¿c%C3%B3mo%20vas?...%20Ya%20hoy%20a%20las%206:00%20p.m.%20es%20tu%20corte%20del%20servicio%20'.urlencode($value["nombre_combo"]).'...%20Quer%C3%ADa%20confirmar%20si%20desea%20renovarla...%20Cualquier%20cosa%20qued%C3%B3%20atento...%F0%9F%93%9D%0A%0A'.$completa.'" target="_blank"><button class="btn btn-warning btn-sm">Aviso Corte HOY</button></a>';
                          }else if($fecha > $value["fecha_final"]){
                            echo '<a href="https://api.whatsapp.com/send?phone='.$value["telefono"].'&text=Buen%20d%C3%ADa%20¿c%C3%B3mo%20vas?...%20Queremos%20informarte%20que%20tu%20cuenta%20ha%20sido%20desactivada...%20Quer%C3%ADamos%20confirmar%20si%20desea%20renovarla...%20Cualquier%20cosa%20qued%C3%B3%20atento...%F0%9F%93%9D" target="_blank"><button class="btn btn-danger btn-sm">Cuenta Desactivada</button></a>';
                          }else if($diff->days <= "3" and $diff->days >= "2"){
                            echo '<a href="https://api.whatsapp.com/send?phone='.$value["telefono"].'&text=Buen%20día%20¿Cómo%20vas?...%0A%0AServicio:%20'.urlencode($value["nombre_combo"]).'%0ACorte:%20'.$value["fecha_final"].'%0A%0AQuería%20confirmar%20renovación...%20Cualquier%20cosa%20quedó%20atento...%20📝%20Gracias%20😁%0A%0A'.$completa.'" target="_blank"><button class="btn btn-warning btn-sm">Aviso Corte</button></a>';
                          }else if($diff->days == "1"){
                            echo '<a href="https://api.whatsapp.com/send?phone='.$value["telefono"].'&text=Buen%20día%20¿Cómo%20vas?...%0A%0AServicio:%20'.urlencode($value["nombre_combo"]).'%0ACorte:%20'.$value["fecha_final"].'%0A%0AQuería%20confirmar%20renovación...%20Cualquier%20cosa%20quedó%20atento...%20📝%20Gracias%20😁%0A%0A'.$completa.'" target="_blank"><button class="btn btn-warning btn-sm">Aviso Corte</button></a>';
                          }else if($diff->days > "3"){                         
                            $listaProducto = json_decode($value["productos"], true);

                            echo '<a href="https://api.whatsapp.com/send?phone='.$value["telefono"].'&text=DATOS%20ACCESO%20'.$value["nombre_combo"];

                            foreach ($listaProducto as $key => $lista) {
                              $item = "id";
                              $valor = $lista["id"];

                              $respuesta = ControladorCuentas::ctrMostrarCuentas($item, $valor);

                              $item1 = "id";
                              $valor1 = $lista["categoria"];

                              $respuesta1 = ControladorStreaming::ctrMostrarStreaming($item1, $valor1);

                              echo '%0A%0APlataforma:%20'.$respuesta1["nombre"].'%0ACorreo:%20'.urlencode($lista["descripcion"]).'%0AContrase%C3%B1a:%20'.$respuesta["password"].'%0APantalla:%20'.$lista["password"].'%0APassword Pantalla:%20'.$lista["Pass"];
                            }
                            echo '%0AServicio%20hasta:%20'.$value["fecha_final"].'%0A%0AMuchas%20gracias%20por%20su%20compra.%20😊😉" target="_blank"><button class="btn btn-success btn-sm">Combo Activo</button></a>';
                          }
                          echo '</td>
                          <td>';
                          if($_SESSION["perfil"] == "Administrador"){
                            if($fecha < $value["fecha_final"]){
                              echo '<button class="btn btn-warning btnEditarCombo" idCombo="'.$value["id"].'"><i class="fa fa-pen"></i> Editar</button>';
                            }else{
                              echo '<div class="btn-group"><button type="button" class="btn btn-success">Acciones</button><button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown"><span class="sr-only">Toggle Dropdown</span></button><div class="dropdown-menu" role="menu"><a class="dropdown-item btnRenovarCombo" idCombo="'.$value["id"].'" data-toggle="modal" data-target="#modalRenovarRevendedor" href="#">Renovar Combo</a><a class="dropdown-item btnEliminarCombo" idCombo="'.$value["id"].'" href="#">Eliminar Combo</a></div></div>';
                            }
                          }
                          echo '</td>
                        </tr>';
                }
              ?>
              
            </tbody>
          </table>
          <!--<input type="hidden" value="#" id="perfilOculto">-->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
  $borrarPantalla = new ControladorCombos();
  $borrarPantalla -> ctrBorrarCombo();
?>