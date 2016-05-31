<?php
require_once('includes/conexion.php');
echo " ".$nombre = $_POST['nombre'];
echo " ".$apellidos = $_POST['apellidos'];
echo " ".$telefono = $_POST['telefono'];
echo " ".$direccion = $_POST['direccion'];
echo " ".$correo = $_POST['email'];
echo " ".$pass = $_POST['password'];
echo " ".$tipo = 1;
echo " ".$fecha = $_POST['fecha_nacimiento'];
$sql="INSERT INTO Usuario VALUES (null,'$nombre','$apellidos','$telefono','$direccion','$correo',md5('$pass'),'$fecha','$tipo')";
$res=mysqli_query($con, $sql) or die (mysqli_connect_error());
header("Location: registrok.php");
?>
