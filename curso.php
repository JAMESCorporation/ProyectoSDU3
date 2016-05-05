<?php

require_once("header.php");

$sql_curso = "select * from Curso, Usuario where Usuario.id_usuario = Curso.id_usuario";
$res_curso = mysql_query($sql_curso, $con) or die(mysql_error());
$res_cu = mysql_query($sql_curso, $con) or die(mysql_error());
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

					  <?php while($reg_cu = mysql_fetch_array($res_cu)){
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
								$res_tu = mysql_query($sql_tu,$con)or die(mysql_error());
							 	echo mysql_num_rows($res_tu);
							  ?>
						</td>
					</tr>
					<?php }
					?>
				</table>

				<?php
				require_once("footer.php");
				 ?>
