<?php
include_once "../resources/code/models.php";
include_once "../resources/code/lang_coverage.php";
include_once "../controller/pwctrl_competition.php";

if(!isset($_SESSION)) session_start();

if(!isset($_POST["search-data"])){
	header("Location: ../view/403.php");
	exit();
}

$results = CompetitionController::search(strtolower($_POST["search-data"]));

if($results["establishments"] == NULL){
	$numOfEstablishments = 0;
}else{
	$numOfEstablishments = count($results["establishments"]);
}
if($results["pinchos"] == NULL){
	$numOfPinchos = 0;
}else{
	$numOfPinchos = count($results["pinchos"]);
}

$totalSearchElements = $numOfPinchos + $numOfEstablishments;

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?= $l["view_search_title"] ?></title>
	
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
							<h1><?= $l["view_search_title"] ?></h1>
							<span class="st-border"></span>
						</div>
					</div>
					<div class="col-md-12">
						<?php
						if($totalSearchElements == 0){
							//Didnt find anything
							?>
							<div class="alert alert-dismissible alert-danger">
								<button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button>
								<p><?= $l["view_search_not_found"] ?></p>
							</div>
							<?php
						}else{
							//Show results
							?>
							<h3><?= $l["view_search_pinchos"] ?></h3>
							<?php
							if($numOfPinchos == 0){
								?>
								<div class="alert alert-dismissible alert-danger">
									<button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button>
									<p><?= $l["view_search_not_found"] ?></p>
								</div>
								<?php
							}else{
								?>
								<table class="table table-stripped firefix">
									<thead>
										<td><?= $l["view_admin_name"] ?></td>
										<td><?= $l["view_admin_description"] ?></td>
										<td><?= $l["view_admin_ingredients"] ?></td>
									</thead>
									<tbody>
										<?php

										foreach ($results["pinchos"] as $indexRow => $row) {
											echo "<tr>";
											echo "<td>" . $row->getIdnombre() . "</td>";
											echo "<td>" . $row->getDescripcion() . "</td>";
											echo "<td>" . $row->getIngredientes() . "</td>";
											echo "</tr>";
										}
										?>
									</tbody>
								</table>
								<?php
							}
							?>

							<h3><?= $l["view_search_establishments"] ?></h3>
							<?php
							if($numOfEstablishments == 0){
								?>
								<div class="alert alert-dismissible alert-danger">
									<button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button>
									<p><?= $l["view_search_not_found"] ?></p>
								</div>
								<?php
							}else{
								?>
								<table class="table table-striped">
									<thead>
										<td><?= $l["view_profile_editmail"] ?></td>
										<td><?= $l["view_admin_name"] ?></td>
										<td><?= $l["view_profile_address"] ?></td>
										<td><?= $l["view_profile_web"] ?></td>
									</thead>
									<tbody >
										<?php

										foreach ($results["establishments"] as $indexRow => $row) {
											echo "<tr>";
											echo "<td>" . $row->getIdemail() . "</td>";
											echo "<td>" . $row->getNombre() . "</td>";
											echo "<td>" . $row->getDireccion() . "</td>";
											echo "<td>" . $row->getWeb() . "</td>";
											echo "</tr>";
										}
										?>
									</tbody>
								</table>
								<?php
							}
						}
						?>	
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
		<script type="text/javascript" src="../js/jquery.magnific-popup.min.js"></script><!-- magnific-popup -->
		<script type="text/javascript" src="../js/scripts.js"></script><!-- Scripts -->
		<script type="text/javascript" src="../js/alertify.min.js"></script><!-- Alertify -->


	</body>
	</html>