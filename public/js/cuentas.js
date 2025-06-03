// APAGAR CUENTA
//ApagarCuenta()

var valor = $("#perfilOculto").val();

$('.tablaCuentas').DataTable( {
    ajax: 'ajax/datatable-cuentas.ajax.php?perfilOculto='+valor,
    deferRender: true,
	retrieve: true,
	processing: true,
	scrollX: true,
	language: {
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
		"sLoadingRecords": "Cargando....",
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
CARGAR LA TABLA DINÁMICA DE MEMBRESIAS


var valor = $("#perfilOculto").val();

$('.tablaCuentas').DataTable( {
	destroy: true,
	processing: true,
	serverSide: true,
	scrollX: true,
	deferRender: true,
	retrieve: true,
	//bAutoWidth: true,

    //lengthChange: false,
  	pageLength: 10,
  ajax :{
    url:'ajax/datatable-cuentas-server.ajax.php?perfilOculto='+valor,
    type:'POST'
  },
  columnDefs: [
    { "orderable": false, "target": 1 }
      ],
  language: {

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
=============================================*/

/*=============================================
APAGAR MEMBRESIA

function ApagarCuenta(){
	$.ajax({
	    url:"ajax/cuentasall.ajax.php",
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success: function(respuesta){
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

	    	//RECORRER LAS MEMBRESIAS
	        respuesta.forEach(funcionForEach);

	        function funcionForEach(item, index){
	        	var fecha1 = new Date(fecha);
	            var fecha2 = new Date(item.corte);

	            if(fecha2 >= fecha1) {
	            	var diff = Math.abs(fecha2-fecha1);
					days = diff/(1000 * 3600 * 24)
					var comparar = days+1;
	            }                     

	        	if(item.corte == datofecha){
	        		if(item.corte == "0000-00-00"){

	        		}else{
	        			if (item.estado == 0){

		        		}else{
		        			var cambiarId = item.id;
		  					var cambiarCuenta = 0;
		  					var cambiarOcupado = 0;

			        		var datos = new FormData();
						    datos.append("cambiarId", cambiarId);
						    datos.append("cambiarCuenta", cambiarCuenta);
						    datos.append("cambiarOcupado", cambiarOcupado);

						    $.ajax({
							    url:"ajax/cuentas.ajax.php",
							    method: "POST",
							    data: datos,
							    cache: false,
						      	contentType: false,
						      	processData: false,
						      	success: function(respuesta){
						      
						      	}
					    	})
		        		}
	        		}	        		
				}
	        }
	    }
	})
}
=============================================*/
/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================*/
$("#nuevoEmail").change(function(){
	$(".alert").remove();

	var email = $(this).val();

	var datos = new FormData();
	datos.append("validarEmail", email);

	 $.ajax({
	    url:"ajax/cuentas.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){	    	
	    	console.log("respuesta", respuesta);
	    	if(respuesta){
	    		$("#nuevoEmail").parent().after('<div class="alert alert-warning">Este correo ya existe en la base de datos</div>');
	    		$("#nuevoEmail").val("");
	    	}
	    }
	})
})

/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================
$("#nuevoEmailCopia").change(function(){
	$(".alert").remove();

	var email = $(this).val();

	var datos = new FormData();
	datos.append("validarEmail", email);

	 $.ajax({
	    url:"ajax/cuentas.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	if(respuesta){
	    		$("#nuevoEmailCopia").parent().after('<div class="alert alert-warning">Este correo ya existe con esta plataforma</div>');
	    		$("#nuevoEmailCopia").val("");
	    	}
	    }
	})
})*/

/*=============================================
ACTIVAR USUARIO
=============================================*/
$(".tablaCuentas").on("click", ".btnPantalla", function(){

  var idCuentaP = $(this).attr("idCuentaP");
  var estadoCuenta = $(this).attr("estadoCuenta");

  var datos = new FormData();
    datos.append("activarId", idCuentaP);
    datos.append("activarCuenta", estadoCuenta);

    $.ajax({
    	url:"ajax/cuentas.ajax.php",
	    method: "POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    success: function(respuesta){
	      swal({
	        title: "La cuenta ha sido Actualizada",
	        type: "success",
	        confirmButtonText: "¡Cerrar!"
	      }).then(function(result) {
	          if (result.value) {
	            window.location = "cuentas";
	          }
	      });
      	}
    })
})

/*=============================================
EDITAR USUARIO
=============================================*/
$(".tablaCuentas").on("click", ".btnEditarCuenta", function(){
  var idCuenta = $(this).attr("idCuenta");  
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
    success: function(respuesta){
    	var datos1 = new FormData();
  		datos1.append("idCategoria", respuesta["id_categoria"]);

  		$.ajax({
		    url:"ajax/streaming.ajax.php",
		    method: "POST",
		    data: datos1,
		    cache: false,
		    contentType: false,
		    processData: false,
		    dataType: "json",
		    success: function(respuesta){
		    	$("#editarTipoCuenta").val(respuesta["id"]);
		    	$("#editarTipoCuenta").html(respuesta["nombre"]);
		    }
		})

		$("#editarCodigo").val(respuesta["codigo"]);
		$(".editarEmail").val(respuesta["correo"]);
		$("#passwordActual").val(respuesta["password"]);
		$("#editarPin").val(respuesta["pin"]);
		$("#editarCostoPin").val(respuesta["valor_pin"]);
		$("#editarTipoCuentaP").val(respuesta["modo_cuenta"]);
		if(respuesta["modo_cuenta"] == 1){
			$("#editarTipoCuentaP").html("Completa");
		}else if(respuesta["modo_cuenta"] == 0){
			$("#editarTipoCuentaP").html("Pantallas");
		}else{
			$("#editarTipoCuentaP").html("Re-vendedor");
		}
		$(".editarFacturacion").val(respuesta["facturacion"]);
		$(".editarFactivacion").val(respuesta["activacion"]);
		$(".editarFcorte").val(respuesta["corte"]);
		$("#editarPantallas").val(respuesta["pantallas"]);
		$("#editarActivo").val(respuesta["estado"]);
		if(respuesta["estado"] == 1){
			$("#editarActivo").html("Activar");
		}else{
			$("#editarActivo").html("Desactivar");
		}

		$("#editarEstadoCuentaP").val(respuesta["ocupada"]);
		if(respuesta["ocupada"] == 1){
			$("#editarEstadoCuentaP").html("Ocupada");
		}else{
			$("#editarEstadoCuentaP").html("Libre");
		}
		
    }
  });
})

/*=============================================
SELECCIONAR MEMBRESIA
=============================================*/
function ShowSelected(){
	var idCategoria = document.getElementById("tipoCuenta").value;

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({
	    url:"ajax/streaming.ajax.php",
	    method: "POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success: function(respuesta){
	    	$("#nuevaPantallas").val(respuesta["pantallas"]);
	    }
	});
}

/*=============================================
SELECCIONAR MEMBRESIA
=============================================*/
function ShowSelected1(){
	var idCategoria = document.getElementById("editarTipoCuenta1").value;

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({
	    url:"ajax/streaming.ajax.php",
	    method: "POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success: function(respuesta){
	    	$("#editarPantallas").val(respuesta["pantallas"]);
	    }
	});
}

/*=============================================
EDITAR USUARIO
=============================================*/
$(".tablaCuentas").on("click", ".btnRenovarCuenta", function(){
  var idCuenta = $(this).attr("idCuenta");  
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
    success: function(respuesta){
    	var datos1 = new FormData();
  		datos1.append("idCategoria", respuesta["id_categoria"]);

  		$.ajax({
		    url:"ajax/streaming.ajax.php",
		    method: "POST",
		    data: datos1,
		    cache: false,
		    contentType: false,
		    processData: false,
		    dataType: "json",
		    success: function(respuesta){
		    	$("#renovarTipoCuenta").val(respuesta["id"]);
		    	$("#renovarTipoCuenta").html(respuesta["nombre"]);
		    }
		})

		$("#renovarCodigo").val(respuesta["codigo"]);
		$(".renovarEmail").val(respuesta["correo"]);
		$("#passwordActualR").val(respuesta["password"]);
		$("#renovarPin").val(respuesta["pin"]);
		$("#renovarCostoPin").val(respuesta["valor_pin"]);
		$("#renovarTipoCuentaP").val(respuesta["modo_cuenta"]);
		if(respuesta["modo_cuenta"] == 1){
			$("#renovarTipoCuentaP").html("Completa");
		}else if(respuesta["modo_cuenta"] == 0){
			$("#renovarTipoCuentaP").html("Pantallas");
		}else{
			$("#renovarTipoCuentaP").html("Re-vendedor");
		}
		$(".renovarFacturacion").val(respuesta["facturacion"]);
		$(".renovarFactivacion").val(respuesta["activacion"]);
		$(".renovarFcorte").val(respuesta["corte"]);
		$("#renovarPantallas").val(respuesta["pantallas"]);	
    }
  });
})

/*=============================================
SELECCIONAR MEMBRESIA
=============================================*/
function ShowSelected2(){
	var idCategoria = document.getElementById("renovarTipoCuenta1").value;

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({
	    url:"ajax/streaming.ajax.php",
	    method: "POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success: function(respuesta){
	    	$("#renovarPantallas").val(respuesta["pantallas"]);
	    }
	});
}

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablaCuentas").on("click", ".btnEliminarCuenta", function(){
  var idCuenta = $(this).attr("idCuenta");
  var estadoCuenta = $(this).attr("estadoCuenta");

  swal({
    title: '¿Está seguro de borrar la cuenta?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar cuenta!'
  }).then(function(result){
    if(result.value){
      window.location = "index.php?ruta=cuentas&idCuenta="+idCuenta+"&estadoCuenta="+estadoCuenta;
    }
  })
})