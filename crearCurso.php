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
      $id_usuario = $regUser['id_usuario'];

      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $costo = $_POST['costo'];
      $categoria = $_POST['categoria'];
      if (!isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] > 0){
          echo "Ha ocurrido un error.";
      } else {
        $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
        $limite_kb = 16384; 
        if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
               
            $imagen_temporal = $_FILES['imagen']['tmp_name'];
            $tipo = $_FILES['imagen']['type'];
            $fp = fopen($imagen_temporal, 'r+b');
            $data = fread($fp, filesize($imagen_temporal));
            fclose($fp);
            $data = mysqli_real_escape_string($con,$data);
            $sql = "INSERT INTO Curso VALUES (null,'$nombre','$descripcion','$costo','$fecha_inicio','$data','$tipo')";
            $resultado = mysqli_query($con, $sql) or die(mysqli_connect_error());
            if ($resultado)
            {
                echo "El archivo ha sido copiado exitosamente.";
            }
            else
            {
                echo "Ocurrió algun error al copiar el archivo.";
            }
        }
        else
        {
            echo "Formato de archivo no permitido o excede el tamaño límite de $limite_kb Kbytes.";
        }
      }

      

      $sqlCurso = "SELECT id_curso FROM Curso ORDER BY id_curso desc limit 0,1";
      $resCurso = mysqli_query($con, $sqlCurso) or die("Error obteniendo el curso: ".mysqli_error($con));
      $regCurso = mysqli_fetch_array($resCurso);
      $id_curso = $regCurso['id_curso'];
      
      $sql = "INSERT INTO Usuario_has_Curso VALUES ('$id_usuario','$id_curso',1)";      
      $resultado = mysqli_query($con, $sql) or die("Hubo un error al insertar".mysqli_error($con));

      $sql = "INSERT INTO Curso_has_Categoria VALUES ('$categoria','$id_curso')";      
      $resultado = mysqli_query($con, $sql) or die("Hubo un error al insertar en categorias".mysqli_error($con));
      header("Location: home.php#tutorial");
    }
  }
 ?>
