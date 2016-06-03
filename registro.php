<?php
session_start();
require_once('includes/conexion.php');
echo " ".$nombre = $_POST['nombre'];
echo " ".$apellidos = $_POST['apellidos'];
echo " ".$telefono = $_POST['telefono'];
echo " ".$direccion = $_POST['direccion'];
echo " ".$correo = $_POST['email'];
echo " ".$pass = $_POST['password'];
echo " ".$tipo = 1;
echo " ".$fecha = $_POST['fecha_nacimiento'];
$sql="INSERT INTO Usuario VALUES (null,'$nombre','$apellidos','$telefono','$direccion','$correo',md5('$pass'),'$fecha','$tipo',2000)";
$res=mysqli_query($con, $sql) or die (mysqli_connect_error());

	$email = $_POST['email'];
	$pass = $_POST['password'];
	$sql = "SELECT * FROM Usuario WHERE correo = '$email'";
	$res = mysqli_query($con, $sql);

if(mysqli_num_rows($res) == 0) {
	echo "<script type='text/javascript'>".
	"alert('Correo no encontrado');".
	"document.location.href = 'index.php';</script>";
}else{
	$reg = mysqli_fetch_array($res) or die("Error al convertir en registros");
			if($reg['password'] == md5($pass)){

				$_SESSION['email'] = $email;
				header("Location: curso.php");
			}else{
				echo "<script type='text/javascript'>".
				"alert('Contraseña incorrecta');".
				"document.location.href = 'index.php';</script>";
			}
}

header("Location: index.php");
?>
