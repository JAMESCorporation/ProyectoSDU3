<?php
session_start();
require_once('includes/conexion.php');
$id_usuario = $_POST['id_usuario'];
$id_tutorial = $_POST['id_tutorial'];
$id_curso = $_POST['id_curso'];
$comentario = $_POST['comentario'];
$sql="INSERT into Comentario VALUES (null,'$comentario',$id_usuario,$id_tutorial,now())";
$res=mysql_query($sql,$con) or die (mysql_error());
header("Location: tutoriales.php?id_curso=$id_curso&id_tutorial=$id_tutorial");
?>
