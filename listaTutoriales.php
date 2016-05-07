<?php
require_once('header.php');
$id_curso = $_GET['id_curso'];
$sql_tuto = "select * from Tutorial, Curso where Tutorial.id_curso = $id_curso and Curso.id_curso = $id_curso";
$res_tuto = mysqli_query($con, $sql_tuto);
?>

  <table class="table table-hover">
    <tr>
      <th>
        #ID
      </th>
      <th>
        Nombre del tutorial
      </th>
      <th>
        Descripción
      </th>
    </tr>

    <?php while($reg_tuto = mysqli_fetch_array($res_tuto)){
        ?>
      <tr onclick="document.location.href = 'tutoriales.php?id_curso=<?php echo $reg_tuto['id_curso'];?>&id_tutorial=<?php echo $reg_tuto['id_tutorial']; ?>'">
        <td>
          <?php echo $reg_tuto['id_tutorial']; ?>
        </td>
        <td>
          <a href="tutoriales.php?id_curso=<?php echo $reg_tuto['id_curso'];?>&id_tutorial=<?php echo $reg_tuto['id_tutorial']; ?>">
            <label>
              <?php echo $reg_tuto['nombre_tutorial']; ?>
            </label>
          </a>
        </td>
        <td>
          <?php echo $reg_tuto['descripcion_tutorial']; ?>
        </td>
      </tr>
      <?php }
      ?>
  </table>
  <?php
  require_once('footer.php');
 ?>
