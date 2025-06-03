/*=============================================
CARGAR LA TABLA DINÁMICA DE MEMBRESIAS
=============================================*/
$.ajax({
	url: "ajax/datatable-asociacionr.ajax.php",
		success:function(respuesta){
	}
})

var valor = $(perfilOculto).val();

$('.tablaAsociacionR').DataTable( {
    "ajax": "ajax/datatable-asociacionr.ajax.php?perfilOculto="+valor,
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
EDITAR USUARIO
=============================================*/
$(".tablaAsociacionR").on("click", ".btnEditarRevendedor", function(){
  var idRevendedor = $(this).attr("idRevendedor");

  var datos = new FormData();
  datos.append("idRevendedor", idRevendedor);

  $.ajax({
    url:"ajax/revendedor.ajax.php",
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

  		$("#editarId").val(idRevendedor);
		$(".editarFtermino").val(respuesta["fecha_termino"]);
		$("#editarPrecioC").val(respuesta["precio"]);
		$("#editarRevendedor").val(respuesta["nombre_revendedor"]);
		$("#editarNumero").val(respuesta["telefono"]);
		$("#editarCodigo").val(respuesta["codigo"]);
    }
  });
})

/*=============================================
RENOVAR REVENDEDOR
=============================================*/
$(".tablaAsociacionR").on("click", ".btnRenovarRevendedor", function(){
  var idRevendedor = $(this).attr("idRevendedor");

  var datos = new FormData();
  datos.append("idRevendedor", idRevendedor);

  $.ajax({
    url:"ajax/revendedor.ajax.php",
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
		    	$("#renovarContrasena").val(respuesta["password"]);
		    }
		})

  		$("#renovarId").val(idRevendedor);
		$("#renovarPrecioC").val(respuesta["precio"]);
		$("#renovarRevendedor").val(respuesta["nombre_revendedor"]);
		$("#renovarNumero").val(respuesta["telefono"]);
		$("#renovarCodigo").val(respuesta["codigo"]);
    }
  });
})

/*=============================================
ELIMINAR REVENDEDOR
=============================================*/
$(".tablaAsociacionR").on("click", ".btnEliminarRenovar", function(){
  var idRenovar = $(this).attr("idRenovar");
  var idCuenta = $(this).attr("idCuenta");

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
      window.location = "index.php?ruta=cuenta-revendedores&idRenovar="+idRenovar+"&idCuenta="+idCuenta;
    }
  })
})