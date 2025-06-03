<?php
  session_start();
  error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Streaming</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!--=====================================
  PLUGINS DE CSS
  ======================================-->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/dist/css/adminlte.css">
  <!-- icheck bootstrap 
  <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">-->
  <!-- DataTables -->
  <link rel="stylesheet" href="public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="public/plugins/bootstrap-daterangepicker/daterangepicker.css">
  <!-- Daterange picker bootstrap -->
  <link rel="stylesheet" href="public/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="public/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="public/plugins/morris.js/morris.css">
  <!-- summernote -->
  <link rel="stylesheet" href="public/plugins/summernote/summernote-bs4.min.css">

  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->
  <!-- jQuery -->
  <script src="public/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="public/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="public/dist/js/demo.js"></script>
  <!-- SweetAlert2 -->
  <script src="public/plugins/sweetalert2a/sweetalert2.all.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="public/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="public/plugins/jszip/jszip.min.js"></script>
  <script src="public/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="public/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- InputMask -->
  <script src="public/plugins/moment/moment.min.js"></script>
  <script src="public/plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- Select2 -->
  <script src="public/plugins/select2/js/select2.full.min.js"></script>
  <!-- date-range-picker -->
  <script src="public/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="public/plugins/moment/min/moment.min.js"></script>
  <script src="public/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap datepicker -->
  <script src="public/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- jQuery Number -->
  <script src="public/plugins/jqueryNumber/jquerynumber.min.js"></script>
  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="public/plugins/raphael/raphael.min.js"></script>
  <script src="public/plugins/morris.js/morris.min.js"></script>
  <!-- Summernote -->
  <script src="public/plugins/summernote/summernote-bs4.min.js"></script>
</head>

<?php

    if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
     echo '<body class="hold-transition sidebar-mini">
            <!-- Site wrapper -->
              <div class="wrapper">';
       /*=============================================
          CABEZOTE
        =============================================*/
        include "modulos/cabezote.php";

        /*=============================================
          MENU
        =============================================*/
        include "modulos/menu.php";

        /*=============================================
        CONTENIDO
        =============================================*/

      if(isset($_GET["ruta"])){

        if($_GET["ruta"] == "usuarios" ||
           $_GET["ruta"] == "cuentas" ||
           $_GET["ruta"] == "cuenta-completa" ||
           $_GET["ruta"] == "cuenta-pantalla" ||
           $_GET["ruta"] == "crear-cuenta-combo" ||
           $_GET["ruta"] == "combos" ||
           $_GET["ruta"] == "editar-combo" ||
           $_GET["ruta"] == "renovar-combo" ||
           $_GET["ruta"] == "cuenta-revendedores" ||
           $_GET["ruta"] == "categorias" ||
           $_GET["ruta"] == "reporte-completa" ||
           $_GET["ruta"] == "reporte-pantallas" ||
           $_GET["ruta"] == "reporte-combos" ||
           $_GET["ruta"] == "reporte-revendedor" ||
           $_GET["ruta"] == "filtro-cuentas" ||
           $_GET["ruta"] == "cuentas-desactivadas" ||
           $_GET["ruta"] == "inicio" ||
           $_GET["ruta"] == "licencia" ||
           $_GET["ruta"] == "anexos" ||
           $_GET["ruta"] == "salir"){
          include "modulos/".$_GET["ruta"].".php";
        }else{
          include "modulos/404.php";
        }
      }else{
        include "modulos/inicio.php";
      }

      /*=============================================
        FOOTER
      =============================================*/
      include "modulos/footer.php";
  }else{
      echo '<body class="hold-transition login-page">';
        /*=============================================
          LOGIN
        =============================================*/
        include "modulos/login.php";
  }

  ?>
</div>
<!-- ./wrapper -->
  <script src="public/js/plantilla.js"></script>
  <script src="public/js/usuarios.js"></script>
  <script src="public/js/streaming.js"></script>
  <script src="public/js/cuentas.js"></script>
  <script src="public/js/cuentacompleta.js"></script>
  <script src="public/js/pantallas.js"></script>
  <script src="public/js/combo.js"></script>
  <script src="public/js/revendedor.js"></script>
  <script src="public/js/reportecompleta.js"></script>
  <script src="public/js/reportepantalla.js"></script>
  <script src="public/js/reportecombo.js"></script>
  <script src="public/js/reporterevendedor.js"></script>
  <script src="public/js/filtro.js"></script>
  <script src="public/js/licencia.js"></script>
  <script src=public/js/anexo.js></script>
</body>
</html>