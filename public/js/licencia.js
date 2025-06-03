/*=============================================
EDITAR LICENCIA
=============================================*/
$(".tablas").on("click", ".btnEditarLicencia", function(){
  var idLicencia = $(this).attr("idLicencia");  
  var datos = new FormData();
  datos.append("idLicencia", idLicencia);

  $.ajax({
    url:"ajax/licencia.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta){
      $("#editarId").val(respuesta["id"]);
      $(".editarFecha").val(respuesta["fecha"]);
      $limitado = "Limitado";
      $ilimitado = "Ilimitado";
      if(respuesta["ilimitado"] == 0){
        $("#editarIlimitado").val(respuesta["ilimitado"]);
        $("#editarIlimitado").html($limitado);
      }else{
        $("#editarIlimitado").val(respuesta["ilimitado"]);
        $("#editarIlimitado").html($ilimitado);
      }
    }
  });
})