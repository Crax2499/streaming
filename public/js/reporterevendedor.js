/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/
if(localStorage.getItem("capturarRango4") != null){
  $("#daterange-btn4 span").html(localStorage.getItem("capturarRango4"));
}else{
  $("#daterange-btn4 span").html(' Rango de fecha')
}

/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn4').click(function(){
  $(".daterangepicker.opensleft").addClass("openReporteRevendedor");
});

$('#daterange-btn4').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn4 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');
    var capturarRango = $("#daterange-btn4 span").html();   
    localStorage.setItem("capturarRango4", capturarRango);
    window.location = "index.php?ruta=reporte-revendedor&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  }
)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/
$(document).on("click",".openReporteRevendedor .range_inputs .cancelBtn", function(){
  localStorage.removeItem("capturarRango4");
  localStorage.clear();
  window.location = "reporte-revendedor";
})

/*=============================================
CAPTURAR HOY
=============================================*/
$(document).on("click",".openReporteRevendedor .ranges li", function(){
  var textoHoy = $(this).attr("data-range-key");
  if(textoHoy == "Hoy"){
    var d = new Date();
    
    var dia = d.getDate();
    var mes = d.getMonth()+1;
    var año = d.getFullYear();

    if(mes < 10 && dia < 10){
      var fechaInicial = año+"-0"+mes+"-0"+dia;
      var fechaFinal = año+"-0"+mes+"-0"+dia;
    }else if(dia < 10){
      var fechaInicial = año+"-"+mes+"-0"+dia;
      var fechaFinal = año+"-"+mes+"-0"+dia;
    }else if(mes < 10){
      var fechaInicial = año+"-0"+mes+"-"+dia;
      var fechaFinal = año+"-0"+mes+"-"+dia; 
    }else{
      var fechaInicial = año+"-"+mes+"-"+dia;
      var fechaFinal = año+"-"+mes+"-"+dia;
    }
      localStorage.setItem("capturarRango4", "Hoy");
      window.location = "index.php?ruta=reporte-revendedor&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  }
})