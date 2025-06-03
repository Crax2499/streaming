<?php
error_reporting(0);

$item = null;
$valor = null;

$cuentas = ControladorCuentas::ctrMostrarCuentas($item, $valor);

?>
<div class="card">
  <div class="card-header">
    LISTADO DE CUENTAS LIBRES   
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped tablas" width="100%">
      <thead>
        <tr>
          <th style="width:10px">#</th>
          <th>Cuenta</th>
          <th>Contraseña</th>
          <th>Corte</th>
          <th>Días</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($cuentas != ""){
            $fecha = date('Y-m-d');
            foreach ($cuentas as $key => $value){
              $item1 = "id";
              $valor1 = $value["id_categoria"];

              $cuentastreaming = ControladorStreaming::ctrMostrarStreaming($item1, $valor1);

              $fecha1= new DateTime($fecha);
              $fecha2= new DateTime($value["corte"]);
              $diff = $fecha1->diff($fecha2);

              // El resultados sera 3 dias
              if ($value["corte"] < $fecha){
                $diasF = "0 días";
              }else{
                $diasF = "".$diff->days." días";
              }

              if($value["corte"] >= $fecha OR $value["corte"] == "0000-00-00"){
                if($value["pantallas"] != 0){
                  if($value["ocupada"] == 0){
                    if($value["desactivado"] == 0){
                      echo '<tr>
                        <td>'.($key+1).'</td>
                        <td>'.$value["correo"].' - '.$cuentastreaming["nombre"].'</td>
                        <td>'.$value["password"].'</td>
                        <td>'.$value["corte"].'</td>
                        <td>'.$diasF.'</td>
                        <td>';
                        if($value["modo_cuenta"] == 1){
                          echo '<button class="btn btn-success">Completa Libre</button>';
                        }else if($value["modo_cuenta"] == 2){
                          echo '<button class="btn btn-success">Re-vendedor Libre</button>';
                        }else{
                          if($value["pantallas"] <= 1){
                            echo '<button class="btn btn-danger">'.$value["pantallas"].' Pantallas </button>';
                          }else if($value["pantallas"] > 1 && $value["pantallas"] <= 2){
                            echo '<button class="btn btn-warning">'.$value["pantallas"].' Pantallas </button>';
                          }else{
                            echo '<button class="btn btn-success">'.$value["pantallas"].' Pantallas</button>';
                          }                      
                        }

                        if ($value["modo_cuenta"] == 0){
                          echo '</td>
                            <td><a href="cuenta-pantalla"><button class="btn btn-success"><i class="nav-icon fas fa-edit"></i> Pantallas</button></a></td>';
                        }else if($value["modo_cuenta"] == 1){
                          echo '</td>
                            <td><a href="cuenta-completa"><button class="btn btn-success" ><i class="nav-icon fas fa-edit"></i> Cuentas Completa</button></a></td>';
                        }else{
                          echo '</td>
                            <td><a href="cuenta-revendedores"><button class="btn btn-success"><i class="nav-icon fas fa-edit"></i> Cuenta Revendedor</button></a></td>';
                        }
                       
                      echo '</tr>';
                    }                    
                  }
                }                
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