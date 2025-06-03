/*=============================================
ACTIVAR ANEXO
=============================================*/
$(".tablas").on("click", ".btnActivarAnexo", function(){

  var idAnexo = $(this).attr("idAnexo");
  var estadoAnexo = $(this).attr("estadoAnexo");

  var datos = new FormData();
    datos.append("activarId", idAnexo);
    datos.append("activarAnexo", estadoAnexo);

    $.ajax({
    url:"ajax/anexo.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
      success: function(respuesta){
        if(window.matchMedia("(max-width:767px)").matches){
             swal({
            title: "El anexo ha sido actualizado",
            type: "success",
            confirmButtonText: "¡Cerrar!"
          }).then(function(result) {
              if (result.value) {
                window.location = "anexos";
              }
          });
        }
      }
    })

    if(estadoAnexo == 0){
      $(this).removeClass('btn-success');
      $(this).addClass('btn-danger');
      $(this).html('Bloqueado');
      $(this).attr('estadoAnexo',1);
    }else{
      $(this).addClass('btn-success');
      $(this).removeClass('btn-danger');
      $(this).html('Activado');
      $(this).attr('estadoAnexo',0);
    }
})

/*=============================================
EDITAR ANEXO
=============================================*/
$(".tablas").on("click", ".btnEditarAnexo", function(){
  var idAnexo = $(this).attr("idAnexo");
  
  var datos = new FormData();
  datos.append("idAnexo", idAnexo);

  $.ajax({
    url:"ajax/anexo.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      $("#editarId").val(respuesta["id"]);
      $("#editartCuenta").val(respuesta["tipo_cuenta"]);
      if(respuesta["tipo_cuenta"] == 1){
        $("#editartCuenta").html("Completa");
      }else if(respuesta["tipo_cuenta"] == 2){
        $("#editartCuenta").html("Pantalla");
      }else{
        $("#editartCuenta").html("Combo");
      }
      
      $("#editarAnexo").val(respuesta["recordatorio"]);
    }
  });
})

/*=============================================
ELIMINAR ANEXO
=============================================*/
$(".tablas").on("click", ".btnEliminarAnexo", function(){
  var idAnexo = $(this).attr("idAnexo");

  swal({
    title: '¿Está seguro de borrar el anexo?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar Anexo!'
  }).then(function(result){
    if(result.value){
      window.location = "index.php?ruta=anexos&idAnexo="+idAnexo;
    }
  })
})