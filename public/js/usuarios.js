/*=============================================
CARGAR LA TABLA DINÁMICA DE MEMBRESIAS
=============================================*/
var valorUsuario = $(perfilOculto).val();

$('.tablaUsuarios').DataTable( {
  "ajax": "ajax/datatable-usuarios.ajax.php?perfilOculto="+valorUsuario,
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
QUITAR ESPACIOS
=============================================*/
$("#_texto").keyup(function(){
  let string = $("#_texto").val();
  $("#_texto").val(string.replace(/ /g, ""))
})

$("#_textoPin").keyup(function(){
  let string = $("#_textoPin").val();
  $("#_textoPin").val(string.replace(/ /g, ""))
})

$("#_textoPass").keyup(function(){
  let string = $("#_textoPass").val();
  $("#_textoPass").val(string.replace(/ /g, ""))
})

/*=============================================
SUBIENDO LA FOTO DEL USUARIO
=============================================*/
$(".nuevaFoto").change(function(){
	var imagen = this.files[0];
	
	/*=============================================
  VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  =============================================*/
  if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
    $(".nuevaFoto").val("");
     swal({
        title: "Error al subir la imagen",
        text: "¡La imagen debe estar en formato JPG o PNG!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });
  }else if(imagen["size"] > 5000000){
    $(".nuevaFoto").val("");
     swal({
        title: "Error al subir la imagen",
        text: "¡La imagen no debe pesar más de 5MB!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });
  }else{
    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event){
      var rutaImagen = event.target.result;
      $(".previsualizar").attr("src", rutaImagen);
      $(".previsualizarEditar").attr("src", rutaImagen);
    })
  }
})

/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
=============================================*/
$("#nuevoUsuario").change(function(){
  $(".alert").remove();

  var usuario = $(this).val();
  var datos = new FormData();
  datos.append("validarUsuario", usuario);

   $.ajax({
      url:"ajax/usuarios.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){        
        if(respuesta){
          $("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');
          $("#nuevoUsuario").val("");
        }
      }
  })
})

/*=============================================
EDITAR USUARIO
=============================================*/
$(".tablaUsuarios").on("click", ".btnEditarUsuario", function(){
  var idUsuario = $(this).attr("idUsuario");  
  var datos = new FormData();
  datos.append("idUsuario", idUsuario);

  $.ajax({
    url:"ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      $("#editarId").val(respuesta["id"]);
      $("#editarNombre").val(respuesta["nombre"]);
      $("#editarUsuario").val(respuesta["usuario"]);
      $("#editarCarpeta").val(respuesta["carpeta"]);
      $("#editarPerfil").html(respuesta["perfil"]);
      $("#editarPerfil").val(respuesta["perfil"]);
      $("#editarTelefono").val(respuesta["telefono"]);
      $("#editarEmail").val(respuesta["email"]);
      $("#fotoActual").val(respuesta["foto"]);
      $("#passwordActual").val(respuesta["password"]);
      if(respuesta["foto"] != ""){
        $(".previsualizarEditar").attr("src", respuesta["foto"]);
      }else{
        $(".previsualizarEditar").attr("src", "public/img/usuarios/default/anonymous.png");
      }
    }
  });
})

/*=============================================
EDITAR USUARIO
=============================================*/
$(".tablaUsuarios").on("click", ".btnEditarUsuarioR", function(){
  var idUsuario = $(this).attr("idUsuario");  
  var datos = new FormData();
  datos.append("idUsuario", idUsuario);

  $.ajax({
    url:"ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      $("#editarIdR").val(respuesta["id"]);
      $("#editarNombreR").val(respuesta["nombre"]);
      $("#editarUsuarioR").val(respuesta["usuario"]);
      $("#editarCarpetaR").val(respuesta["carpeta"]);
      $("#editarPerfilR").html(respuesta["perfil"]);
      $("#editarPerfilR").val(respuesta["perfil"]);
      $("#editarTelefonoR").val(respuesta["telefono"]);
      $("#editarEmailR").val(respuesta["email"]);
      $("#fotoActualR").val(respuesta["foto"]);
      $("#passwordActualR").val(respuesta["password"]);
      if(respuesta["foto"] != ""){
        $(".previsualizarEditar").attr("src", respuesta["foto"]);
      }else{
        $(".previsualizarEditar").attr("src", "public/img/usuarios/default/anonymous.png");
      }
    }
  });
})

/*=============================================
ACTIVAR USUARIO
=============================================*/
$(".tablaUsuarios").on("click", ".btnActivar", function(){

  var idUsuario = $(this).attr("idUsuario");
  var estadoUsuario = $(this).attr("estadoUsuario");

  var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({
    url:"ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){
        if(window.matchMedia("(max-width:767px)").matches){
             swal({
            title: "El usuario ha sido actualizado",
            type: "success",
            confirmButtonText: "¡Cerrar!"
          }).then(function(result) {
              if (result.value) {
                window.location = "usuarios";
              }
          });
        }
      }
    })

    if(estadoUsuario == 0){
      $(this).removeClass('btn-success');
      $(this).addClass('btn-danger');
      $(this).html('Bloqueado');
      $(this).attr('estadoUsuario',1);
    }else{
      $(this).addClass('btn-success');
      $(this).removeClass('btn-danger');
      $(this).html('Activado');
      $(this).attr('estadoUsuario',0);
    }
})

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablaUsuarios").on("click", ".btnEliminarUsuario", function(){
  var idUsuario = $(this).attr("idUsuario");
  var fotoUsuario = $(this).attr("fotoUsuario");
  var usuario = $(this).attr("usuario");

  swal({
    title: '¿Está seguro de borrar el usuario?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar usuario!'
  }).then(function(result){
    if(result.value){
      window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
    }
  })
})