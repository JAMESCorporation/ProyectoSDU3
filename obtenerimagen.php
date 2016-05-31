<?php
// Conexion a la base de datos
require_once('includes/conexion.php');
 
if ($_GET['id'] > 0)
{
    $id = $_GET['id'];
    // Consulta de búsqueda de la imagen.
    $sql = "SELECT imagen, tipo_imagen FROM Curso WHERE id_curso='$id'";
    $resultado = mysqli_query($con, $sql) or die(mysqli_connect_error());
    $datos = mysqli_fetch_array($resultado);
 
    $imagen = $datos['imagen']; // Datos binarios de la imagen.
    $tipo = $datos['tipo_imagen'];  // Mime Type de la imagen.
    // Mandamos las cabeceras al navegador indicando el tipo de datos que vamos a enviar.
    header("Content-type: $tipo");
    // A continuación enviamos el contenido binario de la imagen.
    echo $imagen;
}
?>