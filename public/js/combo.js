/*=============================================
FORMATO AL PRECIO DE LOS COMBOS
=============================================*/
$("#nuevoTotalVenta").number(true, 2);

/*=============================================
Data Table
=============================================*/
$(".tablaCombo").DataTable({

	"ajax": "ajax/datatable-combos.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"scrollX": true,
});

/*=============================================
AGREGANDO CUENTAS DESDE LA TABLA DE INVENTARIO DE CUENTAS
=============================================*/
$(".tablaCombo tbody").on("click", "button.agregarProducto", function(){

	var idCuenta = $(this).attr("idProducto");

	//$(this).removeClass("btn-primary agregarProducto");
	//$(this).addClass("btn-default");

	var datos = new FormData();
    datos.append("idCuenta", idCuenta);

    $.ajax({
     	url:"ajax/cuentas.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      		var descripcion = respuesta["correo"];
          	var stock = respuesta["pantallas"];
          	var fechaCorte = respuesta["corte"];
          	var categoria = respuesta["id_categoria"];

          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/
          	if(stock == 0){
      			swal({
			      title: "No hay stock disponible",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

			    $("button[idProducto='"+idCuenta+"']").addClass("btn-primary agregarProducto");
			    return;
          	}

          	$(".nuevoProducto").append(
          	'<div class="input-group mb-2" style="padding:-1px 8px">'+
          	  '<!-- Descripción del producto -->'+	          
	          '<div class="col-xs-6 col-md-6" style="padding-right:0px">'+	          
	            '<div class="input-group">'+	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-ls quitarProducto" idProducto="'+idCuenta+'"><i class="fa fa-times"></i></button></span>'+
	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idCuenta+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+
	            '</div>'+
	          '</div>'+
	          '<!-- Categoria del producto -->'+
	          '<div class="">'+	            
	             '<input type="hidden" class="form-control nuevaCategoria" name="nuevaCategoria" value="'+categoria+'" required>'+
	          '</div>'+
	          '<!-- Cantidad del producto -->'+
	          '<div class="col-xs-2 col-md-2">'+	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
	          '</div>' +
	          '<!-- pass de la cuenta -->'+
	          '<div class="col-xs-3 col-md-2">'+	            
	             '<input type="text" class="form-control passNueva" name="passNueva" placeholder="Password" value="" passNueva="0000" required>'+
	          '</div>'+
	          '<!-- contraseña del producto -->'+
	          '<div class="col-xs-3 col-md-2">'+	            
	             '<input type="text" class="form-control nuevaContrasena" name="nuevaContrasena" placeholder="N.Pantalla" value="" nuevaPass="0000" required>'+
	          '</div>'+         
	          '<!-- fecha del producto -->'+
	          '<div class="col-xs-3 col-md-3">'+	            
	             '<input type="hidden" class="form-control nuevaFechaCorte" name="agregarFecha" value="'+fechaCorte+'" readonly required>'+
	          '</div>'+
	        '</div>')

	        // AGRUPAR PRODUCTOS EN FORMATO JSON
	        listarProductos()

	        localStorage.removeItem("quitarProducto");	    
      	}
    })
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/
$(".tablaCombo").on("draw.dt", function(){
	if(localStorage.getItem("quitarProducto") != null){
		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			//$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');
		}
	}
})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/
var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioAsociar").on("click", "button.quitarProducto", function(){
	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/
	if(localStorage.getItem("quitarProducto") == null){
		idQuitarProducto = [];	
	}else{
		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))
	}

	idQuitarProducto.push({"idProducto":idProducto});
	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));
	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	// AGRUPAR PRODUCTOS EN FORMATO JSON
	listarProductos()
})

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/
var numProducto = 0;

$(".btnAgregarProducto").click(function(){
	numProducto ++;

	var datos = new FormData();
	datos.append("traerProductos", "ok");

	$.ajax({
		url:"ajax/cuentas.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
          	var descripcion = respuesta["correo"];
          	var stock = respuesta["pantallas"];
          	var fechaCorte = respuesta["corte"];
          	var categoria = respuesta["id_categoria"];

      	    $(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+
			  '<!-- Descripción del producto -->'+	          
	          '<div class="col-xs-6" style="padding-right:0px">'+	          
	            '<div class="input-group">'+	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-md quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+
	              '<select class="form-control nuevaDescripcionProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+
	              '<option>Seleccione el producto</option>'+
	              '</select>'+  
	            '</div>'+
	          '</div>'+
	          '<!-- Categoria del producto -->'+
	          '<div class="">'+	            
	             '<input type="text" class="form-control nuevaCategoria" name="nuevaCategoria" categoriaNueva required>'+
	          '</div>'+
	          '<!-- Cantidad del producto -->'+
	          '<div class="col-xs-6" style="padding-top:3px">'+	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock nuevoStock required>'+
	          '</div>'+
	          '<!-- Cantidad del producto -->'+
	          '<div class="col-xs-6">'+	            
	             '<input type="text" class="form-control passNueva" name="passNueva" placeholder="Password" value="" passNueva="0000" required>'+
	          '</div>'+
	          '<!-- contraseña del producto -->'+
	          '<div class="col-xs-6">'+	            
	             '<input type="text" class="form-control nuevaContrasena" name="nuevaContrasena" placeholder="N.Pantalla" value="" nuevaPass="0000" required>'+
	          '</div>'+
	          '<!-- fecha del producto -->'+
	          '<div class="col-xs-3">'+	            
	             '<input type="text" class="form-control nuevaFechaCorte" name="agregarFecha" value="'+fechaCorte+'" readonly required>'+
	          '</div>'+
	        '</div>');

	        // AGREGAR LOS PRODUCTOS AL SELECT 
	         respuesta.forEach(funcionForEach);
	         function funcionForEach(item, index){

	         	var datos = new FormData();
				datos.append("idCategoria", item.id_categoria);

				$.ajax({
					url:"ajax/streaming.ajax.php",
			      	method: "POST",
			      	data: datos,
			      	cache: false,
			      	contentType: false,
			      	processData: false,
			      	dataType:"json",
			      	success:function(respuesta){
			      		if(item.estado == 0 || item.pantallas == 0 || item.ocupada == 1 || item.modo_cuenta == 2 || item.desactivado == 1){
		         	
				        }else{
				        	$("#producto"+numProducto).append(
								'<option idProducto="'+item.id+'" value="'+item.correo+'">'+item.correo+' - '+respuesta["nombre"]+' - '+item.pantallas+' Pantallas</option>'
				         	)
				        }
			      	}
			    })

	         	
	        }
      	}
	})
})

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/
$(".formularioAsociar").on("change", "select.nuevaDescripcionProducto", function(){

	var nombreProducto = $(this).val();
	var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");
	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
	var nuevaCategoria = $(this).parent().parent().parent().children(".ingresoCategoria").children(".nuevaCategoria");
	console.log("nuevaCategoria", nuevaCategoria);

	var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);

	  $.ajax({
     	url:"ajax/cuentas.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      		$(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);
      		$(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
      	    $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
      	    $(nuevaCategoria).attr("categoriaNueva", respuesta["id_categoria"]);
			// AGRUPAR PRODUCTOS EN FORMATO JSON
			listarProductos()
      	}
    })
})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/
$(".formularioAsociar").on("change", "input.nuevaCantidadProducto", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	var precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal);
	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);
	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/
		$(this).val(0);
		$(this).attr("nuevoStock", $(this).attr("stock"));

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });
	    return;
	}

    // AGRUPAR PRODUCTOS EN FORMATO JSON
    listarProductos()

})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/
$(".formularioAsociar").on("change", "input.passNueva", function(){
	var passNueva = $(this).val();

	$(this).attr("passNueva", passNueva);

	// AGRUPAR PRODUCTOS EN FORMATO JSON
    listarProductos()
})

/*=============================================
MODIFICAR LA CONTRASEÑA
=============================================*/
$(".formularioAsociar").on("change", "input.nuevaContrasena", function(){
	var nuevaPass = $(this).val();

	$(this).attr("nuevaPass", nuevaPass);

	// AGRUPAR PRODUCTOS EN FORMATO JSON
    listarProductos()
})

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/
function listarProductos(){
	var listaProductos = [];
	var descripcion = $(".nuevaDescripcionProducto");
	var contrasena = $(".passNueva");	
	var cantidad = $(".nuevaCantidadProducto");
	var password = $(".nuevaContrasena");
	var corte = $(".nuevaFechaCorte");
	var categoria = $(".nuevaCategoria");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "categoria" : $(categoria[i]).val(),
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "Pass" : $(contrasena[i]).attr("passNueva"),
							  "password" : $(password[i]).attr("nuevaPass"),
							  "corte" : $(corte[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock")})
	}
	$("#listaProductos").val(JSON.stringify(listaProductos));
}

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/
//function quitarAgregarProducto(){
	//Capturamos todos los id de productos que fueron elegidos en la venta
	//var idProductos = $(".quitarProducto");
	//Capturamos todos los botones de agregar que aparecen en la tabla
	//var botonesTabla = $(".tablaCombo tbody button.agregarProducto");
	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	//for(var i = 0; i < idProductos.length; i++){
		//Capturamos los Id de los productos agregados a la venta
		//var boton = $(idProductos[i]).attr("idProducto");		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		//for(var j = 0; j < botonesTabla.length; j ++){
			//if($(botonesTabla[j]).attr("idProducto") == boton){
				//$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				//$(botonesTabla[j]).addClass("btn-default");
			//}
		//}
	//}	
//}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/
//$('.tablaCombo').on( 'draw.dt', function(){
	//quitarAgregarProducto();
//})

/*=============================================
BOTON EDITAR COMBO
=============================================*/
$(".tablas").on("click", ".btnEditarCombo", function(){
	var idCombo = $(this).attr("idCombo");
	window.location = "index.php?ruta=editar-combo&idCombo="+idCombo;
})

/*=============================================
BOTON RENOVAR COMBO
=============================================*/
$(".tablas").on("click", ".btnRenovarCombo", function(){
	var idCombo = $(this).attr("idCombo");
	window.location = "index.php?ruta=renovar-combo&idCombo="+idCombo;
})

/*=============================================
ELIMINAR COMBO
=============================================*/
$(".tablas").on("click", ".btnEliminarCombo", function(){
  var idCombo = $(this).attr("idCombo");

  swal({
    title: '¿Está seguro de borrar el combo?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar combo!'
  }).then(function(result){
    if(result.value){
      window.location = "index.php?ruta=combos&idCombo="+idCombo;
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
function ShowSelectedTelefonoC(){
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
	    	$("#nuevoTelefono").val(respuesta["telefono"]);
	    }
	});
}