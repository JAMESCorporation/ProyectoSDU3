<?php
  session_start();
  if(!isset($_SESSION['email'])){
    echo "No estas logueado <br />";
  }else{
    if(!$_POST){
      echo "No se recibieron datos <br />";
    }else{
      require_once("includes/conexion.php");
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $curso = $_POST['cursos'];
      $directorioCurso = "cursos/".$curso;
      echo $directorioCurso."<br />";
      $sqlUser = "SELECT id_usuario FROM Usuario WHERE correo = '".$_SESSION['email']."'";
      $resUser = mysql_query($sqlUser, $con);
      $regUser = mysql_fetch_array($resUser);

      $sqlCurso = "SELECT count(id_curso ) as noTutorial FROM Tutorial WHERE id_curso='".$curso."'";
      $resCurso = mysql_query($sqlCurso,$con) or die("Error obteniendo el curso: ".mysql_error());
      $regCurso = mysql_fetch_array($resCurso);

      $directorioTutorial = $directorioCurso."/".($regCurso['noTutorial']+1)."/";
      echo $directorioTutorial."<br />";
      mkdir($directorioTutorial, 0755) or die();
      //echo "INSERT INTO Tutorial VALUES (null,'$nombre','$descripcion',".($regCurso['noTutorial']+1).")";
      $sql = "INSERT INTO Tutorial VALUES (null,'$nombre','$descripcion',".($regCurso['noTutorial']+1).",'$curso')";
      $res = mysql_query($sql,$con) or die("Hubo un error al guardar el tutorial: ".mysql_error());

      $sqlTuto = "SELECT id_tutorial FROM Tutorial ORDER BY id_tutorial desc limit 0,1";
      $resTuto = mysql_query($sqlTuto,$con) or die("Error obteniendo el curso: ".mysql_error());
      $regTuto = mysql_fetch_array($resTuto);

      if ($_FILES['archivos']) {
        $file_ary = reArrayFiles($_FILES['archivos']);
        $counter = 1;
        foreach ($file_ary as $file) {
          if ($counter == 1) {
            $ficheroSubida = $directorioTutorial.basename($regTuto['id_tutorial'].".mp4");
            $counter++;
          }else{
            $ficheroSubida = $directorioTutorial.basename($file['name']);
          }
          if(move_uploaded_file($file['tmp_name'], $ficheroSubida)){
            echo "Recurso cargado satisfactoriamente";
            $sqlRecurso = "INSERT INTO Recurso VALUES (null,'".$file['name']."',".$regTuto['id_tutorial'].")";
            $resRecurso = mysql_query($sqlRecurso,$con) or die("Error al guardar registro del recurso: ".mysql_error());
          }else{
            echo "Algo salio mal al subir el fichero";
          }
        }
        header("Location: home.php#tutorial");
      }else{
        echo "Hubo un error al recibir  los archivos, introduzca al menos un video";
      }


    }
  }

  function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
 ?>
