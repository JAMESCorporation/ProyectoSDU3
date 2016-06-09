<?php
require_once('header.php');
 ?>
   <div class="jumbotron" >
      <div class="container" >
        <h1 class="text-primary">Bienvenido al portal de James Courses!</h1>
        <p>Podrás encontrar cursos de tu preferencia, temas que en algún momento podrán despertar el interes en ti, cada uno de los cursos esta diseñado y implementado para poder analizar y entenderlo de manera correcta. Visitala y no olvides dejarnos un comentario.</p>
 	      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
      <?php 
      	$sqlVisitados = "SELECT id_curso,id_tutorial,nombre_tutorial,descripcion_tutorial FROM Tutorial order by visitas desc limit 6";
      	$resVisitados = mysqli_query($con, $sqlVisitados) or die(mysqli_error($con));
      	while($regVisitados = mysqli_fetch_array($resVisitados)){
       ?>
        <div class="col-lg-4">
          <h2><?php echo $regVisitados['nombre_tutorial']; ?></h2>
          
          <div class="thumbnail">
          	<img src="obtenerimagen.php?id=<?php echo $regVisitados['id_curso']; ?>"/>
          </div>
          <p><?php echo $regVisitados['descripcion_tutorial']; ?></p>
			<?php
				if($valorSesion == -1){
			?>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" > Inicia Sesión </button></div>
			<?php
				} else {
          	?>
          <p><a class="btn btn-success" href="tutoriales.php?<?php echo 'id_tutorial='.$regVisitados['id_tutorial']."&&id_curso=".$regVisitados['id_curso']; ?>" role="button">Ver video &raquo;</a></p>
        </div>

        <?php
        	}
        }
        ?>
      </div>
    </div>

<?php
	require_once("footer.php");
 ?>
