<!-- Main content -->
<section class="content">
  <div class="card">
    <div class="card-header"> 
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
        <tr>
          <th style="width:10px">#</th>
          <th>fecha</th>
          <th>Días</th>
          <th>Ilimitado</th>
          <th>Estado</th>
          <th>Modificar</th>
        </tr>
        </thead>
        <tbody>
        <?php
          $tabla1 = "licencia";
          $item1 = "id";
          $valor1 = 1;

          $Licencia = ModeloLicencia::mdlMostrarLicencia($tabla1, $item1, $valor1);

            date_default_timezone_set("America/Bogota");
            $fecha = date("Y-m-d");
            /*=============================================
            FECHAS DÍAS RESTANTES
            =============================================*/
            $fecha1= new DateTime($fecha);
            $fecha2= new DateTime($Licencia["fecha"]);
            $diff = $fecha1->diff($fecha2);

            // El resultados sera 3 dias
            if ($Licencia["fecha"] < $fecha){
              $diasF = "0 días";
            }else{
              $diasF = "".$diff->days." días";
            }

            echo '<tr>
                  <td>'.($key+1).'</td>
                  <td>'.$Licencia["fecha"].'</td>
                  <td>'.$diasF.'</td>';
                  if($Licencia["ilimitado"] == 1){
                    echo '<td>Ilimitado</td>';
                  }else{
                    echo '<td>Limitado</td>';
                  }
                  if($Licencia["fecha"] >= $fecha or $Licencia["ilimitado"] == 1){
                    echo '<td><button class="btn btn-success btn-sm">Licencia Activa</button></td>';
                  }else{
                    echo '<td><button class="btn btn-danger btn-sm">Licencia Inactiva</button></td>';
                  }
                  echo '<td><button class="btn btn-warning btnEditarLicencia btn-sm" idLicencia="'.$Licencia["id"].'" data-toggle="modal" data-target="#modalEditarLicencia">Modifica Licencia</button></td>';
             echo '</tr>';
        ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->
<!--=====================================
MODAL EDITAR USUARIO
======================================-->
<div class="modal fade" id="modalEditarLicencia">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar Licencia</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="box-body">
              <!-- ENTRADA PARA EL NOMBRE -->            
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
                    <input type="text" class="form-control editarFecha" name="editarFcorte" id="datepicker1" placeholder="Fecha de corte">
                    <input type="hidden" class="form-control" name="editarId" id="editarId">
                </div>
              </div>

              <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
              <div class="form-group">          
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-clock"></i></span>
                  </div>
                    <select class="form-control input-lg" name="editarIlimitado">                  
                      <option value="" id="editarIlimitado"></option>
                      <option value="1">Ilimitado</option>
                      <option value="0">Limitado</option>
                    </select>              
                </div>
              </div>
            </div>
        </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      </div>
      </form>
      <?php
        $editarLicencia = new ControladorLicencia();
        $editarLicencia -> ctrEditarLicencia();
      ?>  
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->