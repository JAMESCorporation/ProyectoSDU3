
$('#agregar').click(function(){
	var divRecursos;
	var contador = 0;
	var elementos ="";
  contador++;
  elementos = "<input name='archivos["+contador+"]' type='file'  id='archivos' multiple>";
  console.log(elementos);
  $('#recursos').append(elementos);

});

$('#filtrar').click(function(){
	var buscar = $("#buscar").val();
	var filtro = $("#filtro").val();
	var categoria = $("#categoria").val();
	$('#cursos').html('<h2 class="text-center"><img src="includes/pictures/cargando.gif">  Cargando</h2>');

	$.ajax({
		type: 'POST',
		url: 'buscador.php',
		data: {"buscar":buscar,"filtro":filtro,"categoria":categoria},
		success: function(resp){
			if (resp!="") {
				 $("#cursos").html(resp);
			}
		}

	});
});