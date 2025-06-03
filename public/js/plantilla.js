/*=============================================
DATOS PARA IMPRIMIR Y SACAR INFORMACIÓN
=============================================*/
$(function () {
	$("#example1").DataTable({
    "scrollX": true, "lengthChange": false, "autoWidth": false,
	  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
	}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});

/*=============================================
 //input Mask
=============================================*/
 //Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()

//Date picker
$('#datepicker').datepicker({
  autoclose: true
})

//Date picker
$('#datepicker1').datepicker({
  autoclose: true
})

//Date picker
$('#datepicker2').datepicker({
  autoclose: true
})

//Date picker
$('#datepickerE').datepicker({
  autoclose: true
})

//Date picker
$('#datepicker1E').datepicker({
  autoclose: true
})

//Date picker
$('#datepicker2E').datepicker({
  autoclose: true
})

//Date picker
$('#datepickerR').datepicker({
  autoclose: true
})

//Date picker
$('#datepicker1R').datepicker({
  autoclose: true
})

//Date picker
$('#datepicker2R').datepicker({
  autoclose: true
})

/*=============================================
SELECCIONADOR CON BUSCADOR
=============================================*/
//Initialize Select2 Elements
$('.select2').select2()


/*=============================================
EDITOR DE TEXTO
=============================================*/
$(function () {
  // Summernote
  $('#summernote').summernote()

  // CodeMirror
  CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
    mode: "htmlmixed",
    theme: "monokai"
  });
})

/*=============================================
EDITOR DE TEXTO
=============================================*/
$(function () {
  // Summernote
  $('#summernote1').summernote()

  // CodeMirror
  CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
    mode: "htmlmixed",
    theme: "monokai",
  });
})