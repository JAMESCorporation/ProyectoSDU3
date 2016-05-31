<?php
	require_once("header.php");

	if($valorSesion == -1){
		//echo "No una sesión activa";
		$sqlCursos = "SELECT * FROM Curso";
		$resCursos = mysqli_query($con, $sqlCursos) or die(mysqli_connect_error());

	}else{
		//$sql_curso = "select * from Curso, Usuario where Usuario.id_usuario = Curso.id_usuario";
		//$res_curso = mysqli_query($con, $sql_curso) or die(mysqli_connect_error());
		//$res_cu = mysqli_query($con, $sql_curso) or die(mysqli_connect_error());
	}	
?>
	<div class="container" id="cursos">
		<div class="jumbotron">
			Bienvenido! Tenemos estos cursos para ti
		</div>
		<div class="row">	 

		  <?php
		  	while($regCursos = mysqli_fetch_array($resCursos)){
		  ?>
 			 <div class="col-md-3 col-lg-3">
 				<div class="thumbnail">
		      	  <img src="obtenerimagen.php?id=<?php echo $regCursos['id_curso']; ?>"/>
			      <div class="caption">
		        	<h3><?php echo $regCursos['nombre_curso']; ?></h3>
		        	<p><?php echo $regCursos['descripcion_curso']; ?></p>
		        	<p class="text-right"><a href="listaTutoriales.php?id_curso=<?php echo $regCursos['id_curso']; ?>" class="btn btn-primary" role="button">Ver</a>
		        	<a href="#" class="btn btn-success" role="button"><?php
		        	if($regCursos['costo'] == 0){
		        	 	echo "Gratis"; 
		        	}else{
		        		echo "$".$regCursos['costo'];
		        	}?>
		        	</a></p>
		      	  </div>
		    	</div>
		 	 </div>
			
		  <?php
		  	}
		  ?>
		  </div>	
	</div>

<?php	
	require_once("footer.php");
 ?>
