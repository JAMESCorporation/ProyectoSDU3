<?php

	
	//$con = mysql_connect('localhost','WebPage','esasistemas') or die("Error al conectar"+mysql_error());
	$db = "James";
	$con = mysqli_connect('localhost','root','esasistemas',$db) or die("Error al conectar ".mysqli_connect_errno()." ".mysqli_connect_error());
	//if(isset($con)){
	//	echo "Conexión realizada exitosamente";
	//}
	//mysqli_select_db($db) or die('No se pudo seleccionar la base de datos');;

	mysqli_query($con,"SET NAMES 'utf8'");

?>
