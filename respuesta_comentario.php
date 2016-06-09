<?php
session_start();
require_once('includes/conexion.php');
$id_usuario = $_POST['id_usuario'];
$id_comentario = $_POST['id_comentario'];
$respuesta = $_POST['respuesta'];
$id_tutorial = $_POST['id_tutorial'];
$id_curso = $_POST['id_curso'];

echo "id_usuario: ".$id_usuario." id_comentario: ".$id_comentario." Res: ".$respuesta." id_tutorial: ".$id_tutorial." id_curso: ".$id_curso;
$sql="INSERT into Respuesta_comentario VALUES (null,'$respuesta',now(),$id_usuario,$id_comentario)";
$res=mysqli_query($con, $sql) or die (mysqli_connect_error());
header("Location: tutoriales.php?id_curso=$id_curso&id_tutorial=$id_tutorial");
?>
