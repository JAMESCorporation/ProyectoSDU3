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
      $fecha_inicio = $_POST['fecha_inicio'];
      $costo = $_POST['costo'];
      //$imagen = $_POST['imagen'];
      //$sql = "INSERT INTO Curso VALUES (null,'$nombre','$descripcion','$costo','$fecha_inicio','$imagen','$tipo')";
      //$res = mysqli_query($con, $sql) or die("Hubo un error al guardar el curso: ".mysqli_connect_error());


      if (!isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] > 0)
{
    echo "Ha ocurrido un error.";
}
else
{
    // Verificamos si el tipo de archivo es un tipo de imagen permitido.
    // y que el tamaño del archivo no exceda los 16MB
    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
    $limite_kb = 16384;
 
    if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024)
    {
 
        // Archivo temporal
        $imagen_temporal = $_FILES['imagen']['tmp_name'];
 
        // Tipo de archivo
        $tipo = $_FILES['imagen']['type'];
 
        // Leemos el contenido del archivo temporal en binario.
        $fp = fopen($imagen_temporal, 'r+b');
        $data = fread($fp, filesize($imagen_temporal));
        fclose($fp);
 
        //Podríamos utilizar también la siguiente instrucción en lugar de las 3 anteriores.
        // $data=file_get_contents($imagen_temporal);
 
        // Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
        $data = mysqli_real_escape_string($con,$data);
 
        // Insertamos en la base de datos.
        //$resultado = @mysql_query("INSERT INTO Curso VALUES (null,'$nombre','$descripcion','$costo','$fecha_inicio','$data','$tipo')");
 
        $sql = "INSERT INTO Curso VALUES (null,'$nombre','$descripcion','$costo','$fecha_inicio','$data','$tipo')";
      $resultado = mysqli_query($con, $sql);
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
      $resCurso = mysqli_query($con, $sqlCurso) or die("Error obteniendo el curso: ".mysqli_connect_error());
      $regCurso = mysqli_fetch_array($resCurso);

      mkdir("cursos/".$regCurso['id_curso'], 0755) or die();

      header("Location: home.php#tutorial");
    }
  }
 ?>
