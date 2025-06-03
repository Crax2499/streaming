<?php

require_once "../controladores/cuentas.controlador.php";
require_once "../modelos/cuentas.modelo.php";

require_once "../controladores/asociar.controlador.php";
require_once "../modelos/asociar.modelo.php";

require_once "../controladores/revendedor.controlador.php";
require_once "../modelos/revendedor.modelo.php";

require_once "../controladores/streaming.controlador.php";
require_once "../modelos/streaming.modelo.php";

class TablaCuentas {
    public function mostrarTablaCuentas() {
        $item = null;
        $valor = null;
        $respuesta = ControladorCuentas::ctrMostrarCuentas($item, $valor);
        if (count($respuesta) == 0) {
            echo json_encode(["data" => []]);
            return;
        }

        // Arreglo para almacenar los datos
        $data = [];

        date_default_timezone_set("America/Bogota");
        $fecha = date("Y-m-d");

        foreach ($respuesta as $i => $fila) {
            $fecha1 = new DateTime($fecha);
            $fecha2 = new DateTime($fila["corte"]);
            $diff = $fecha1->diff($fecha2);

            $diasF = ($fila["corte"] < $fecha) ? "0 días" : $diff->days . " días";

            // Nombre del cliente
            $item1 = "id";
            $valor1 = $fila["id_categoria"];
            $streaming = ControladorStreaming::ctrMostrarStreaming($item1, $valor1);
            $nombre = htmlspecialchars($streaming["nombre"], ENT_QUOTES, 'UTF-8');

            // Tipo de cuenta
            if ($fila["modo_cuenta"] == 1) {
                $pantallas = "<button class='btn btn-info btn-sm'>Completa</button>";
            } elseif ($fila["modo_cuenta"] == 0) {
                $pantallas = "<button class='btn btn-warning btn-sm'>Pantallas</button>";
            } else {
                $pantallas = "<button class='btn btn-secondary btn-sm'>Re-vendedor</button>";
            }

            // Fecha de corte
            if ($fila["modo_cuenta"] == 1) {
                $item2 = "id_cuenta";
                $valor2 = $fila["id"];
                $asociarfecha = ControladorAsociar::ctrMostrarAsociar($item2, $valor2);
                $fechaTC = $asociarfecha ? $asociarfecha["fecha_termino"] : "0000-00-00";
            } elseif ($fila["modo_cuenta"] == 0) {
                $fechaTC = "0000-00-00";
            } elseif ($fila["modo_cuenta"] == 2) {
                $item2 = "id_cuenta";
                $valor2 = $fila["id"];
                $revendedorfecha = ControladorRevendedor::ctrMostrarRevendedor($item2, $valor2);
                $fechaTC = $revendedorfecha ? $revendedorfecha["fecha_termino"] : "0000-00-00";
            }

            // Estado de la cuenta
            if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Administrador") {
                if ($fila["corte"] == "0000-00-00" || $fila["corte"] > $fecha) {
                    $buttonEstado = "<button class='btn btn-success btn-sm'>Activada</button>";
                } else {
                    $buttonEstado = "<button class='btn btn-danger btn-sm btnRenovarCuenta' data-toggle='modal' data-target='#modalRenovarCuenta' idCuenta='" . $fila["id"] . "'>Renovar</button>";
                }
            } else {
                $buttonEstado = ($fila["corte"] > $fecha) ? "<button class='btn btn-default btn-sm'>Activada</button>" : "<button class='btn btn-default btn-sm'>Desactivada</button>";
            }

            // Botón de edición
            if (isset($_GET["perfilOculto"]) && in_array($_GET["perfilOculto"], ["Administrador", "GAdministrador"])) {
                $editar = "<div class='btn-group'><button type='button' class='btn btn-success'>Acciones</button><button type='button' class='btn btn-success dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item btnEditarCuenta' idCuenta='" . $fila["id"] . "' data-toggle='modal' data-target='#modalEditarCuenta' href=''>Editar Cuenta</a><a class='dropdown-item btnEliminarCuenta' estadoCuenta='1' idCuenta=" . $fila["id"] . " href='#'>Eliminar Cuenta</a></div></div>";
            } else {
                $editar = "<div class='btn-group pull-right'><button class='btn btn-default'><i class='fa fa-pen'></i> Editar</button></div>";
            }
            $data[] = [
                $i + 1,
                $nombre,
                $fila["correo"],
                $fila["password"],
                $fila["pin"],
                number_format($fila["valor_pin"], 2),
                $fila["activacion"],
                $fila["facturacion"],
                $fila["corte"],
                $fechaTC,
                $pantallas,
                $diasF,
                $buttonEstado,
                $editar
            ];
        }

        // Enviar JSON al cliente
        echo json_encode(["data" => $data]);
    }
}

/*=============================================
ACTIVAR TABLA DE MEMBRESIAS
=============================================*/
$activarMembresias = new TablaCuentas();
$activarMembresias->mostrarTablaCuentas();
