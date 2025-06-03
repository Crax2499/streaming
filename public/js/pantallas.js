//LlenarCuenta()
/*=============================================
CARGAR LA TABLA DINÁMICA DE MEMBRESIAS
=============================================*/
$.ajax({
	url: "ajax/datatable-pantallas.ajax.php",
		success:function(respuesta){
	}
})
var valor = $(perfilOculto).val();

$('.tablaPantallas').DataTable( {
    "ajax": "ajax/datatable-pantallas.ajax.php?perfilOculto="+valor,
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"scrollX": true,
	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}
	}
});

/*=============================================
APAGAR MEMBRESIA

function LlenarCuenta(){
	var fecha = new Date(); //Fecha actual
	var mes = fecha.getMonth()+1; //obteniendo mes
	var dia = fecha.getDate(); //obteniendo dia
	var ano = fecha.getFullYear(); //obteniendo año

	if(dia<10){
		dia='0'+dia; //agrega cero si el menor de 10
	}				
	if(mes<10){
		mes='0'+mes //agrega cero si el menor de 10
	}
	var datofecha = ano+"-"+mes+"-"+dia;

	var datosi = new FormData();
 	datosi.append("idPantalla", datofecha);

	$.ajax({
	    url:"ajax/pantallasall.ajax.php",
	    method: "POST",
    	data: datosi,
    	cache: false,
   		contentType: false,
    	processData: false,
    	dataType: "json",
	    success: function(respuesta){
	    	console.log("respuesta", respuesta);
	    	var fecha = new Date(); //Fecha actual
	    	var mes = fecha.getMonth()+1; //obteniendo mes
			var dia = fecha.getDate(); //obteniendo dia
			var ano = fecha.getFullYear(); //obteniendo año

			if(dia<10){
				dia='0'+dia; //agrega cero si el menor de 10
			}				
			if(mes<10){
				mes='0'+mes //agrega cero si el menor de 10
			}
			var datofecha = ano+"-"+mes+"-"+dia;

	    	var fecha1 = new Date(fecha);
	        var fecha2 = new Date(respuesta["fecha_termino"]);	            

	      	if(respuesta["renovo_regresa"] == 1){
	      		if(respuesta["fecha_termino"] <= datofecha){
	        		if(respuesta["fecha_termino"] == "0000-00-00"){

	        		}else{ 			
	        			var idCuenta = respuesta["id_cuenta"];

		        		var datos = new FormData();
						datos.append("idCuenta", idCuenta);

						$.ajax({
							url:"ajax/cuentas.ajax.php",
							method: "POST",
							data: datos,
							cache: false,
							contentType: false,
							processData: false,
							dataType: "json",
							success: function(respuesta1){
								var numero1 = respuesta1["pantallas"];
								var numero2 = "1";

								var idCuentam = respuesta1["id"];
								var sumaUno = parseFloat(numero1)+parseFloat(numero2);

								var datosm = new FormData();
								datosm.append("idCuentam", idCuentam);
								datosm.append("sumaUno", sumaUno);

								$.ajax({
									url:"ajax/cuentas.ajax.php",
									method: "POST",
									data: datosm,
									cache: false,
									contentType: false,
									processData: false,
									success: function(respuesta){

									}
								})

								var idCuentaR = respuesta["id"];
								var cambiaruno = 0;

								var datosr = new FormData();
								datosr.append("idCuentaR", idCuentaR);
								datosr.append("cambiaruno", cambiaruno);

								$.ajax({
									url:"ajax/pantallas.ajax.php",
									method: "POST",
									data: datosr,
									cache: false,
									contentType: false,
									processData: false,
									success: function(respuesta){

									}
								})
							}
						})
	        		}	        		
				}   
	      	}
	    }
	})
}
=============================================*/
/*=============================================
EDITAR PANTALLA
=============================================*/
$(".tablas").on("click", ".btnEditarPantalla", function(){
  var idPantalla = $(this).attr("idPantalla");

  var datos = new FormData();
  datos.append("idPantalla", idPantalla);

  $.ajax({
    url:"ajax/pantallas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
    	var datos1 = new FormData();
  		datos1.append("idCuenta", respuesta["id_cuenta"]);

  		$.ajax({
		    url:"ajax/cuentas.ajax.php",
		    method: "POST",
		    data: datos1,
		    cache: false,
		    contentType: false,
		    processData: false,
		    dataType: "json",
		    success: function(respuesta){
		    	$("#editarAsociacion").val(respuesta["id"]);
		    	$("#editarAsociacion").html(respuesta["correo"]);
		    	$("#editarFcorte").val(respuesta["corte"]);
		    	$("#editarComparar").val(respuesta["id"]);
		    }
		})

  		$("#editarId").val(idPantalla);
		$(".editarFtermino").val(respuesta["fecha_termino"]);
		$("#editarPrecioC").val(respuesta["costo"]);
		$("#editarCliente").val(respuesta["cliente"]);
		$("#editarNumero").val(respuesta["telefono"]);
		$("#editarNombrePantalla").val(respuesta["pantalla"]);
		$("#editarPasswordP").val(respuesta["pass"]);
		$("#editarCodigoSecret").val(respuesta["renovo_cuenta"]);
    }
  });
})

/*=============================================
EDITAR PANTALLA
=============================================*/
$(".tablas").on("click", ".btnRenovarPantalla", function(){
  var idPantalla = $(this).attr("idPantalla");

  var datos = new FormData();
  datos.append("idPantalla", idPantalla);

  $.ajax({
    url:"ajax/pantallas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
    	var datos1 = new FormData();
  		datos1.append("idCuenta", respuesta["id_cuenta"]);

  		$.ajax({
		    url:"ajax/cuentas.ajax.php",
		    method: "POST",
		    data: datos1,
		    cache: false,
		    contentType: false,
		    processData: false,
		    dataType: "json",
		    success: function(respuesta){
		    	$("#editarAsociacionR").val(respuesta["id"]);
		    	$("#editarAsociacionR").html(respuesta["correo"]);
		    	$("#editarFcorteR").val(respuesta["corte"]);
		    	$("#nuevaPantallasR").val(respuesta["pantallas"]-1);
		    }
		})

  		$("#editarIdR").val(idPantalla);
		$(".editarFterminoR").val(respuesta["fecha_termino"]);
		$("#editarPrecioCR").val(respuesta["costo"]);
		$("#editarClienteR").val(respuesta["cliente"]);
		$("#editarNumeroR").val(respuesta["telefono"]);
		$("#editarNombrePantallaR").val(respuesta["pantalla"]);
		$("#editarPasswordPR").val(respuesta["pass"]);
		$("#editarCodigoSecretoR").val(respuesta["renovo_cuenta"]);
	}
  });
})

/*=============================================
SELECCIONAR FECHA CORTE
=============================================*/
function ShowSelectedTerminoPan(){
	var idTermino = document.getElementById("terminoCuenta").value;

	var datos = new FormData();
	datos.append("idCuenta", idTermino);

	$.ajax({
	    url:"ajax/cuentas.ajax.php",
	    method: "POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success: function(respuesta){
	    	$("#nuevaFcorte").val(respuesta["corte"]);
	    	$("#nuevaPantallas").val(respuesta["pantallas"]-1);
	    }
	});
}

/*=============================================
ELIMINAR PANTALLA
=============================================*/
$(".tablas").on("click", ".btnEliminarPantalla", function(){
  var idPantalla = $(this).attr("idPantalla");
  var idCuenta = $(this).attr("idCuenta");

  swal({
    title: '¿Está seguro de borrar la pantalla?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar pantalla!'
  }).then(function(result){
    if(result.value){
      window.location = "index.php?ruta=cuenta-pantalla&idPantalla="+idPantalla+"&idCuenta="+idCuenta;
    }
  })
})

$(document).ready(function(){
	//Capturas el cambio de algun input radio
  	$("input[type='radio']").change(function(){
  		//obtenes el valor de los dos sets de Radios
    	var opc = $("input[name='opc']:checked").val();

		if (opc == "1") {
			document.getElementById("clienteN").style.display = "block";
			document.getElementById("clienteR").style.display = "none";
		}
		if (opc == "0") {
			document.getElementById("clienteN").style.display = "none";
			document.getElementById("clienteR").style.display = "block";
		}
  	})
})

/*=============================================
SELECCIONAR FECHA CORTE
=============================================*/
function ShowSelectedTelefono(){
	var nuevaCuentaR = document.getElementById("nuevaCuentaR").value;

	var datos = new FormData();
	datos.append("nuevaCuenta", nuevaCuentaR);

	$.ajax({
	    url:"ajax/usuarios.ajax.php",
	    method: "POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success: function(respuesta){
	    	$("#nuevoNumero").val(respuesta["telefono"]);
	    }
	});
}

/*=============================================
SELECCIONAR FECHA CORTE
=============================================*/
function ShowSelectedTerminoR(){
	var idTermino = document.getElementById("renovarTerminoCuenta").value;

	var datos = new FormData();
	datos.append("idCuenta", idTermino);

	$.ajax({
	    url:"ajax/cuentas.ajax.php",
	    method: "POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success: function(respuesta){
			$("#editarFcorte").val(respuesta["corte"]);
			$("#nuevaPantallasR").val(respuesta["pantallas"]-1);
	    }
	});
}