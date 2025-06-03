<?php

ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", "C:/xampp/htdocs/streaming/php_error_log");

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/streaming.controlador.php";
require_once "controladores/cuentas.controlador.php";
require_once "controladores/asociar.controlador.php";
require_once "controladores/pantalla.controlador.php";
require_once "controladores/combos.controlador.php";
require_once "controladores/revendedor.controlador.php";
require_once "controladores/filtro.controlador.php";
require_once "controladores/licencia.controlador.php";
require_once "controladores/anexo.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/streaming.modelo.php";
require_once "modelos/cuentas.modelo.php";
require_once "modelos/asociar.modelo.php";
require_once "modelos/pantalla.modelo.php";
require_once "modelos/combos.modelo.php";
require_once "modelos/revendedor.modelo.php";
require_once "modelos/filtro.modelo.php";
require_once "modelos/licencia.modelo.php";
require_once "modelos/anexo.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();