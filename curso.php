<?php

require_once("header.php");

$sql_curso = "select * from Curso, Usuario where Usuario.id_usuario = Curso.id_usuario";
$res_curso = mysqli_query($con, $sql_curso) or die(mysqli_connect_error());
$res_cu = mysqli_query($con, $sql_curso) or die(mysqli_connect_error());
?>


  <h2 class = "text-primary">Lista de cursos</h2>



				<table class="table table-hover">
					<tr>
						<th>
							#ID
						</th>
						<th>
							Nombre del Curso
						</th>
						<th>
							Asesor
						</th>
						<th>
							No. Tutoriales
						</th>
					</tr>

					  <?php while($reg_cu = mysqli_fetch_array($res_cu)){
						?>
					<tr onclick="javascript:document.location.href = 'listaTutoriales.php?id_curso=<?php echo $reg_cu['id_curso']; ?>'">
						<td >
							<?php echo $reg_cu['id_curso']; ?>
						</td>
						<td>
							<a href="listaTutoriales.php?id_curso=<?php echo $reg_cu['id_curso']; ?>"><?php echo $reg_cu['nombre_curso']; ?></a>
						</td>
						<td>
							<?php echo $reg_cu['nombre_usuario']; ?>
						</td>
						<td>

							<?php
								$sql_tu = "SELECT * FROM Tutorial WHERE id_curso = '".$reg_cu['id_curso']."'";
								$res_tu = mysqli_query($con, $sql_tu)or die(mysqli_connect_error());
							 	echo mysqli_num_rows($res_tu);
							  ?>
						</td>
					</tr>
					<?php }
					?>
				</table>

				<?php
				require_once("footer.php");
				 ?>
