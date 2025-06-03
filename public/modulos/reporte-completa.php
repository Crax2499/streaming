<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Reporte de cuentas completas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Reporte Completa</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header">
        <div class="input-group">
          <button type="button" class="btn btn-danger pull-right" id="daterange-btn1">
            <i class="far fa-calendar-alt"></i>
            <span>              
              <?php
                if(isset($_GET["fechaInicial"])){
                  echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];              
                }else{                 
                  echo 'Rango de fecha';
                }
              ?>
            </span>
            <i class="fas fa-caret-down"></i>       
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <?php
              include "reportes/reporte-cuentas-completas.php";
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>