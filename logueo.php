<?php
session_start();
require_once('includes/conexion.php');

	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$sql = "SELECT * FROM Usuario WHERE correo = '$email'";
	$res = mysql_query($sql,$con);

if(mysql_num_rows($res) == 0) {
	echo "<script type='text/javascript'>".
	"alert('Correo no encontrado');".
	"document.location.href = 'index.php';</script>";
}else {
	$reg = mysql_fetch_array($res) or die("Error al convertir en registros");
			if($reg['pass'] == md5($pass)){

				$_SESSION['email'] = $email;
				header("Location: home.php");
			}else{
				echo "<script type='text/javascript'>".
				"alert('Contraseña incorrecta');".
				"document.location.href = 'index.php';</script>";
			}
}
?>
