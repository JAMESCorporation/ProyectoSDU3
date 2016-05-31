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

      $sqlUser = "SELECT id_usuario FROM Usuario WHERE correo = '".$_SESSION['email']."'";
      $resUser = mysqli_query($con, $sqlUser);
      $regUser = mysqli_fetch_array($resUser);
      //$sql = "INSERT INTO Tutorial VALUES (null,'$nombre','$descripcion',".($regCurso['noTutorial']+1).",'$curso')";
      //$res = mysqli_query($con, $sql) or die("Hubo un error al guardar el tutorial: ".mysqli_connect_error());

      if (!isset($_FILES["video"]) || $_FILES["video"]["error"] > 0){
          echo "Ha ocurrido un error.";
      } else {
        $permitidos = array("video/mp4", "video/h264", "video/mpeg", "video/ogg");
        $limite_kb = 204800; 
        if (in_array($_FILES['video']['type'], $permitidos) && $_FILES['video']['size'] <= $limite_kb * 1024){
               
            $video_temporal = $_FILES['video']['tmp_name'];
            $tipo = $_FILES['video']['type'];
            $fp = fopen($video_temporal, 'r+b');
            $data = fread($fp, filesize($video_temporal));
            fclose($fp);
            $data = mysqli_real_escape_string($con,$data);
            $sql = "INSERT INTO Tutorial VALUES (null,'$nombre','$descripcion','$data','$tipo',0,0,0,now(),'$curso')";
            $resultado = mysqli_query($con, $sql) or die("Error al enviar datos".mysqli_error($con));
            if ($resultado)
            {
                echo "El archivo ha sido copiado exitosamente.";
            }
            else
            {
                echo "Ocurrió algun error al copiar el archivo.";
            }
        } else {
            echo "Formato de archivo no permitido o excede el tamaño límite de $limite_kb Kbytes.";
        }

        header("Location: home.php#tutorial");
      }

      
    }
  }

 ?>
