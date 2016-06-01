<?php
	require_once("header.php");
	$sqlCursos = "SELECT * FROM Curso";
	$resCursos = mysqli_query($con, $sqlCursos) or die(mysqli_error($con));
?>
	<div class="container" id="cursosC">
		<div class="jumbotron">
			Bienvenido! Tenemos estos cursos para ti
		</div>
		<?php
			if($valorSesion == 1){
		?>
		<div class="row col-lg-offset-2" id="">
			
			<div class="col-lg-3 ">
				<input type="search" name="buscar" placeholder="Buscar curso" class="form-control">
			</div>
			<div class="col-lg-3 ">
				<select name="filtro" class="form-control">
					<option value="1">Todos</option>
					<option value="2">Mis Cursos</option>
					<option value="3">Cursando</option>
					<option value="3">Recientes</option>
				</select>
			</div>

			<div class="col-lg-3 ">
				<select name="categoria" class="form-control">
				<?php
					$sqlCat = "SELECT * FROM Categoria";
					$resCat = mysqli_query($con,$sqlCat) or die(mysql_error($con));
					while($regCat = mysqli_fetch_array($resCat)){
				?>
					<option value="<?php echo $regCat['id_categoria']; ?>"><?php echo $regCat['nombre_categoria']; ?></option>
				<?php
					}
				?>					
				</select>
			</div>

			<button class="btn btn-primary">Filtrar</button>
			
		</div>
				
		<?php
			}
		?>
		<div class="row" id="cursos">	 

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
