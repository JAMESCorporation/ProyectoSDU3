<?php 
$tam = $_POST['tam'];
echo $tam;
$vec[$tam];
$suma = 0;
for ($i=0; $i < $tam; $i++) { 
	$vec[$i] = $_POST["$i"];
	if($vec[$i] == 1){
		$suma++;
	}
}
$calificacion = (($suma * 10) / ($tam));
echo $calificacion;
?>