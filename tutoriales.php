<?php
session_start();
require_once('header.php');
require_once('includes/conexion.php');

if(!$_GET){
	echo "<br><br><br>No se han enviado datos sobre el tutorial"."<a href='index.php'>Regresar </a>";
}else{
	$curso = $_GET['id_curso'];
	$tutorial = $_GET['id_tutorial'];
	$sql = "SELECT * FROM Tutorial WHERE Tutorial.id_tutorial = '$tutorial' and Tutorial.id_curso = '$curso'";
	$res = mysql_query($sql,$con) or die("Error consultando: ".mysql_error());
	$reg = mysql_fetch_array($res) or die("Error al convertir los registros");

	$sql2 = "SELECT * FROM Curso WHERE id_curso = '$curso'";
	$res2 = mysql_query($sql2,$con) or die("Error consultando: ".mysql_error());
	$reg2 = mysql_fetch_array($res2) or die("Error al convertir los registros");


?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<title>JAMES Courses</title>
		<link rel="stylesheet" href="includes/bootstrap/dist/css/style.css">

	</head>

	<body>

		<div class="row">
			<div class="panel panel-default col-md-8 col-md-offset-1">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo "Curso ".$reg2['nombre_curso']." - ".$reg['nombre_tutorial'] ?></h3>
				</div>
				<div class="panel-body">
					<video controls>
						<source src="<?php echo 'cursos/'.$curso.'/'.$reg['numero'].'/'.$tutorial.'.mp4'; ?>" type="video/mp4">
						</video>

						<h3 class="text-danger">Descripción</h3>

						<?php echo $reg['descripcion_tutorial']; ?>
					</div>

				</div>

				<div class="panel panel-default col-md-3" id="panel-descargas">
					<div class="panel-heading">
						<h4 class="panel-title">Zona de descargas</h4>
					</div>
					<div class="panel-body">
					<!--<a href="<?php echo 'cursos/'.$curso.'/'.$reg['numero'].'/'.$tutorial.'.mp4'; ?>" class="btn btn-default btn-download" download="<?php echo $reg2['nombre_curso'].' - '.$reg['nombre_tutorial'].'.mp4'; ?>"> Descargar Video</a>-->
					<?php
						$directorio1 = opendir('cursos/'.$curso.'/'.$reg['numero'].'/'); //ruta actual
						$directorio ='cursos/'.$curso.'/'.$reg['numero'].'/';
						while ($archivo = readdir($directorio1)) //obtenemos un archivo y luego otro sucesivamente
						{
						    if (is_dir($archivo))//verificamos si es o no un directorio
						    {
						        //echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
						    }
						    else
						    {
						        echo "<a href='".$directorio.$archivo."' download='".$directorio.$archivo."' class='btn btn-default btn-download'> Descargar ".$archivo."</a>";
						    }
						}
					?>

					</div>
				</div>
			</div>


			<div class="row">
				<div class="panel panel-default col-md-8 col-md-offset-1">
					<h3>Comentarios</h3>
					<br>
					<?php
					if(isset($_SESSION['nombre'])){
						$correo = $_SESSION['nombre'];
	$sql_idU = "select id_usuario from Usuario where correo = '$correo'";
	$res_idU = mysql_query($sql_idU,$con);
	$reg_idU = mysql_fetch_array($res_idU);
	$id_usuario = $reg_idU['0'];
					 ?>
					<form action="comentarios.php" method="post" class="form-horizontal" role="form">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
							<input type="hidden" value="<?php echo $id_usuario; ?>" name="id_usuario"></input>
							<input type="hidden" value="<?php echo $tutorial; ?>" name="id_tutorial" ></input>
							<input type="hidden" value="<?php echo $curso; ?>" name="id_curso" ></input>
							<textarea class="form-control" name="comentario" rows="7" id="comment" placeholder="Escribe aquí tu comentario"></textarea>
						</div>
						<br>
						<div class="form-group margin-bottom-sm">
							<div class="col-sm-offset-10 col-sm-10">
								<button type="submit" class="btn btn-default">Enviar</button>
							</div>
						</div>
					</form>
					<?php
						}
					 ?>
				</div>
			</div>
				<?php

				$sql_comentario = "select * from Comentario, Tutorial where Comentario.id_tutorial = $tutorial and Tutorial.id_tutorial = $tutorial order by Comentario.fecha desc";
				$res_comentario = mysql_query($sql_comentario,$con);
				 ?>
			<div class="row">

				<?php
				if(mysql_num_rows($res_comentario) > 0){
				while($reg_comentario = mysql_fetch_array($res_comentario)){
					?>
					<div class="panel panel-default col-md-8 col-md-offset-2">
					<?php
					$id_u = $reg_comentario['id_usuario'];
					$id_c = $reg_comentario['id_comentario'];
					$sql_u = "select u.nombre_usuario from Usuario as u, Comentario as c where u.id_usuario = $id_u and c.id_usuario = $id_u and c.id_comentario = $id_c";
					$res_u = mysql_query($sql_u,$con) or die(mysql_error());
					$reg_u = mysql_fetch_array($res_u) or die(mysql_error());
					$nombre_usuario = $reg_u['0'];
					echo $nombre_usuario." (".$reg_comentario['fecha'].")- ".$reg_comentario['comentario'];
					?>
				</div>
				<?php
				}
			} else 
			?>
								<div class="panel panel-default col-md-8 col-md-offset-2"> 
								<?php echo "No hay comentarios"; ?> 
								</div>



			</div>


		</body>

		</html>
		<?php
	}
	?>
