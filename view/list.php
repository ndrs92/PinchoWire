<?php
include_once "../resources/code/models.php";
include_once "../resources/code/lang_coverage.php";

include_once "../controller/pw.php";
include_once "../controller/pwctrl_user.php";
include_once "../controller/pwctrl_competition.php";

include_once "../controller/pincho_controller.php";


if (!isset($_SESSION)) session_start();
$concurso = CompetitionController::getConcurso();
$establecimientos = UserController::getAllEstablecimientos();

$rutaPortada = $concurso->getRutaportada(); 

$estado = -1;

$estado = $concurso->getEstado();

if($estado == 2){
	header("Location: ganadores.php");
}

if($rutaPortada == "") {
	$rutaPortada = "images/concurso/default.jpg";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?= $l["appname"] ?></title>

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


		<!-- SLIDER -->
		<section id="slider">
			<div id="home-carousel" class="carousel slide" data-ride="carousel">			
				<div class="carousel-inner">
					<div class="item active" style="background-image: url(../<?= $rutaPortada ?>)">
						<div class="carousel-caption container">
							<div class="row">
								<div class="col-sm-12">
									<h2><?= $concurso->getTitulo() ?></h2>
									<p><?= $concurso->getDescripcion() ?></p>
									<br/>
									<?php if(!isset($_SESSION["user"])){
										?>
										<a href="./register.php" class="btn btn-lg btn-send"><?= $l["app_signup"]?></a>
										<?php
									}
									?>
								</div>
							</div>
							<img class="logo-powered" src="../images/logo-inverted.png" alt="">
						</div>					
					</div>
				</div>		
			</div> <!--/#home-carousel--> 
		</section>
		<!-- /SLIDER -->


		<!-- PINCHOS -->
		<section id="pinchos">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h1><?= $l["main_lista_pinchos"] ?></h1>
							<h5><?= $l["main_lista_pinchos_desc"] ?></h5>
							<span class="st-border"></span>
						</div>
					</div>
				</div>
				<?php
				$printRow = true;
				$pinchoCount = 0;
				if (getAllPinchos() != NULL) {
					foreach (getAllPinchos() as $pincho) {
						if (isset($_SESSION["user"])) {
							if (isProbado($pincho->getIdnombre(), $_SESSION["user"]->getIdemail())) {
								$probado = $l["view_list_eaten"];
							} else {
								$probado = $l["view_list_not_eaten"];
							}
						} else {
							$probado = $l["view_list_eaten_not_logged"];
						}
						if($printRow){
							echo "<div class='row'>";
						}
						?>


						<div class="col-md-3 col-sm-6 col-xs-6 pincho-info-list">
							<div class="team-member">
								<a href='viewPincho.php?id=<?= $pincho->getIdnombre() ?> '>
									<div class="member-image pincho-image">
										<?php
										if ($pincho->getRutaimagen() == "")
											echo "<img class='pincho-info-image' src='../images/pinchos/default.jpg' alt=''>";
										else{
											echo "<img class='pincho-info-image' src='../".$pincho->getRutaimagen()."' alt=''>"; 
										}
										?>
									</div>
								</a>
								<?php
								if (isset($_SESSION["user"]) && get_class($_SESSION["user"]) == "JuradoPopular") {
									?>
									<form id="form-<?= md5($pincho->getIdnombre()) ?>" action="../controller/pw.php?controller=user&action=pinchoConsumed" method="POST">
										<input type="hidden" value="<?= $pincho->getIdnombre() ?>" name="markeatenpincho_probado_idpincho" />
										<input type="hidden" value="<?= $_SESSION["user"]->getIdemail() ?>" name="markeatenpincho_probado_idemail" />
										<a onclick="document.getElementById('form-<?= md5($pincho->getIdnombre()) ?>').submit();"><div class='btn-probar-pincho'><?= $probado ?></div></a>
									</form>
									<?php
									echo "<a href='./view_votacionpopular.php?idpincho=" . $pincho->getIdnombre() . "'><div class='btn-votar-pincho'>" . $l["view_list_vote"] . "</div></a>";
								}
								?>
								<div class="pincho-info">
									<h4><?= $pincho->getIdnombre() ?></h4>
									<span><?= $pincho->getDescripcion() ?></span>
								</div>

							</div>
						</div>
						<?php

						if($printRow){
							$printRow = false;
						}

						$pinchoCount++;
						if($pinchoCount % 4 == 0){
							echo "</div>";
							$printRow = true;
						}
					}
					if($pinchoCount % 4 != 0){
						echo "</div>";

					}
				}
				?>
			</div>
		</div>
	</section>
	<!-- /PINCHOS -->


	<!-- STATS -->
	<section id="stats">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1><?= $l["main_stats"]?></h1>
						<h5><?= $l["main_stats_desc"]?></h5>
						<span class="st-border"></span>
						<div class="container">
							<div class="col-md-6 col-sm-12 col-xs-12 piechart">
								<div id="chartdiv"></div>
								<h3 class="chart-text"><?= $l["statistics_chart_text"]?></h3>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">

								<ul class="list-group stats-list">
									<li class="list-group-item">
										<span class="badge"><?= $concurso->getNumberOfUsers() ?></span>
										<?= $l["statistics_number_users"]?>
									</li>
									<li class="list-group-item">
										<span class="badge"><?= $concurso->getNumberOfPinchos() ?></span>
										<?= $l["statistics_number_pinchos"]?>
									</li>
									<li class="list-group-item">
										<span class="badge"><?= $concurso->getNumberOfComments() ?></span>
										<?= $l["statistics_number_comments"]?>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /STATS -->

	<!-- GASTROMAPA -->
	<section id="gastromapa">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1><?= $l["header_gastromapa"]?></h1>
						<h5><?= $l["gastromapa_desc"]?></h5>
						<span class="st-border"></span>
						<?php
						if(isset($establecimientos)){
							echo '<div id="gastromapa-map"></div>';
						}else{
							echo '<br><br><h1> Aún no hay establecimientos! </h1>';
						}
						?>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- /GASTROMAPA -->


	<!-- ABOUT -->
	<section id="about">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1><?= $l["main_about"]?><img class="logo-about" src="../images/logo.png" alt=""></h1>
						<h5><?= $l["main_about_desc"]?></h5>
						<span class="st-border"></span>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="st-pricing text-center">
						<h3><?= $l["main_about_type_jurado_popular"]?></h3>
						<h5><?= $l["main_about_type_jurado_popular_desc"]?></h5>
						<div class="st-border"></div>
						<ul>
							<li><?= $l["main_about_type_jurado_popular_1"]?></li>
							<li><?= $l["main_about_type_jurado_popular_2"]?></li>
							<li><?= $l["main_about_type_jurado_popular_3"]?></li>
						</ul>
						<?php if(!isset($_SESSION["user"])){
							?>
							<a href="./register.php" class="btn btn-send"><?= $l["app_signup"] ?></a>
							<?php
						}
						?>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="st-pricing text-center">
						<h3><?= $l["main_about_type_jurado_profesional"]?></h3>
						<h5><?= $l["main_about_type_jurado_profesional_desc"]?></h5>
						<div class="st-border"></div>
						<ul>
							<li><?= $l["main_about_type_jurado_profesional_1"]?></li>
							<li><?= $l["main_about_type_jurado_profesional_2"]?></li>
							<li><?= $l["main_about_type_jurado_profesional_3"]?></li>
							<li><?= $l["main_about_type_jurado_profesional_4"]?></li>
							<li><?= $l["main_about_type_jurado_profesional_5"]?></li>
						</ul>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="st-pricing text-center">
						<h3><?= $l["main_about_type_establecimiento"]?></h3>
						<h5><?= $l["main_about_type_establecimiento_desc"]?></h5>
						<div class="st-border"></div>
						<ul>
							<li><?= $l["main_about_type_establecimiento_1"]?></li>
							<li><?= $l["main_about_type_establecimiento_2"]?></li>
							<li><?= $l["main_about_type_establecimiento_3"]?></li>
							<li><?= $l["main_about_type_establecimiento_4"]?></li>
						</ul>
						<?php if(!isset($_SESSION["user"])){
							?>
							<a href="./register.php" class="btn btn-send"><?= $l["app_signup"] ?></a>
							<?php
						}
						?>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- /ABOUT -->


	<!-- EQUIPO -->
	<section id="equipo">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1><?= $l["main_team"]?></h1>
						<h5><?= $l["main_team_desc"]?></h5>
						<span class="st-border"></span>
					</div>
				</div>

				<div class="col-md-3 col-sm-6  col-xs-6">
					<div class="team-member">
						<div class="member-image">
							<img class="img-responsive" src="../images/members/andres.png" alt="">
							<div class="member-social">
								<a target="_blank" href="https://www.facebook.com/ndrs1992"><i class="fa fa-facebook"></i></a>
								<a target="_blank" href="https://twitter.com/ndrs_"><i class="fa fa-twitter"></i></a>
								<a target="_blank" href="https://github.com/ndrs92"><i class="fa fa-github"></i></a>
								<a target="_blank" href="https://bitbucket.org/ndrs92/"><i class="fa fa-bitbucket"></i></a>
								<a target="_blank" href="https://bitbucket.org/ndrs92/"><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
						<div class="member-info">
							<h4>Andrés Vieira</h4>
							<p class="dev-role"><?= $l["main_team_role1"]?></p>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-6  col-xs-6">
					<div class="team-member">
						<div class="member-image">
							<img class="img-responsive" src="../images/members/alex.png" alt="">
							<div class="member-social">
								<a target="_blank" href="https://bitbucket.org/agnovoa/"><i class="fa fa-bitbucket"></i></a>
								<a target="_blank" href="https://github.com/agnovoa2"><i class="fa fa-github"></i></a>
							</div>
						</div>
						<div class="member-info">
							<h4>Alejandro Gutiérrez</h4>
							<p class="dev-role"><?= $l["main_team_role2"]?></p>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-6  col-xs-6">
					<div class="team-member">
						<div class="member-image">
							<img class="img-responsive" src="../images/members/javi.png" alt="">
							<div class="member-social">
								<a target="_blank" href="https://bitbucket.org/lazajavier/"><i class="fa fa-bitbucket"></i></a>
								<a target="_blank" href="https://github.com/lazajavier"><i class="fa fa-github"></i></a>
							</div>
						</div>
						<div class="member-info">
							<h4>Javier Villalobos</h4>
							<p class="dev-role"><?= $l["main_team_role3"]?></p>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-6  col-xs-6">
					<div class="team-member">
						<div class="member-image">
							<img class="img-responsive" src="../images/members/diego.png" alt="">
							<div class="member-social">
								<a target="_blank" href="https://twitter.com/DiegoV2_"><i class="fa fa-twitter"></i></a>
								<a target="_blank" href="https://github.com/dvillanuevavilar"><i class="fa fa-github"></i></a>
							</div>
						</div>
						<div class="member-info">
							<h4>Diego Villanueva</h4>
							<p class="dev-role"><?= $l["main_team_role4"]?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /EQUIPO -->

	<!-- TESTIMONIAL -->
	<section id="testimonial" style="background-image: url('../<?= $rutaPortada ?>')">
		<div class="container">
			<div class="row">
				<div class="overlay"></div>
				<div class="col-md-8 col-md-offset-2 col-sm-12">
					<div class="st-testimonials">

						<div class="item active text-center">
							<p>"De los proyectos más avanzados de clase"</p>
							<div class="st-border"></div>
							<div class="client-info">
								<h5>Anália García Lourenço</h5>
								<span>Profesora de ABP</span>
							</div>
						</div>

						<div class="item text-center">
							<p>"Sígueme en twitter"</p>
							<div class="st-border"></div>
							<div class="client-info">
								<h5>Pedro Cuesta</h5>
								<span>Profesor de ABP</span>
							</div>
						</div>

						<div class="item text-center">
							<p>"11/10"</p>
							<div class="st-border"></div>
							<div class="client-info">
								<h5>IGN</h5>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /TESTIMONIAL -->


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
	<script type="text/javascript"><?php include_once "../js/chart-setup-php.js"; ?></script><!-- Chart -->
	<script type="text/javascript"><?php include_once "../js/mainpage-maps-setup-php.js"; ?></script><!-- Gastromapa -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApOBPY5dso4qlFcJUfiwwALFGBmdlWPGo&callback=initMap" async defer></script>

	<?php include_once "../resources/code/alertify.php"; ?>

</body>
</html>