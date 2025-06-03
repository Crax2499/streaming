/*=============================================
ACTIVAR CUENTA
=============================================*/
$(".tablas").on("click", ".btnActivarC", function(){

  var idCuenta = $(this).attr("idCuenta");
  var estadoCuenta = $(this).attr("estadoCuenta");
  console.log("estadoCuenta", estadoCuenta);

  var datos = new FormData();
    datos.append("activarCuentaD", idCuenta);
    datos.append("desactivarCuenta", estadoCuenta);

    $.ajax({
      url:"ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){
        swal({
            title: "La cuenta ha sido activada",
            type: "success",
            confirmButtonText: "¡Cerrar!"
        }).then(function(result) {
              if (result.value) {
                window.location = "cuentas-desactivadas";
              }
        });
      }
    })
})