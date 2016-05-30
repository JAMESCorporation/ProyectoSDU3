<?php
	require_once("header.php");
	if($valorSesion == -1){
		//echo "No una sesión activa";
		$sqlCursos = "SELECT * FROM Curso";
	}else{
		//$sql_curso = "select * from Curso, Usuario where Usuario.id_usuario = Curso.id_usuario";
		//$res_curso = mysqli_query($con, $sql_curso) or die(mysqli_connect_error());
		//$res_cu = mysqli_query($con, $sql_curso) or die(mysqli_connect_error());
	}	
?>
	<div class="container">
		<div class="row">
		  <div class="col-xs-6 col-md-3">
		    <a href="#" class="thumbnail">
		      <img src="..." alt="...">
		    </a>
		  </div>
		</div>
	</div>

<?php	
	require_once("footer.php");
 ?>
