<?php

	$con = mysql_connect('localhost','root','esasistemas') or die("Error al conectar"+mysql_error());
	//$con = mysql_connect('localhost','WebPage','esasistemas') or die("Error al conectar"+mysql_error());
	$db = "James";
	//if(isset($con)){
	//	echo "Conexión realizada exitosamente";
	//}
	mysql_select_db($db) or die('No se pudo seleccionar la base de datos');;

	mysql_query("SET NAMES 'utf8'");

?>
