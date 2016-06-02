<?php 
session_start();
require_once('header.php');
$id_curso = $_GET['id_curso'];
$id_tutorial = $_GET['id_tutorial'];

$correo = $_SESSION['email'];

$sql_idU = "select id_usuario from Usuario where correo = '$correo'";
$res_idU = mysqli_query($con, $sql_idU); 
$reg_idU = mysqli_fetch_array($res_idU);
$id_usuario = $reg_idU['0'];

$sql_curso = "select * from Curso where id_curso = $id_curso";
$res_curso = mysqli_query($con, $sql_curso);
$reg_curso = mysqli_fetch_array($res_curso);

$sql_tutorial = "select * from Tutorial where id_tutorial = $id_tutorial";
$res_tutorial = mysqli_query($con, $sql_tutorial);
$reg_tutorial = mysqli_fetch_array($res_tutorial);
$id_tutorial = $reg_tutorial['id_tutorial'];

$sql_usuario = "select * from Usuario where id_usuario = $id_usuario";
$res_usuario = mysqli_query($con, $sql_usuario);
$reg_usuario = mysqli_fetch_array($res_usuario);

$sql_test = "select * from Test where id_tutorial = $id_tutorial";
$res_test = mysqli_query($con, $sql_test);
$reg_test = mysqli_fetch_array($res_test);
$id_test = $reg_test['id_test'];

$sql_cal = "select * from Usuario_has_Test where id_test = $id_test and id_curso = $id_curso";
$res_cal = mysqli_query($con, $sql_cal);
$reg_cal = mysqli_fetch_array($res_cal);
$cal = $reg_cal['calificacion'];

?>

<div class="container">
	<div class="col-md-8 col-md-offset-2">
		<legend><h3><?php echo $reg_tutorial['nombre_tutorial']." - ". $reg_curso['nombre_curso']; ?></h3></legend> 
		<form action="calificar.php" method="post">
			<?php
				$sql_con = "select count(id_pregunta ) from Pregunta where id_test = $id_test";
				$res_con = mysqli_query($con, $sql_con);
				$reg_con = mysqli_fetch_array($res_con);
				$tam = $reg_con['0'];
				?>
				<input type="hidden" name="tam" value="<?php echo $tam; ?>"> 
				<input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>"> 
				<input type="hidden" name="id_test" value="<?php echo $id_test; ?>"> 
				<input type="hidden" name="id_curso" value="<?php echo $id_curso; ?>"> 
				<input type="hidden" name="id_tutorial" value="<?php echo $id_tutorial; ?>"> 
				<?php
				$sql_pregunta = "select * from Pregunta where id_test = $id_test";
				$res_pregunta = mysqli_query($con, $sql_pregunta);
				$value = 0;
				while($reg_pregunta = mysqli_fetch_array($res_pregunta)){
			?>
	           		<div class="form-group">
						<h4><?php echo $reg_pregunta['pregunta']; ?></h4> 
					</div>
					<?php
		           		$id_pregunta =  $reg_pregunta['id_pregunta'];
		           		$sql_respuesta = "select * from Respuesta where id_pregunta = $id_pregunta";
						$res_respuesta = mysqli_query($con, $sql_respuesta); 
							while($reg_respuesta = mysqli_fetch_array($res_respuesta)){
					?>
							<div class="form-group">
								<input type="radio" id="res" value="<?php echo $reg_respuesta['correcta']; ?>" name="<?php echo $value; ?>" > 
								<?php echo $reg_respuesta['respuesta']; ?>
								
							</div>
						<?php
						}
						?>
						
						<?php
							$value++;

						}
						?>
				<div class="form-group">
				<button class="btn btn-primary">Enviar</button>
 				</div>
			</div>
		</form>
	</div>
</div>

<?php
    require_once('footer.php');
?>