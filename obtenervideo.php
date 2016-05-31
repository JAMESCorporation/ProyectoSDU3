<?php
// Conexion a la base de datos
require_once('includes/conexion.php');
 
if ($_GET['id'] > 0)
{
    $id = $_GET['id'];
    // Consulta de búsqueda de la imagen.
    $sql = "SELECT video, tipo_video FROM Tutorial WHERE id_tutorial='$id'";
    $resultado = mysqli_query($con, $sql) or die(mysqli_connect_error());
    $datos = mysqli_fetch_array($resultado);
 
    $imagen = $datos['video']; // Datos binarios de la imagen.
    $tipo = $datos['tipo_video'];  // Mime Type de la imagen.
    // Mandamos las cabeceras al navegador indicando el tipo de datos que vamos a enviar.
    header("Content-type: $tipo");
    // A continuación enviamos el contenido binario de la imagen.
    echo $imagen;
}
?>