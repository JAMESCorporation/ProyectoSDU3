<?php
session_start();
	require_once('includes/conexion.php');
	  if(!isset($_SESSION['email'])){
    $valorSesion = -1;
  } else {
    $valorSesion = 1;
    $correo = $_SESSION['email'];
  }
	$busqueda = $_POST['buscar'];
	$filtro = $_POST['filtro'];
	$categoria = $_POST['categoria'];
	
	$sqlUser = "SELECT id_usuario FROM Usuario WHERE correo = '".$_SESSION['email']."'";
    $resUser = mysqli_query($con, $sqlUser);
    $regUser = mysqli_fetch_array($resUser);

    $id_usuario = $regUser['id_usuario'];

    if($filtro == 1 && $categoria == 0 && $busqueda == ''){
    	$sql = "SELECT * FROM Curso";
    }else{
    	$sql = "SELECT distinct Curso.id_curso,Curso.nombre_curso, Curso.descripcion_curso, Curso.costo FROM Curso, Usuario_has_Curso, Curso_has_Categoria WHERE ";
    	if($filtro == 1){
			$filtroValor = "";
		}
		if ($filtro == 2) {
			$filtroValor = "Usuario_has_Curso.estado = 1 and Usuario_has_Curso.id_usuario = '$id_usuario'";
		}

		if ($filtro == 3) {
			$filtroValor = "Usuario_has_Curso.estado = 0 and Usuario_has_Curso.id_usuario = '$id_usuario'";
		}

		$sql = $sql.$filtroValor;

		if($categoria != 0){
			if($filtro == 1){
				$sql = $sql." Curso_has_Categoria.id_categoria = '$categoria' ";
			}else{
				$sql = $sql." and Curso_has_Categoria.id_categoria = '$categoria' ";
			}
								
		}
		if($busqueda != ''){
			if($filtro == 1 && $categoria == 0){
				$sql = $sql." Curso.nombre_curso LIKE '%".$busqueda."%'";
			}else{
				$sql = $sql." and Curso.nombre_curso LIKE '%".$busqueda."%' ";
			}
			
		}

		$sql = $sql." and Curso.id_curso = Usuario_has_Curso.id_curso and Curso_has_Categoria.id_curso = Curso.id_curso";
    }
	
	//echo $sql;
	$resCursos = mysqli_query($con, $sql) or die("Error obteniendo cursos".mysqli_error($con));


		  	while($regCursos = mysqli_fetch_array($resCursos)){
		  ?>
			 <div class="col-md-3 col-lg-3">
 				<div class="thumbnail curso">
		      	  <img src="obtenerimagen.php?id=<?php echo $regCursos['id_curso']; ?>"/>
			      <div class="caption">
		        	<h3><?php echo $regCursos['nombre_curso']; ?></h3>
		        	<p><?php echo $regCursos['descripcion_curso']; ?></p>
		        	<p class="text-right"><a href="listaTutoriales.php?id_curso=<?php echo $regCursos['id_curso']; ?>" class="btn btn-primary" role="button">Ver</a>
					<?php
						if($valorSesion == -1){
					?>
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" > Inicia Sesión </button>
					<?php
						} else {
							$sql = "SELECT * FROM Usuario WHERE correo = '$correo'";
    						$res = mysqli_query($con,$sql) or die(mysqli_error($con));
    						$reg = mysqli_fetch_array($res);
							$sqlEstado = "SELECT estado FROM Usuario_has_Curso WHERE id_usuario = '".$reg['id_usuario']."' and id_curso = '".$regCursos['id_curso']."'";
							$resEstado = mysqli_query($con,$sqlEstado) or die(mysql_error($con));
							$regEstado = mysqli_fetch_array($resEstado);
							if(mysqli_num_rows($resEstado) == 0) {
					?>

			        	<a href="comprar.php?id_curso=<?php echo $regCursos['id_curso']; ?>" class="btn btn-success" role="button"><?php
			        	if($regCursos['costo'] == 0){
			        	 	echo "Gratis"; 
			        	}else{
			        		echo "$".$regCursos['costo'];
			        	}?>
			        	</a>
			        <?php
			        		}
			        	}
					?>
		        	</p>
		      	  
		      	  </div>
		    	</div>
		 	 </div>
			
		  <?php
		  	}
		
?>