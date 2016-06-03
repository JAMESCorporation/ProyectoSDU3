<?php 
	require_once('header.php');
?>
	<div class="container">
	<?php 
		if($valorSesion == -1){
	?>
		<p>Por favor <button type="button" class="botn botn-primary botn-lg outline" data-toggle="modal" data-target="#myModal" > Inicia Sesión </button></p>
	<?php
		} else {
			$id_curso = $_GET['id_curso'];
			$sqlCursos = "SELECT * FROM Curso WHERE id_curso = '$id_curso'";
			$resCursos = mysqli_query($con, $sqlCursos) or die(mysqli_error($con));
			$regCursos = mysqli_fetch_array($resCursos);

	?>
	<div class="row">
		<div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
			<div class="thumbnail">
  	  			<img src="obtenerimagen.php?id=<?php echo $regCursos['id_curso']; ?>"/>
      			<div class="caption">
    			<h3>Confirmar compra del curso: <?php echo $regCursos['nombre_curso']; ?></h3>
    			<h4 class="text-primary">Costo: <?php echo "$".$regCursos['costo']." MX"; ?></h4>
    			<h4 class="text-primary">Tambien: <?php echo $regCursos['costoPuntos']; ?> <span class='glyphicon glyphicon-heart' style='color:red;'></span></h4>
    			<?php 
    				if(!$_POST){
    			?>
    			<div class="row">
    				<div class="col-lg-2">
    					<form action="comprar.php?id_curso=<?php echo $id_curso;?>" method="post">
		    				<input type="hidden" name="id_curso" value="<?php echo $regCursos['id_curso']; ?>">
		    				<input type="hidden" name="puntos" value="0">
		    				<button class="btn btn-success btn-large outline"><span class='glyphicon glyphicon-usd' style='color:green;'></span></button>
		    			</form>
    				</div>

    				<div class="col-lg-2">
    					<form action="comprar.php?id_curso=<?php echo $id_curso;?>" method="post">
		    				<input type="hidden" name="id_curso" value="<?php echo $regCursos['id_curso']; ?>">
		    				<input type="hidden" name="puntos" value="1">
		    				<?php
		    					$sql = "SELECT * FROM Usuario WHERE correo = '$correo'";
    							$res = mysqli_query($con,$sql) or die(mysqli_error($con));
    							$reg = mysqli_fetch_array($res);
		    					if($reg['puntos'] >= $regCursos['costoPuntos']){
		    				?>
		    				<button class="btn btn-danger btn-large outline"><span class='glyphicon glyphicon-heart' style='color:red;'></span></button>

		    				<?php 
		    					}
		    				 ?>
		    			</form>
    				</div>
    			</div>
				<?php
    				} else {
    					$id_curso = $_POST['id_curso'];
    					$puntos = $_POST['puntos'];

    					$sql = "SELECT * FROM Usuario WHERE correo = '$correo'";
    					$res = mysqli_query($con,$sql) or die(mysqli_error($con));
    					$reg = mysqli_fetch_array($res);
    					$sqlCursos = "SELECT * FROM Curso WHERE id_curso = '$id_curso'";
			$resCursos = mysqli_query($con, $sqlCursos) or die(mysqli_error($con));
			$regCursos = mysqli_fetch_array($resCursos);
    					if($puntos == 1){
    						$sqlPuntos = "UPDATE Usuario SET puntos = (puntos - ".$regCursos['costoPuntos']." ) WHERE id_usuario = '".$reg['id_usuario']."'";
      $resPuntos = mysqli_query($con, $sqlPuntos) or die("Hubo un error al insertar en Usuario.puntos".mysqli_error($con)); 
    					}			

    					$sql = "INSERT INTO Usuario_has_Curso VALUES ('".$reg['id_usuario']."', '$id_curso',0)";
    					$res = mysqli_query($con,$sql) or die(mysqli_error($con));

    					if($res){
    			?>
    						<div class="alert alert-success" role="alert">Compra realizada exitosamente!</div>
    			<?php
    					}else{
    			?>
							<div class="alert alert-danger" role="alert">Hubo un problema realizando la compra</div>
    			<?php
    				}
    			}
    			 ?>
			
			     
        			 	  
  	  			</div>
			</div>
	 	</div>
	</div>
		

	<?php
		}	
	?>
	</div>

<?php 
	require_once('footer.php');
?>