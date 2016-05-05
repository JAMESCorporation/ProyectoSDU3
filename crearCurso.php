<?php
  session_start();
  if(!isset($_SESSION['email'])){
    echo "No estas logueado <br />";
  }else{
    if(!$_POST){
      echo "No se recibieron datos <br />";
    }else{
      require_once("includes/conexion.php");
      $sqlUser = "SELECT id_usuario FROM Usuario WHERE correo = '".$_SESSION['email']."'";
      $resUser = mysql_query($sqlUser, $con);
      $regUser = mysql_fetch_array($resUser);
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $sql = "INSERT INTO Curso VALUES (null,'$nombre','$descripcion',".$regUser['id_usuario'].")";
      $res = mysql_query($sql,$con) or die("Hubo un error al guardar el curso: ".mysql_error());

      $sqlCurso = "SELECT id_curso FROM Curso ORDER BY id_curso desc limit 0,1";
      $resCurso = mysql_query($sqlCurso,$con) or die("Error obteniendo el curso: ".mysql_error());
      $regCurso = mysql_fetch_array($resCurso);

      mkdir("cursos/".$regCurso['id_curso'], 0755) or die();

      header("Location: home.php#tutorial");
    }
  }
 ?>
