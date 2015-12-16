<?php
include_once "../resources/code/models.php";
include_once "../resources/code/lang_coverage.php";
include_once "../controller/pincho_controller.php";


if(!isset($_SESSION)) session_start();

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
	<link rel="stylesheet" href="../css/magnific-popup.css" />
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
							<h1><?= $l["view_winners_title"] ?></h1>
							<span class="st-border"></span>
						</div>
					</div>			
				</div>
				<h3 class="winners-text"><?= $l["view_winners_professional_winners"] ?></h3>
				<a href="#">
					<div class="winners-list">
						<div class="col-md-2 col-xs-3 col-sm-3"><img class="winner-pincho-image img-responsive" src="../images/pinchos/default.jpg" /></div>
						<div class="col-md-10 col-xs-9 col-sm-9 winner-pincho-info">
							<h5 class="winner-pincho-name">Pincho Name</h5>
							<h5 class="winner-pincho-ingredients">Ingredients</h5>
							<h5 class="winner-pincho-prize">Prize</h5>
							<h5 class="winner-pincho-establishment">Establishment (Name: mail)</h5>
						</div>
						<img class="winner-pincho-badge" src="../images/icon/badge_gold.png"/>
					</div>
				</a>

				<a href="#">
					<div class="winners-list">
						<div class="col-md-2 col-xs-3 col-sm-3"><img class="winner-pincho-image img-responsive" src="../images/pinchos/default.jpg" /></div>
						<div class="col-md-10 col-xs-9 col-sm-9 winner-pincho-info">
							<h5 class="winner-pincho-name">Pincho Name</h5>
							<h5 class="winner-pincho-ingredients">Ingredients</h5>
							<h5 class="winner-pincho-prize">Prize</h5>
							<h5 class="winner-pincho-establishment">Establishment (Name: mail)</h5>
						</div>
						<img class="winner-pincho-badge" src="../images/icon/badge_silver.png"/>
					</div>
				</a>

				<a href="#">
					<div class="winners-list">
						<div class="col-md-2 col-xs-3 col-sm-3"><img class="winner-pincho-image img-responsive" src="../images/pinchos/default.jpg" /></div>
						<div class="col-md-10 col-xs-9 col-sm-9 winner-pincho-info">
							<h5 class="winner-pincho-name">Pincho Name</h5>
							<h5 class="winner-pincho-ingredients">Ingredients</h5>
							<h5 class="winner-pincho-prize">Prize</h5>
							<h5 class="winner-pincho-establishment">Establishment (Name: mail)</h5>
						</div>
						<img class="winner-pincho-badge" src="../images/icon/badge_bronze.png"/>
					</div>
				</a>

				




				<br><br>
				<br><br>
				<h3 class="winners-text"><?= $l["view_winners_popular_winners"] ?></h3>
				<a href="#">
					<div class="winners-list">
						<div class="col-md-2 col-xs-3 col-sm-3"><img class="winner-pincho-image img-responsive" src="../images/pinchos/default.jpg" /></div>
						<div class="col-md-10 col-xs-9 col-sm-9 winner-pincho-info">
							<h5 class="winner-pincho-name">Pincho Name</h5>
							<h5 class="winner-pincho-ingredients">Ingredients</h5>
							<h5 class="winner-pincho-prize">Prize</h5>
							<h5 class="winner-pincho-establishment">Establishment (Name: mail)</h5>
						</div>
						<img class="winner-pincho-badge" src="../images/icon/badge_gold.png"/>
					</div>
				</a>

				<a href="#">
					<div class="winners-list">
						<div class="col-md-2 col-xs-3 col-sm-3"><img class="winner-pincho-image img-responsive" src="../images/pinchos/default.jpg" /></div>
						<div class="col-md-10 col-xs-9 col-sm-9 winner-pincho-info">
							<h5 class="winner-pincho-name">Pincho Name</h5>
							<h5 class="winner-pincho-ingredients">Ingredients</h5>
							<h5 class="winner-pincho-prize">Prize</h5>
							<h5 class="winner-pincho-establishment">Establishment (Name: mail)</h5>
						</div>
						<img class="winner-pincho-badge" src="../images/icon/badge_silver.png"/>
					</div>
				</a>

				<a href="#">
					<div class="winners-list">
						<div class="col-md-2 col-xs-3 col-sm-3"><img class="winner-pincho-image img-responsive" src="../images/pinchos/default.jpg" /></div>
						<div class="col-md-10 col-xs-9 col-sm-9 winner-pincho-info">
							<h5 class="winner-pincho-name">Pincho Name</h5>
							<h5 class="winner-pincho-ingredients">Ingredients</h5>
							<h5 class="winner-pincho-prize">Prize</h5>
							<h5 class="winner-pincho-establishment">Establishment (Name: mail)</h5>
						</div>
						<img class="winner-pincho-badge" src="../images/icon/badge_bronze.png"/>
					</div>
				</a>



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
		<script type="text/javascript" src="../js/jquery.magnific-popup.min.js"></script><!-- magnific-popup -->
		<script type="text/javascript" src="../js/scripts.js"></script><!-- Scripts -->
		<script type="text/javascript" src="../js/alertify.min.js"></script><!-- Alertify -->

	</body>
	</html>