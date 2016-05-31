<?php
	require_once('header.php');

	$i = 0;
	$id_tuto = 1;
	$sql_test = "INSERT INTO Test VALUES (null,$id_tuto)";
	$res_test = mysqli_query($con, $sql_test) or die (mysqli_connect_error());
	$sql_id_test = "select id_test from Test order by id_test desc limit 1";
	$res_id_test = mysqli_query($con, $sql_id_test) or die(mysqli_connect_error());
	$reg_id_test = mysqli_fetch_array($res_id_test);
	$id_test = $reg_id_test['0'];
?>
		
	

	<div class="container">
	   <div class="col-md-8 col-md-offset-2">
		<legend><h2>Comienza aquí tu cuestionario</h2></legend>
		<legend><p>Escriba las preguntas y respuestas seleccionando la respuesta correcta</p></legend>
		<form>
			<div class="form-group">
				<label></label>
			</div>

            <div class="form-group">
				<label>Pregunta</label> 
				<input class="form-control" type="text" name="pregunta" id="pregunta" placeholder="Ingresa la pregunta">
			</div>
			<div class="form-group">
				<input type="radio" name="res" value="res1" required="required">
				<label> 1a Respuesta </label> 
				<input class="form-control" type="text" name="res1" id="res1" placeholder="Ingresa respuesta 1">
			</div>
			<div class="form-group">
				<input type="radio" name="res" value="res2" required="required">
				<label> 2a Respuesta </label>
				<input class="form-control" type="text" name="res2" id="res2" placeholder="Ingresa respuesta 2">
			</div>
			<div class="form-group">
				<input type="radio" name="res" value="res3" required="required">
				<label> 3a Respuesta </label>
				<input class="form-control" type="text" name="res3" id="res3" placeholder="Ingresa respuesta 3">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" id="agregar">Agregar pregunta</button>
			</div>
		</form>
	   </div>
	</div>

<?php
    require_once('footer.php');
?>
