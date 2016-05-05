<?php

session_start();
  if(!isset($_SESSION['email'])){
    echo "No estas logueado. <a href='index.html'>Iniciar Sesión</a>";
  }else{

$destinatario = $_POST['destinatario'];
$asunto = $_POST['asunto'];
$cuerpo = $_POST['cuerpo'];
$correo = $_POST['correo'];
$nombre = $_POST['nombre'];

//para el envío en formato HTML
//$headers = "MIME-Version: 1.0\r\n";
//$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

//dirección del remitente
$headers = "From: ".$nombre."\r\n";

//dirección de respuesta, si queremos que sea distinta que la del remitente
$headers .= "Reply-To: ".$correo."\r\n";

//ruta del mensaje desde origen a destino
//$headers .= "Return-path: holahola@desarrolloweb.com\r\n";

//direcciones que recibián copia
//$headers .= "Cc: maria@desarrolloweb.com\r\n";

//direcciones que recibirán copia oculta
//$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n";

mail($destinatario,$asunto,$cuerpo,$headers) or die("Error enviando el mensaje al Administrador");
//echo $destinatario." ".$asunto." ".$cuerpo." ".$headers;;
echo "Correo enviado";
}
 ?>
