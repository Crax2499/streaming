<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
<?php if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "GAdministrador"){ ?>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tablero De Control</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar Tablero</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<?php }; ?>

<?php if($_SESSION["perfil"] == "Revendedor"){ ?>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Listado de Cuentas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar Tablero</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<?php }; ?>
  <section class="content">
    <?php if($_SESSION["perfil"] == "Administrador"){ ?>
      <div class="row">
        <div class="col-md-12">
          <?php
            include "inicio/cajas-superiores.php";
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php
            include "inicio/tablas-libres.php";
          ?>
        </div>
      </div>
    <?php }; ?>
    <?php if($_SESSION["perfil"] == "Revendedor"){ ?>
      <div class="row">
        <div class="col-md-12">
          <?php
            include "inicio/tabla-revendedores.php";
          ?>
        </div>
      </div>
    <?php }; ?>
    <?php if($_SESSION["perfil"] == "GAdministrador"){ ?>
      <div class="row">
        <div class="col-md-12">
          <?php
            include "inicio/licencia.php";
          ?>
        </div>
      </div>
    <?php }; ?>
  </section>
</div>