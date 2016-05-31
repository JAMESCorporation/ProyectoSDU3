<?php
session_start();
require_once('includes/conexion.php');

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
				header("Location: home.php");
			}else{
				echo "<script type='text/javascript'>".
				"alert('Contraseña incorrecta');".
				"document.location.href = 'index.php';</script>";
			}
}
?>
