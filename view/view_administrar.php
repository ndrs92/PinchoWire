<?php
include_once __DIR__."/../resources/code/models.php";
include_once __DIR__."/../resources/code/lang_coverage.php";
include_once __DIR__."/../controller/pincho_controller.php";




if(!isset($_SESSION)) session_start();

if(get_class($_SESSION["user"])!="Administrador"){
	header("Location: 403.php");
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?= $l["view_admin_management"] ?></title>
	
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
							<a href="list.php"><div class="back-button"></div></a><h1><?= $l["view_admin_management"] ?></h1>
							<span class="st-border"></span>
						</div>
					</div>

					<div class="admin-options col-md-12">
						<div class="list-group">
							<a href="view_admin_concurso.php" class="list-group-item">
								<h4 class="list-group-item-heading"><?= $l["view_admin_manageContest"] ?></h4>
								<p class="list-group-item-text"><?= $l["view_admin_manageContest_text"] ?></p>
							</a>
							<a href="view_admin_usuarios.php" class="list-group-item">
								<h4 class="list-group-item-heading"><?= $l["view_admin_manageUsers"] ?></h4>
								<p class="list-group-item-text"><?= $l["view_admin_manageUsers_text"] ?></p>
							</a>
							<?php 
							$concurso= CompetitionController::getConcurso();
							if($concurso->getEstado() == 0){				
								?> 
								
								<a href="view_admin_propuestas.php" class="list-group-item">
									<h4 class="list-group-item-heading"><?= $l["view_admin_managePincho"] ?></h4>
									<p class="list-group-item-text"><?= $l["view_admin_managePincho_text"] ?></p>
								</a>
								<a href="view_admin_asignar.php" class="list-group-item">
									<h4 class="list-group-item-heading"><?= $l["view_admin_assignPinchos"] ?></h4>
									<p class="list-group-item-text"><?= $l["view_admin_assignPinchos_text"] ?></p>
								</a>
								<?php 
							}
							?>
						</div>
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