<?php

class ControladorCuentas{

    public function ctrRegistroCuenta(){
		if(isset($_POST["nuevoCostoPin"])){
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoTipoCuentaP"])){

				$fecha = date('Y-m-d');

				$aleatorio = mt_rand(1000,99999);

				if ($_POST["nuevaFcorte"] != "") {
					$lafecha = $_POST["nuevaFcorte"];
				}else{
					$lafecha = "0000-00-00";
				}

				$datos = array("id_categoria"=> $_POST["nuevoTipoCuenta"],
							   "modo_cuenta"=> $_POST["nuevoTipoCuentaP"],
							   "correo"=> $_POST["nuevoEmail"],
							   "password"=> $_POST["nuevoPassword"],
							   "pin"=> $_POST["nuevoPin"],
							   "valor_pin"=> $_POST["nuevoCostoPin"],
							   "codigo"=> $aleatorio,
							   "activacion"=> $_POST["nuevaFactivacion"],
							   "facturacion"=> $_POST["nuevaFacturacion"],
							   "corte"=> $lafecha,
							   "pantallas"=> $_POST["nuevaPantallas"],
							   "estado"=> 1,
							   "fecha_creado"=> $fecha);

				$tabla = "cuentas";
				$respuesta = ModeloCuentas::mdlRegistroCuentas($tabla, $datos);

				$tabla1 = "cuentas_registro";
				$respuesta = ModeloCuentas::mdlRegistroCuentasR($tabla1, $datos);

				if($respuesta == "ok"){
					echo '<script> 
							swal({
							  type: "success",
							  title: "La cuenta ha sido registrada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {
								window.location = "cuentas";
								}
							})
						</script>';
				}else{
					echo '<script> 
						swal({
							type: "error",
							title: "¡La cuenta no pudo ser registrada por algun fallo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){							
								window.location = "cuentas";
							}
						});
					</script>';
				}
			}else{
				echo '<script> 
						swal({
							type: "error",
							title: "¡La cuenta no puede ir vacía o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){							
								window.location = "cuentas";
							}
						});
					</script>';
			}
		}
	}

	/*== MOSTRAR CUENTAS ==*/
	static public function ctrMostrarCuentas($item, $valor){
		$tabla = "cuentas";
        return ModeloCuentas::mdlMostrarCuentas($tabla, $item, $valor);
	}

	/*== MOSTRAR CUENTAS ==*/
	static public function ctrMostrarCuentasFull($item, $valor){
		$tabla = "cuentas";
        return ModeloCuentas::mdlMostrarCuentasFull($tabla, $item, $valor);
	}
	
    static public function ctrMostrarCuentasDesactivadas($item, $valor, $orden){
        $tabla = "cuentas";
        return ModeloCuentas::mdlMostrarCuentasDesactivadas($tabla, $item, $valor, $orden);
	}

	/*=============================================
	MOSTRAR CUENTAS R
	=============================================*/
	static public function ctrMostrarCuentasR($item, $valor){
		$tabla = "cuentas_registro";
        return ModeloCuentas::mdlMostrarCuentasR($tabla, $item, $valor);
	}

	/*=============================================
	REGISTRO DE CUENTAS
	=============================================*/
	public function ctrEditarCuenta(){
		if(isset($_POST["editarCostoPin"])){
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarTipoCuentaP"])){

				if($_POST["editarPassword"] != ""){
					$contrasena = $_POST["editarPassword"];
				}else{
					$contrasena = $_POST["passwordActual"];
				}

				$datos = array("id_categoria"=> $_POST["editarTipoCuenta"],
							   "modo_cuenta"=> $_POST["editarTipoCuentaP"],
							   "correo"=> $_POST["editarEmail"],
							   "password"=> $contrasena,
							   "pin"=> $_POST["editarPin"],
							   "valor_pin"=> $_POST["editarCostoPin"],
							   "codigo"=> $_POST["editarCodigo"],
							   "activacion"=> $_POST["editarFactivacion"],
							   "facturacion"=> $_POST["editarFacturacion"],
							   "corte"=> $_POST["editarFcorte"],
							   "ocupada"=> $_POST["editarEstadoCuentaP"],
							   "pantallas"=> $_POST["editarPantallas"]);

				$tabla = "cuentas";
				$respuesta = ModeloCuentas::mdlEditarCuentas($tabla, $datos);

				//$tabla1 = "cuentas_respaldo";
				//$respuesta = ModeloCuentas::mdlEditarCuentas($tabla1, $datos);

				if($respuesta == "ok"){
					echo '<script> 
							swal({
							  type: "success",
							  title: "La cuenta ha sido editada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {
								window.location = "cuentas";
								}
							})
						</script>';
				}else{
					echo '<script> 
						swal({
							type: "error",
							title: "¡La cuenta no pudo ser editada por algun fallo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){							
								window.location = "cuentas";
							}
						});
					</script>';
				}
			}else{
				echo '<script> 
						swal({
							type: "error",
							title: "¡La cuenta no puede ir vacía o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){							
								window.location = "cuentas";
							}
						});
					</script>';
			}
		}
	}

	/*=============================================
	RENOVAR CUENTAS
	=============================================*/
	public function ctrRenovarCuenta(){
		if(isset($_POST["renovarCostoPin"])){
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["renovarTipoCuenta"])){

				$aleatorio = mt_rand(1000,99999);

				if($_POST["renovarPassword"] != ""){
					$contrasena = $_POST["renovarPassword"];
				}else{
					$contrasena = $_POST["passwordActualR"];
				}

				$datos = array("id_categoria"=> $_POST["renovarTipoCuenta"],
							   "modo_cuenta"=> $_POST["renovarTipoCuentaP"],
							   "correo"=> $_POST["renovarEmail"],
							   "password"=> $contrasena,
							   "pin"=> $_POST["renovarPin"],
							   "valor_pin"=> $_POST["renovarCostoPin"],
							   "codigo"=> $_POST["renovarCodigo"],
							   "codigo1"=> $aleatorio,
							   "activacion"=> $_POST["renovarFactivacion"],
							   "facturacion"=> $_POST["renovarFacturacion"],
							   "corte"=> $_POST["renovarFcorte"],
							   "pantallas"=> $_POST["renovarPantallas"],
							   "estado" => 1);

				$tabla = "cuentas";
				$respuesta = ModeloCuentas::mdlEditarCuentasR($tabla, $datos);

				$tabla1 = "cuentas_registro";
				$respuesta = ModeloCuentas::mdlRegistroCuentasR($tabla1, $datos);

				if($respuesta == "ok"){
					echo '<script> 
							swal({
							  type: "success",
							  title: "La cuenta ha sido editada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {
								window.location = "cuentas";
								}
							})
						</script>';
				}else{
					echo '<script> 
						swal({
							type: "error",
							title: "¡La cuenta no pudo ser editada por algun fallo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){							
								window.location = "cuentas";
							}
						});
					</script>';
				}
			}else{
				echo '<script> 
						swal({
							type: "error",
							title: "¡La cuenta no puede ir vacía o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){							
								window.location = "cuentas";
							}
						});
					</script>';
			}
		}
	}

	/*=============================================
	MOSTRAR CUENTAS RESPALDO
	=============================================*/
	static public function ctrMostrarCuentasRegistro($item, $valor){
		$tabla = "cuentas_registro";
		$respuesta = ModeloCuentas::mdlMostrarCuentasRegistro($tabla, $item, $valor);
		return $respuesta;
	}

	/*=============================================
	BORRAR CUENTA
	=============================================*/
	static public function ctrBorrarCuenta(){
		if(isset($_GET["idCuenta"])){
			$tabla ="cuentas";

			$item2 = "id";
			$valor2 = $_GET["idCuenta"];

			$item1 = "desactivado";
			$valor1 = $_GET["estadoCuenta"];

			$respuesta = ModeloCuentas::mdlActualizarCuentaPC($tabla, $item1, $valor1, $item2, $valor2);

			if($respuesta == "ok"){
				echo'<script>
				swal({
					  type: "success",
					  title: "La cuenta ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {
								window.location = "cuentas";
								}
							})
				</script>';
			}
		}
	}

	#LISTAR TODOS LOS REGISTROS SOLICITADOS POR EL CLIENTE.
	#-----------------------------------------------------------
	static public function allValoresControlador($tabla,$where,$orderBy){
        return ModeloCuentas::allValoresModelo($tabla,$where,$orderBy);
	}
}