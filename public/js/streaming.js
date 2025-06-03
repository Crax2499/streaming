/*=============================================
EDITAR STREAMING
=============================================*/
$(".tablas").on("click", ".btnEditarStreaming", function(){
  var idCategoria = $(this).attr("idCategoria");
  
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
      $("#editarId").val(respuesta["id"]);
      $("#editarNombre").val(respuesta["nombre"]);
      $("#editarCantidad").val(respuesta["pantallas"]);
    }
  });
})

/*=============================================
ACTIVAR STREAMING
=============================================*/
$(".tablas").on("click", ".btnActivarCategoria", function(){

  var idCategoria = $(this).attr("idCategoria");
  var estadoCategoria = $(this).attr("estadoCategoria");

  var datos = new FormData();
    datos.append("activarId", idCategoria);
    datos.append("activarCategoria", estadoCategoria);

    $.ajax({
    url:"ajax/streaming.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
      success: function(respuesta){
        if(window.matchMedia("(max-width:767px)").matches){
             swal({
            title: "El streaming ha sido actualizado",
            type: "success",
            confirmButtonText: "¡Cerrar!"
          }).then(function(result) {
              if (result.value) {
                window.location = "categorias";
              }
          });
        }
      }
    })

    if(estadoCategoria == 0){
      $(this).removeClass('btn-success');
      $(this).addClass('btn-danger');
      $(this).html('Bloqueado');
      $(this).attr('estadoCategoria',1);
    }else{
      $(this).addClass('btn-success');
      $(this).removeClass('btn-danger');
      $(this).html('Activado');
      $(this).attr('estadoCategoria',0);
    }
})

/*=============================================
ELIMINAR STREAMING
=============================================*/
$(".tablas").on("click", ".btnEliminarStreaming", function(){
  var idCategoria = $(this).attr("idCategoria");

  swal({
    title: '¿Está seguro de borrar el streaming?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar usuario!'
  }).then(function(result){
    if(result.value){
      window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;
    }
  })
})