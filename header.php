<?php
  session_start();
  require_once('includes/conexion.php');
  if(!isset($_SESSION['email'])){
    $valorSesion = -1;
  } else {
    $valorSesion = 1;
    $correo = $_SESSION['email'];
  }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>JAMES Courses</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      
      <link rel="stylesheet" href="includes/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="includes/bootstrap/dist/css/bootstrap.css">
      <link rel="stylesheet" href="includes/bootstrap/dist/css/style.css">
      <link rel="stylesheet" href="includes/animations.css">
      <link rel="stylesheet" href="includes/slider.css">
</head>

<body>
  <!-- Fixed navbar -->
  
    <div class="navbar navbar-inverse transparent navbar-fixed-top" id="header-general" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand active" href="index.php">JAMES Courses</a>
        </div>

				<?php
          if($valorSesion == -1){
        ?>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="curso.php">Cursos</a></li>
            <li><a href="quiensomos.php">¿Quiénes somos?</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right ">
            <li>
              <button type="button" class="botn botn-primary botn-lg outline" data-toggle="modal" data-target="#myModal2" >
                <span class="glyphicon glyphicon-edit"></span> Registrate
              </button>
              <!-- <a href="#myModal"><span class="glyphicon glyphicon-log-in"></span> Login</a> -->
            </li>
            <li>
              <button type="button" class="botn botn-primary botn-lg outline" data-toggle="modal" data-target="#myModal" >
                <span class="glyphicon glyphicon-log-in"></span> Iniciar Sesión
              </button>
              <!-- <a href="#myModal"><span class="glyphicon glyphicon-log-in"></span> Login</a> -->
            </li>
          </ul>
        </div>
				<?php

          } else {
					$sql_curso = "select * from usuarios as u, curso as c, curso_has_usuario cu where u.id_usuario = cu.id_usuario and c.id_curso = cu.id_curso and u.curso = $correo;";
					$res_curso = mysqli_query( $con, $sql_curso);
					 ?>
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
	            <li><a href="curso.php">Cursos</a></li>
	            <li><a href="home.php#curso">Crear Curso</a></li>
							<li><a href="home.php#tutorial">Agregar tutorial</a></li>
              <li><a href="quiensomos.php">¿Quiénes somos?</a></li>
              <li><a href="contacto.php">Contacto</a></li>
              <!--<li><a href="enviarCorreo.php">Enviar correo</a></li>-->
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li>
								<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $correo ?> </a>
                  <ul class="dropdown-menu">
                    <li><a href="#">
                      <?php 
                        $sqlP = "SELECT puntos FROM Usuario WHERE correo = '$correo'";
                        $resP = mysqli_query($con, $sqlP) or die(mysqli_error($con));
                        $regP = mysqli_fetch_array($resP);
                        echo $regP['puntos']."<span class='glyphicon glyphicon-heart' style='color:red;'></span></a>";
                       ?>
                    </li>
                  </ul>
                </li>
								<li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesión</a></li>
							</li>
						</ul>
					</div>
					<?php } ?>
      </div>
    </div>
    <?php
    require_once("registroForm.php");
    require_once("logueoForm.php");
     ?>
