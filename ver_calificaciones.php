<?php
session_start();
require_once('header.php');
$id_tutorial = $_GET['id_tutorial'];
$sql = "select tu.id_tutorial, u.nombre, has.calificacion, has.fecha from Tutorial as tu, Usuario as u, Test as te, Usuario_has_Test as has where tu.id_tutorial = te.id_tutorial and te.id_test = has.id_test and u.id_usuario = has.id_usuario and tu.id_tutorial = $id_tutorial and te.id_tutorial = $id_tutorial order by has.fecha desc";
$res = mysqli_query($con, $sql);
?>
<div class="container">
  <table class="table table-hover">
    <tr>
      <th>
        Usuario
      </th>
      <th>
		Calificación      
	  </th>
      <th>
        Fecha de elaboración
      </th>
    </tr>

    <?php while($reg = mysqli_fetch_array($res)){
        ?>
      <tr>
        <td>
          	<label>
          	   <?php echo $reg['nombre']; ?>
          	</label>
        </td>
        <td>
            <label>
              <?php echo $reg['calificacion']; ?>
            </label>
          
        </td>
        <td>
          <?php echo $reg['fecha']; ?>
        </td>
      </tr>
      <?php }
      ?>
  </table>
</div>
