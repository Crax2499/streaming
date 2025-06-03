<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Filtro de Cuentas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Filtro de Cuentas</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <div class="input-group">
          
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <?php
              include "reportes/reporte-filtro-cuentas.php";
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>