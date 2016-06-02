<?php
	require_once('header.php');
	$i = 0;
	$id_tuto = $_GET['id_tutorial'];
	$id_curso = $_GET['id_curso'];
	$sql_test = "INSERT INTO Test VALUES (null,$id_tuto)";
	$res_test = mysqli_query($con, $sql_test) or die (mysqli_error($con));
	$sql_id_test = "select id_test from Test order by id_test desc limit 1";
	$res_id_test = mysqli_query($con, $sql_id_test) or die(mysqli_error($con));
	$reg_id_test = mysqli_fetch_array($res_id_test);
	$id_test = $reg_id_test['0'];
?>
 	

	<div class="container">
	   <div class="col-md-8 col-md-offset-2">
		<legend><h2>Comienza aquí tu cuestionario</h2></legend>
		<legend><p>Escriba las preguntas y respuestas seleccionando la respuesta correcta</p></legend>
			<div id="mostrar" class="form-group">
			</div>
            <div class="form-group">
				<label>Pregunta</label> 
				<input class="form-control" type="text" name="pregunta" id="pregunta" placeholder="Ingresa la pregunta">
			</div>
			<div class="form-group">
				<div class="radio">
				<input type="radio" name="res" value="res1" required="required" id="r1" checked="enable">
				<label for="r1"> 1a Respuesta </label> 
				</div>
				<input class="form-control" type="text" name="res1" id="res1" placeholder="Ingresa respuesta 1">
			</div>
			<div class="form-group">
							<div class="radio">

				<input type="radio" name="res" value="res2" required="required" id="r2">
				<label for="r2"> 2a Respuesta </label></div>
				<input class="form-control" type="text" name="res2" id="res2" placeholder="Ingresa respuesta 2">
			</div>
			<div class="form-group">
							<div class="radio">

				<input type="radio" name="res" value="res3" required="required" id="r3">
				<label for="r3"> 3a Respuesta </label></div>
				<input class="form-control" type="text" name="res3" id="res3" placeholder="Ingresa respuesta 3">
				<input type="hidden" id="id_test" value="<?php echo $id_test; ?>">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" id="agregar">Agregar pregunta</button>
				<div align="right"> <a href='tutoriales.php?id_curso=<?php echo $id_curso; ?>&id_tutorial=<?php echo $id_tuto; ?>' class='btn btn-default btn-download'> Finalizar </a>
 				</div>
			</div>
	   </div>
	</div>

<?php
    require_once('footer.php');
?>