<?php
include_once "../controller/pincho_controller.php";
include_once "../resources/code/lang_coverage.php";
include_once "../model/juradopopular.php";
include_once "../model/juradoprofesional.php";
include_once "../model/establecimiento.php";
include_once "../model/administrador.php";

session_start();

if(get_class($_SESSION["user"]) != "Administrador"){
	header("Location: ../view/403.php");
	exit;
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
	<body id="register-body">

		<!-- PRELOADER -->
		<div id="st-preloader">
			<div id="pre-status">
				<div class="preload-placeholder"></div>
			</div>
		</div>
		<!-- /PRELOADER -->

		<a class="logo-register" href="./list.php"><img src="../images/logo.png" alt=""></a>

		<div class="container register">
			<div class="row">
				<div class="col-md-3 hidden-sm hidden-xs"></div>
				
				<div class="col-md-6 col-sm-12 col-xs-12 register-body">
					<h2><?= $l["register_title"] ?></h2>
					<p class="register-description" ><?= $l["register_professional"]?></p><br>
					
					<div class="register-tab">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#pane1" data-toggle="tab"><?= $l["register_user3"] ?></a></li>
						</ul>
						<div class="tab-content">
							<div id="pane1" class="tab-pane active">
								<form role="form" action="../controller/register_controller.php?type=juradoprofesional" method="POST">
									<div class="form-group">
										<label for="name">Nombre:</label>
										<input type="text" class="form-control" name="nombre">
									</div>

									<div class="form-group">
										<label for="email">Email:</label>
										<input type="email" class="form-control" name="idemail">
									</div>
									<div class="form-group">
										<label for="pwd">Contraseña:</label>
										<input type="password" class="form-control" name="contrasena">
									</div>
									<div class="form-group">
										<label for="pwd">Repite contraseña:</label>
										<input type="password" class="form-control" name="contrasena_verif">
									</div>
									<input class="btn btn-success" type="submit" value="Crear usuario" />
								</form>
							</div>

						</div><!-- /.tab-content -->
					</div><!-- /.register-tab -->

				</div>
				<div class="col-md-3 hidden-xs hidden-sm"></div>

			</div>
		</div>


		<?php include("./footer.php"); ?>


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
 		<script type="text/javascript" src="../js/scripts.js"></script><!-- Scripts -->


	</body>
	</html>