<?php
include_once __DIR__."/../resources/code/models.php";
include_once __DIR__."/../resources/code/lang_coverage.php";

include_once __DIR__."/../controller/pincho_controller.php";

if(!isset($_SESSION)) session_start();

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
	<link rel="stylesheet" href="../css/alertify.default.css" />
	<link rel="stylesheet" href="../css/alertify.core.css" />
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="../images/icon/favicon.ico">
	
	
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
							<a href="view_admin_usuarios.php"><div class="back-button"></div></a><h1><?= $l["register_proffesional_title"] ?></h1>
							<p class="register-description" ><?= $l["register_proffesional_select"]?></p>
							<span class="st-border"></span>
						</div>
					</div>
					<div class="col-md-12">
						<form role="form" action="../controller/pw.php?controller=user&action=register&type=juradoprofesional" method="POST">
							<div class="form-group">
								<label for="name"><?= $l["register_name"]?></label>
								<input type="text" class="form-control" name="nombre">
							</div>

							<div class="form-group">
								<label for="email"><?= $l["register_email"]?></label>
								<input type="email" class="form-control" name="idemail">
							</div>
							<div class="form-group">
								<label for="pwd"><?= $l["register_password"]?></label>
								<input type="password" class="form-control" name="contrasena">
							</div>
							<div class="form-group">
								<label for="pwd"><?= $l["register_passwordRepeat"]?></label>
								<input type="password" class="form-control" name="contrasena_verif">
							</div>
							<input class="btn btn-success" type="submit" value="<?= $l["register_createUser"] ?>" />
						</form>
						
						
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
		<script type="text/javascript" src="../js/amcharts.js"></script> <!-- AmChart General Lib -->
		<script type="text/javascript" src="../js/pie.js"></script><!-- AmChart PieChart -->
		<script type="text/javascript" src="../js/light.js"></script><!-- AmChart PieChart Theme -->
		<script type="text/javascript" src="../js/jquery.min.js"></script><!-- jQuery -->
		<script type="text/javascript" src="../js/bootstrap.min.js"></script><!-- Bootstrap -->
		<script type="text/javascript" src="../js/jquery.parallax.js"></script><!-- Parallax -->
		<script type="text/javascript" src="../js/smoothscroll.js"></script><!-- Smooth Scroll -->
		<script type="text/javascript" src="../js/owl.carousel.min.js"></script><!-- Owl-Carousel -->
		<script type="text/javascript" src="../js/scripts.js"></script><!-- Scripts -->
		<script type="text/javascript" src="../js/main.js"></script><!-- PinchoWire Scripts -->
		<script type="text/javascript" src="../js/alertify.min.js"></script><!-- Alertify -->


	</body>
	</html>




