
$('#agregar').click(function(){
	var divRecursos;
	var contador = 0;
	var elementos ="";
  contador++;
  elementos = "<input name='archivos["+contador+"]' type='file'  id='archivos' multiple>";
  console.log(elementos);
  $('#recursos').append(elementos);

});

