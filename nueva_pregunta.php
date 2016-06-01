<?php 
require_once("includes/conexion.php");	
$pregunta = $_POST['pregunta'];
$res1 = $_POST['res1'];
$res2 = $_POST['res2'];
$res3 = $_POST['res3'];
$correcta = $_POST['correcta'];
$id_test = $_POST['id_test'];

$sql = "INSERT INTO Pregunta VALUES (null,'$pregunta',$id_test)";
$res = mysqli_query($con, $sql) or die (myqli_connect_error());

$sql = "select id_pregunta from Pregunta order by id_pregunta desc limit 1";
$res = mysqli_query($con, $sql) or die (myqli_connect_error());
$reg = mysqli_fetch_array($res) or die (myqli_connect_error());

$id_pregunta = $reg['0'];

	if($correcta == 1){
		$sql = "INSERT INTO Respuesta VALUES (null,'$res1',1,$id_pregunta)";
		$res = mysqli_query($con, $sql) or die (myqli_connect_error());

		$sql = "INSERT INTO Respuesta VALUES (null,'$res2',0,$id_pregunta)";
		$res = mysqli_query($con, $sql) or die (myqli_connect_error());

		$sql = "INSERT INTO Respuesta VALUES (null,'$res3',0,$id_pregunta)";
		$res = mysqli_query($con, $sql) or die (myqli_connect_error());
	}
	if($correcta == 2){
		$sql = "INSERT INTO Respuesta VALUES (null,'$res1',0,$id_pregunta)";
		$res = mysqli_query($con, $sql) or die (myqli_connect_error());

		$sql = "INSERT INTO Respuesta VALUES (null,'$res2',1,$id_pregunta)";
		$res = mysqli_query($con, $sql) or die (myqli_connect_error());

		$sql = "INSERT INTO Respuesta VALUES (null,'$res3',0,$id_pregunta)";
		$res = mysqli_query($con, $sql) or die (myqli_connect_error());
	}
	if($correcta == 3){
		$sql = "INSERT INTO Respuesta VALUES (null,'$res1',0,$id_pregunta)";
		$res = mysqli_query($con, $sql) or die (myqli_connect_error());

		$sql = "INSERT INTO Respuesta VALUES (null,'$res2',0,$id_pregunta)";
		$res = mysqli_query($con, $sql) or die (myqli_connect_error());

		$sql = "INSERT INTO Respuesta VALUES (null,'$res3',1,$id_pregunta)";
		$res = mysqli_query($con, $sql) or die (myqli_connect_error());
	}

?>