<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <?php
    $tabla1 = "licencia";
    $item1 = "id";
    $valor1 = 1;

    $Licencia = ModeloLicencia::mdlMostrarLicencia($tabla1, $item1, $valor1);

    date_default_timezone_set("America/Bogota");
    $fecha = date("Y-m-d");

    if ($Licencia["ilimitado"] == 1){
      echo "<!-- Right navbar links -->
      <ul class='navbar-nav ml-auto'>    
        <li class='nav-item'>
          <a class='nav-link' href='salir'>
            Licencia: Ilimitada - Cerrar Sesion <i class='fas fa-door-open'></i></a>
        </li>    
      </ul>";
    }else{
      /*=============================================
      FECHAS DÍAS RESTANTES
      =============================================*/
      $fecha1= new DateTime($fecha);
      $fecha2= new DateTime($Licencia["fecha"]);
      $diff = $fecha1->diff($fecha2);

      // El resultados sera 3 dias
      if ($Licencia["fecha"] < $fecha){
        $diasF = "0 dias";
      }else{
        $diasF = "".$diff->days." días";
      }

      echo "<!-- Right navbar links -->
            <ul class='navbar-nav ml-auto'>    
              <li class='nav-item'>
                <a class='nav-link' href='salir'>
                  Licencia: ".$diasF." - Cerrar Sesion <i class='fas fa-door-open'></i></a>
              </li>    
            </ul>";
    }
  ?>
</nav>
<!-- /.navbar -->