<?php

$item = null;
$valor = null;
$orden = "id";

$cuentascompleta = ControladorAsociar::ctrMostrarAsociar($item, $valor);
$totalCuentas = count($cuentascompleta);

$cuentaspantalla = ControladorPantalla::ctrMostrarPantalla($item, $valor);
$totalPantallas = count($cuentaspantalla);

$cuentascombo = ControladorCombos::ctrMostrarCombos($item, $valor);
$totalCombos = count($cuentascombo);

$cuentasrevendedores = ControladorRevendedor::ctrMostrarRevendedor($item, $valor);
$totalRevendedores = count($cuentasrevendedores);

?>
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3><?php echo $totalCuentas; ?></h3>

        <p>Cuentas completas</p>
      </div>
      <div class="icon">
        <i class="fas fa-tv"></i>
      </div>
      <a href="#" class="small-box-footer">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3><?php echo $totalPantallas; ?></h3>

        <p>Cuentas Pantalla</p>
      </div>
      <div class="icon">
        <i class="fas fa-tv"></i>
      </div>
      <a href="#" class="small-box-footer">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?php echo $totalCombos; ?></h3>

        <p>Combos</p>
      </div>
      <div class="icon">
        <i class="fas fa-tv"></i>
      </div>
      <a href="#" class="small-box-footer">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small card -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3><?php echo $totalRevendedores; ?></h3>

        <p>Re-vendedores</p>
      </div>
      <div class="icon">
        <i class="fas fa-tv"></i>
      </div>
      <a href="#" class="small-box-footer">
        Más info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
</div>