<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="inicio" class="brand-link">
    <img src="public/dist/img/logo pu-02.png" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">STREAMING</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <?php
        if($_SESSION["foto"] != ""){
          echo '<div class="image">
            <img src="'.$_SESSION["foto"].'" class="img-circle elevation-2" alt="User Image">
          </div>';
        }else{
          echo '<div class="image">
            <img src="public/img/usuarios/default/anonymous.png" class="img-circle elevation-2" alt="User Image">
          </div>';
        }
      ?>
      
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION["nombre"]; ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="inicio" class="nav-link">
            <i class="nav-icon fas fa-archway"></i>
            <p>
              Inicio
            </p>
          </a>
        </li>
        <?php if($_SESSION["perfil"] == "Administrador"){ ?>
          <li class="nav-item">
            <a href="usuarios" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="categorias" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Tipo de Streaming
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cuentas" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Sección Cuentas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li>
                <a href="cuentas" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Crear Cuenta
                  </p>
                </a>
              </li>
              <li>
                <a href="cuenta-completa" class="nav-link">
                  <i class="nav-icon fas fa-th-large"></i>
                  <p>
                    Cuentas Completas
                  </p>
                </a>
              </li>
              <li>
                <a href="cuenta-pantalla" class="nav-link">
                  <i class="nav-icon fas fa-tv"></i>
                  <p>
                    Cuenta Pantallas
                  </p>
                </a>
              </li>
              <li>
                <a href="crear-cuenta-combo" class="nav-link">
                  <i class="nav-icon fas fa-boxes"></i>
                  <p>
                    Combos
                  </p>
                </a>
              </li>
            </ul>
            <li class="nav-item">
              <a href="cuenta-revendedores" class="nav-link">
                <i class="nav-icon fas fa-tv"></i>
                <p>
                  Cuentas Revendedores
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Reportes
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li>
                  <?php date_default_timezone_set('America/Bogota');
                  $fecha = date('Y-m-d'); ?>
                  <a href="index.php?ruta=reporte-completa&fechaInicial=<?php echo $fecha ?>&fechaFinal=<?php echo $fecha ?>" class="nav-link">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>
                      Reporte Completa
                    </p>
                  </a>
                </li>
                <li>
                  <?php date_default_timezone_set('America/Bogota');
                    $fecha = date('Y-m-d'); ?>
                  <a href="index.php?ruta=reporte-pantallas&fechaInicial=<?php echo $fecha ?>&fechaFinal=<?php echo $fecha ?>" class="nav-link">
                    <i class="nav-icon fas fa-tv"></i>
                    <p>
                      Reporte Pantallas
                    </p>
                  </a>
                </li>
                <li>
                  <?php date_default_timezone_set('America/Bogota');
                    $fecha = date('Y-m-d'); ?>
                  <a href="index.php?ruta=reporte-combos&fechaInicial=<?php echo $fecha ?>&fechaFinal=<?php echo $fecha ?>" class="nav-link">
                    <i class="nav-icon fas fa-boxes"></i>
                    <p>
                      Reporte Combos
                    </p>
                  </a>
                </li>
                <li>
                  <?php date_default_timezone_set('America/Bogota');
                    $fecha = date('Y-m-d'); ?>
                  <a href="index.php?ruta=reporte-revendedor&fechaInicial=<?php echo $fecha ?>&fechaFinal=<?php echo $fecha ?>" class="nav-link">
                    <i class="nav-icon fas fa-tv"></i>
                    <p>
                      Reporte Revendedores
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="filtro-cuentas" class="nav-link">
                <i class="nav-icon fas fa-filter"></i>
                <p>
                  Filtro Cuentas
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="cuentas-desactivadas" class="nav-link">
                <i class="nav-icon fas fa-tv"></i>
                <p>
                  Cuentas Desactivadas
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="anexos" class="nav-link">
                <i class="nav-icon fas fa-wrench"></i>
                <p>
                  Recodatorios
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="anexos" class="nav-link">
                <i class="nav-icon fab fa-whmcs"></i>
                <p>
                  configuraciones
                </p>
              </a>
            </li>
          </li>
        <?php }; ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>