<?php
include_once "../controller/pincho_controller.php";
include_once "../resources/code/lang_coverage.php";
include_once "../model/juradopopular.php";
include_once "../model/juradoprofesional.php";
include_once "../model/establecimiento.php";
include_once "../model/administrador.php";

if(!isset($_SESSION)) session_start();

if(!empty($_SESSION["user"])){
	header("Location: list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?= $l["register_title"] ?></title>
	
	<!-- Main CSS file -->
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../css/owl.carousel.css" />
	<link rel="stylesheet" href="../css/magnific-popup.css" />
	<link rel="stylesheet" href="../css/font-awesome.css" />
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" href="../css/responsive.css" />
	<link rel="stylesheet" href="../css/main.css" />

	
	<!-- Favicon -->
	<link rel="shortcut icon" href="../../images/icon/favicon.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../images/icon/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../images/icon/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../images/icon/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="../../images/icon/apple-touch-icon-57-precomposed.png">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	  <![endif]-->

	</head>
	<body>

		<!-- PRELOADER -->
		<div id="st-preloader">
			<div id="pre-status">
				<div class="preload-placeholder"></div>
			</div>
		</div>
		<!-- /PRELOADER -->


		<?php include("./header.php"); ?>


		<!-- PINCHOS -->
		<section id="pinchos">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h1><?= $l["register_title"] ?></h1>
							<p class="register-description" ><?= $l["register_select"]?></p>
							<span class="st-border"></span>
						</div>
					</div>
					<div class="col-md-12">


						<div class="register-tab">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#pane1" data-toggle="tab"><?= $l["register_user1"] ?></a></li>
								<li><a href="#pane2" data-toggle="tab"><?= $l["register_user2"] ?></a></li>
							</ul>
							<div class="tab-content">
								<div id="pane1" class="tab-pane active">
									<form data-toggle="validator" role="form" action="../controller/register_controller.php?type=juradopopular" method="POST" enctype="multipart/form-data">
										<div class="form-group">
											<label for="name">Nombre:</label>
											<input data-error="Introduce un nombre de mínimo 4 caracteres" required data-minlength="4" type="text" class="form-control" name="nombre">
											<div class="help-block with-errors"></div>
										</div>

										<div class="form-group">
											<label for="email">Email:</label>
											<input data-error="Introduce un email válido" required data-minlength="7" type="email" class="form-control" name="idemail">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="pwd">Password:</label>
											<input data-error="Introduce una contraseña de al menos 8 caracteres" required data-minlength="8" id="passToMatch" type="password" class="form-control" name="contrasena">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="pwd">Repite Password:</label>
											<input data-error="Las contraseñas no coinciden" data-minlength="8" data-match="#passToMatch" required type="password" class="form-control" name="contrasena_verif">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="avatar">Avatar:</label>
											<input type="file" class="form-control" name="rutaavatar">
										</div>
										<input class="btn btn-success" type="submit" value="Crear usuario" />
									</form>
								</div>
								<div id="pane2" class="tab-pane">
									<form data-toggle="validator" role="form" action="../controller/register_controller.php?type=establishment" method="POST" enctype="multipart/form-data">
										<div class="form-group">
											<label for="name">Nombre:</label>
											<input required data-error="Introduce un nombre de mínimo 4 caracteres" required data-minlength="4" type="text" class="form-control" name="nombre">
											<div class="help-block with-errors"></div>
										</div>

										<div class="form-group">
											<label for="email">Email:</label>
											<input required data-error="Introduce un email válido" required data-minlength="7" type="email" class="form-control" name="idemail">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="direction">Dirección:</label>
											<input required data-error="Introduce una ubicación de al menos 8 caracteres" required data-minlength="8" type="text" class="form-control" name="direccion">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="web">Pagina Web:</label>
											<input required type="url" data-error="Introduce una URL válida" class="form-control" name="paginaweb">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="time">Horario:</label>
											<input required type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9] - ([01]?[0-9]|2[0-3]):[0-5][0-9]" data-error="Introduce un horario de la forma: 8:00 - 16:00" class="form-control" name="horario">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="time">Coordenadas del establecimiento:</label>
											<input required type="text" pattern="^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?), \s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$" data-error="Introduce unas coordenadas formato google maps: 42.347285, -7.856278" class="form-control" name="coordenadas">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="pwd">Password:</label>
											<input required type="password" data-error="Introduce una contraseña de al menos 8 caracteres" required data-minlength="8" id="passToMatch" class="form-control" name="contrasena">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="pwd">Repite Password:</label>
											<input required type="password" data-error="Las contraseñas no coinciden" data-minlength="8" data-match="#passToMatch" class="form-control" name="contrasena_verif">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="avatar">Fotografía del local:</label>
											<input type="file" class="form-control" name="foto" accept="image/*" />
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="avatar">Logo de la empresa:</label>
											<input type="file" class="form-control" name="rutaavatar" accept="image/*" />
											<div class="help-block with-errors"></div>
										</div>
										<input class="btn btn-success" type="submit" value="Crear usuario" />
									</form>
								</div>
							</div><!-- /.tab-content -->
						</div><!-- /.register-tab -->
						
						
					</div>
				</div>
			</div>
		</section>
		<!-- /PINCHOS -->

		<?php include("./footer.php"); ?>

		<!-- Scroll-up -->
		<div class="scroll-up">
			<ul><li><a href="#header"><i class="fa fa-angle-up"></i></a></li></ul>
		</div>


		<!-- JS -->
		<script type="text/javascript" src="../js/jquery.min.js"></script><!-- jQuery -->
		<script type="text/javascript" src="../js/bootstrap.min.js"></script><!-- Bootstrap -->
		<script type="text/javascript" src="../js/jquery.parallax.js"></script><!-- Parallax -->
		<script type="text/javascript" src="../js/smoothscroll.js"></script><!-- Smooth Scroll -->
		<script type="text/javascript" src="../js/masonry.pkgd.min.js"></script><!-- masonry -->
		<script type="text/javascript" src="../js/jquery.fitvids.js"></script><!-- fitvids -->
		<script type="text/javascript" src="../js/owl.carousel.min.js"></script><!-- Owl-Carousel -->
		<script type="text/javascript" src="../js/jquery.counterup.min.js"></script><!-- CounterUp -->
		<script type="text/javascript" src="../js/waypoints.min.js"></script><!-- CounterUp -->
		<script type="text/javascript" src="../js/jquery.isotope.min.js"></script><!-- isotope -->
		<script type="text/javascript" src="../js/validator.min.js"></script><!-- isotope -->
		<script type="text/javascript" src="../js/scripts.js"></script><!-- Scripts -->


	</body>
	</html>