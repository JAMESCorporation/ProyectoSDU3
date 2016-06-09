<?php
require_once('header.php');
if(!$_GET){
	echo "<br><br><br>No se han enviado datos sobre el tutorial"."<a href='index.php'>Regresar </a>";
}else{
	$curso = $_GET['id_curso'];
	$tutorial = $_GET['id_tutorial'];
	$sql = "SELECT * FROM Tutorial WHERE Tutorial.id_tutorial = '$tutorial' and Tutorial.id_curso = '$curso'";
	$res = mysqli_query($con, $sql) or die("Error consultando: ".mysqli_connect_error());
	$reg = mysqli_fetch_array($res) or die("Error al convertir los registros");

  $visitas = $reg['visitas'];
  $likes = $reg['megusta'];

  $sql_visitas = "update Tutorial set visitas = $visitas+1 where id_tutorial = $tutorial"; 
  $res_visitas = mysqli_query($con, $sql_visitas);

	$sql2 = "SELECT * FROM Curso WHERE id_curso = '$curso'";
	$res2 = mysqli_query($con, $sql2) or die("Error consultando: ".mysqli_connect_error());
	$reg2 = mysqli_fetch_array($res2) or die("Error al convertir los registros");
  $sql_hayTest = "Select * from Test where id_tutorial = $tutorial";
  $res_hayTest = mysqli_query($con, $sql_hayTest);
?>

    <div class="row">
      <div class="panel panel-default col-md-8 col-md-offset-2">
        <div class="panel-heading">
          <h3 class="panel-title"><?php echo "Curso ".$reg2['nombre_curso']." - ".$reg['nombre_tutorial'] ?></h3>
        </div>
        <div class="panel-body">
          <video controls>
            <source src="obtenervideo.php?id=<?php echo $reg['id_tutorial']; ?>" >
          </video>
          <?php
          if(isset($_SESSION['email'])){
            $correo = $_SESSION['email'];

            $sql_idU = "select id_usuario from Usuario where correo = '$correo'";
            $res_idU = mysqli_query($con, $sql_idU);
            $reg_idU = mysqli_fetch_array($res_idU);
            $id_usuario = $reg_idU['0'];

            $sql_estado = "SELECT estado from Usuario_has_Curso where id_usuario=$id_usuario and id_curso=$curso";
            $res_estado = mysqli_query($con, $sql_estado);
            $reg_estado = mysqli_fetch_array($res_estado);
            $estado = $reg_estado['0'];
          }
           ?>
          <h3 class="text-danger">Descripción</h3>
          <div class="text-left">
          <?php 
             if(isset($_SESSION['email'])){
          ?>
            <!--<img src="includes/pictures/like.png" width="25" height="25">-->
            <a href='obtenervideo.php?id_tutorial=<?php echo $tutorial; ?>' download='<?php echo $reg['nombre_tutorial']." - Curso ".$reg2['nombre_curso'] ?>' class='btn btn-default btn-download'> Descargar </a>
            <?php 
       
              if ($estado == 1) {

                if(mysqli_num_rows($res_hayTest) > 0){
                  ?>
            <a href='ver_calificaciones.php?id_tutorial=<?php echo $tutorial; ?>' class='btn btn-default btn-download'> Ver calificaciones </a>
              <?php
                } else {
              ?>
            <a href='test.php?id_tutorial=<?php echo $reg['id_tutorial']; ?>&id_curso=<?php echo $curso; ?>' class='btn btn-default btn-download'> Crear cuestionario </a>
            <?php 
                 }
          } else {
              $sql_hayUsuario = "Select * from Usuario_has_Test where id_usuario = $id_usuario";
              $res_hayUsuario = mysqli_query($con, $sql_hayUsuario);
              if(mysqli_num_rows($res_hayUsuario) > 0){
                $reg_hayTest = mysqli_fetch_array($res_hayTest);
                $id_test = $reg_hayTest['id_test'];

                $sql_cal = "Select * from Usuario_has_Test where id_test = $id_test and id_usuario = $id_usuario";
                $res_cal = mysqli_query($con, $sql_cal);
                $reg_cal = mysqli_fetch_array($res_cal);
                ?>
                <label class="text-primary">Ya has realizado la evaluación. Calificación: <?php echo $reg_cal['calificacion'];?></label>
              <?php
              } else {

            ?>
              <a href='cuestionario.php?id_tutorial=<?php echo $reg['id_tutorial']; ?>&id_curso=<?php echo $curso; ?>' class='btn btn-default btn-download'> Realizar cuestionario </a>
            <?php 
                }
             }
           }
            ?>
          </div>
          <div class="text-right">
            <?php echo $visitas." visitas";?>
          </div>
          <?php echo $reg['descripcion_tutorial']; ?>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="panel panel-default col-md-8 col-md-offset-2">
        <h3>Comentarios</h3>
        <br>
        <?php
					if(isset($_SESSION['email'])){
						$correo = $_SESSION['email'];
						$sql_idU = "select id_usuario from Usuario where correo = '$correo'";
						$res_idU = mysqli_query($con, $sql_idU);
						$reg_idU = mysqli_fetch_array($res_idU);
						$id_usuario = $reg_idU['0'];
					 ?>
          <form action="comentarios.php" method="post" class="form-horizontal" role="form">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
              <input type="hidden" value="<?php echo $id_usuario; ?>" name="id_usuario"></input>
              <input type="hidden" value="<?php echo $tutorial; ?>" name="id_tutorial"></input>
              <input type="hidden" value="<?php echo $curso; ?>" name="id_curso"></input>
              <textarea class="form-control" name="comentario" rows="7" id="comment" placeholder="Escribe aquí tu comentario"></textarea>
            </div>
            <br>
            <div class="form-group margin-bottom-sm">
              <div class="col-sm-offset-10 col-sm-10">
                <button type="submit" class="btn btn-default">Comentar</button>
              </div>
            </div>
          </form>
          <?php
						}
					 ?>
      </div>
    </div>
    <?php

				$sql_comentario = "select id_comentario, comentario, id_usuario, fecha from Comentario, Tutorial where Comentario.id_tutorial = $tutorial and Tutorial.id_tutorial = $tutorial order by Comentario.fecha desc";
				$res_comentario = mysqli_query($con, $sql_comentario);
				 ?>
      <div class="row">
          <div class="panel panel-default col-md-8 col-md-offset-2">

        <?php
				if(mysqli_num_rows($res_comentario) > 0){

				while($reg_comentario = mysqli_fetch_array($res_comentario)){
					?>
            <?php
					$id_u = $reg_comentario['id_usuario'];
					$id_c = $reg_comentario['id_comentario'];
					$sql_u = "select u.nombre from Usuario as u, Comentario as c where u.id_usuario = $id_u and c.id_usuario = $id_u and c.id_comentario = $id_c";
					$res_u = mysqli_query($con, $sql_u) or die(mysqli_connect_error());
					$reg_u = mysqli_fetch_array($res_u) or die(mysqli_connect_error());
					$nombre_usuario = $reg_u['0'];
          ?>
          <legend>
          <?php echo $reg_comentario['comentario']; ?>
            <div class="text-right"> 
              <h4><?php echo $nombre_usuario." - (".$reg_comentario['fecha'].")"; ?> </h4>
            </div>

            <input type="button" id="mostrar" name="boton1" value="Ver respuestas">
            <input type="button" id="ocultar" name="boton2" value="Click pora ocultar elementos">
            <!-- Aqui van las respuestas -->
            <div class="row" id="respuestas">
              <div class="col-md-11 col-md-offset-1">
                <form action="respuesta_comentario.php" method="post" class="form-horizontal" role="form">
                <?php 
                $sql_respuesta = "SELECT * from Respuesta_comentario where id_comentario = $id_c";
                $res_respuesta = mysqli_query($con, $sql_respuesta);
                if(mysqli_num_rows($res_respuesta) > 0){
                  while ($reg_respuesta = mysqli_fetch_array($res_respuesta)){
                ?>
                <legend>
                  <h5>
                  <?php
                    echo $reg_respuesta['respuesta_comentario'];
                    $id_r = $reg_respuesta['id_respuesta_comentario'];
                    $sql_user = "select u.nombre, r.fecha from Usuario as u, Respuesta_comentario as r where r.id_respuesta_comentario = $id_r and r.id_usuario = u.id_usuario";
                    $res_user = mysqli_query($con, $sql_user);
                    $reg_user = mysqli_fetch_array($res_user);
                    ?>
                    <div align="right">
                    <?php echo $reg_user['nombre']." - (".$reg_user['fecha'].")"; ?>
                    </div>
                  </h5>
                </legend>
                <?php
                  }
                } else {
                  echo "Aún no hay respuestas";
                }
                ?>
                  <div align="right">
                    <textarea class="form-control" name="respuesta" rows="1" id="respuesta" placeholder="Escribe aquí tu respuesta"></textarea>
                    <input type="hidden" value="<?php echo $id_usuario; ?>" name="id_usuario"></input>
                    <input type="hidden" value="<?php echo $id_c; ?>" name="id_comentario"></input>
                    <input type="hidden" value="<?php echo $tutorial; ?>" name="id_tutorial"></input>
                    <input type="hidden" value="<?php echo $curso; ?>" name="id_curso"></input>
                    <button type="submit" class="btn btn-default">Responder</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- Aqui termina -->
          </legend>

          

          <?php
				}
			} else { ?>
            </div>
            <div class="panel panel-default col-md-8 col-md-offset-2">
              <?php echo "No hay comentarios"; ?>
            </div>
            <?php
			}
				 ?>
      </div>

  <?php
		require_once('footer.php');
	}
	?>
