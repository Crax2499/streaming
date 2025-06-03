/*=============================================
CARGAR LA TABLA DINÁMICA DE MEMBRESIAS
=============================================*/
$.ajax({
	url: "ajax/datatable-asociacion.ajax.php",
		success:function(respuesta){
	}
})

var valor = $(perfilOculto).val()

$('.tablaAsociacion').DataTable( {
    "ajax": "ajax/datatable-asociacion.ajax.php?perfilOculto="+valor,
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
SELECCIONAR FECHA CORTE
=============================================*/
function ShowSelectedTermino(){
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
	    	$("#nuevaPantallas").val(respuesta["pantallas"]);
	    }
	});
}


/*=============================================
SELECCIONAR FECHA CORTE
=============================================*/
function ShowSelectedTerminoE(){
	var idTermino = document.getElementById("editarTerminoCuenta").value;

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
	    }
	});
}

/*=============================================
EDITAR USUARIO
=============================================*/
$(".tablaAsociacion").on("click", ".btnEditarAsociacion", function(){
  var idAsociacion = $(this).attr("idAsociacion");

  var datos = new FormData();
  datos.append("idAsociacion", idAsociacion);

  $.ajax({
    url:"ajax/asociacion.ajax.php",
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
		    	$("#editarAsociacionAntes").val(respuesta["id"]);
		    }
		})

  		$("#editarId").val(idAsociacion);
		$(".editarFtermino").val(respuesta["fecha_termino"]);
		$("#editarPrecioC").val(respuesta["precio"]);
		$("#editarCliente").val(respuesta["nombre_cliente"]);
		$("#editarNumero").val(respuesta["telefono"]);
		$("#editarCodigo").val(respuesta["codigo"]);
    }
  });
})

/*=============================================
RENOVAR CUENTA COMPLETA
=============================================*/
$(".tablaAsociacion").on("click", ".btnRenovarAsociacion", function(){
  var idAsociacion = $(this).attr("idAsociacion");

  var datos = new FormData();
  datos.append("idAsociacion", idAsociacion);

  $.ajax({
    url:"ajax/asociacion.ajax.php",
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
		    	$("#renovarAsociacion").val(respuesta["id"]);
		    	$("#renovarAsociacion").html(respuesta["correo"]);
		    	$("#renovarFcorte").val(respuesta["corte"]);
		    	$("#renovarAsociacionAntes").val(respuesta["id"]);
		    }
		})

  		$("#renovarId").val(idAsociacion);
		//$(".renovarFtermino").val(respuesta["fecha_termino"]);
		$("#renovarPrecioC").val(respuesta["precio"]);
		$("#renovarCliente").val(respuesta["nombre_cliente"]);
		$("#renovarNumero").val(respuesta["telefono"]);
		$("#renovarCodigo").val(respuesta["codigo"]);
    }
  });
})

/*=============================================
ELIMINAR ASOCIACION
=============================================*/
$(".tablaAsociacion").on("click", ".btnEliminarAsociacion", function(){
  var idAsociacion = $(this).attr("idAsociacion");
  var idCuenta = $(this).attr("idCuenta");
  var estadoCuenta = $(this).attr("estadoCuenta");

  swal({
    title: '¿Está seguro de borrar esta cuenta?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar cuenta!'
  }).then(function(result){
    if(result.value){
      window.location = "index.php?ruta=cuenta-completa&idAsociacion="+idAsociacion+"&estadoCuenta="+estadoCuenta+"&idCuenta="+idCuenta;
    }
  })
})