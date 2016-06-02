<?php 
session_start();
require_once('includes/conexion.php');
	$tam = $_POST['tam'];
	$id_usuario = $_POST['id_usuario'];
	$id_test = $_POST['id_test'];
	$id_curso = $_POST['id_curso'];
	$id_tutorial = $_POST['id_tutorial'];
	$vec[$tam];
	$suma = 0;
	for ($i=0; $i < $tam; $i++) { 
		$vec[$i] = $_POST["$i"];
		if($vec[$i] == 1){
			$suma++;
		}
	}
	$calificacion = (($suma * 10) / ($tam));
	$sql = "INSERT INTO Usuario_has_Test VALUES ($id_usuario,$id_test,$calificacion,now())";
	$res = mysqli_query($con, $sql) or die ("error al insertar "+mysqli_connect_error());
	header("Location: tutoriales.php?id_curso=$id_curso&id_tutorial=$id_tutorial");
?>