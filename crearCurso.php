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
      $resUser = mysqli_query($con, $sqlUser);
      $regUser = mysqli_fetch_array($resUser);
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $sql = "INSERT INTO Curso VALUES (null,'$nombre','$descripcion',".$regUser['id_usuario'].")";
      $res = mysqli_query($con, $sql) or die("Hubo un error al guardar el curso: ".mysqli_connect_error());

      $sqlCurso = "SELECT id_curso FROM Curso ORDER BY id_curso desc limit 0,1";
      $resCurso = mysqli_query($con, $sqlCurso) or die("Error obteniendo el curso: ".mysqli_connect_error());
      $regCurso = mysqli_fetch_array($resCurso);

      mkdir("cursos/".$regCurso['id_curso'], 0755) or die();

      header("Location: home.php#tutorial");
    }
  }
 ?>
