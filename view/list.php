<?php
include_once "../controller/pincho_controller.php";
include_once "../resources/code/lang_coverage.php";
include_once "../model/juradopopular.php";
include_once "../model/juradoprofesional.php";
include_once "../model/establecimiento.php";
include_once "../model/administrador.php";
include_once "../model/concurso.php";

session_start();
$concurso = new Concurso();
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


		<!-- SLIDER -->
		<section id="slider">
			<div id="home-carousel" class="carousel slide" data-ride="carousel">			
				<div class="carousel-inner">
					<div class="item active" style="background-image: url(../images/title.jpg)">
						<div class="carousel-caption container">
							<div class="row">
								<div class="col-sm-7">
									<h2><?= $l["appname"] ?></h2>
									<p><?= $l["app_description"]?></p><br>
									<?php if(!isset($_SESSION["user"])){
										?>
										<a href="./register.php" class="btn btn-lg btn-send"><?= $l["app_signup"]?></a>
										<?php
									}
									?>
								</div>
							</div>
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
							<h1><?= $l["main_lista_pinchos"]?></h1>
							<span class="st-border"></span>
						</div>
					</div>
					<?php
					if (getAllPinchos() != NULL) {
						foreach (getAllPinchos() as $pincho) {

							if(isset($_SESSION["user"])){
								if(isProbado($pincho->getIdnombre(),$_SESSION["user"]->getIdemail())){
									$probado = $l["view_list_eaten"];
								}
								else{
									$probado = $l["view_list_not_eaten"];
								}
							}else{
								$probado = $l["view_list_eaten_not_logged"];
							}
							?>

							<div class="col-md-3 col-sm-6">
								<div class="team-member">
									<a href='viewPincho.php?id=<?= $pincho->getIdnombre() ?> '>
										<div class="member-image pincho-image">
											<img class="img-responsive" src="../images/pinchos/default.jpg" alt="">
										</div>
									</a>
									<?php
									if(isset($_SESSION["user"]) && get_class($_SESSION["user"]) == "JuradoPopular"){
										echo "<a href='../controller/markeatenpincho_controller.php?markeatenpincho_probado_idpincho=". $pincho->getIdnombre() . "&markeatenpincho_probado_idmail=" . $_SESSION["user"]->getIdemail() . "'><div class='btn-probar-pincho'>" . $probado . "</div></a>";
										echo "<a href='./view_votacionpopular.php?idpincho=". $pincho->getIdnombre() . "'><div class='btn-votar-pincho'>" . $l["view_list_vote"] . "</div></a>";

									}
									?>
									<div class="pincho-info">
										<h4><?= $pincho->getIdnombre() ?></h4>
										<span><?= $pincho->getDescripcion() ?></span>
									</div>
									<hr class="visible-xs" />
								</div>
							</div>
							<?php
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
							<span class="st-border"></span>

							<div id="chartdiv"></div>

						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- /STATS -->


		<!-- ABOUT -->
		<section id="about">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h1><?= $l["main_about"]?></h1>
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
							<span class="st-border"></span>
						</div>
					</div>

					<div class="col-md-3 col-sm-6">
						<div class="team-member">
							<div class="member-image">
								<img class="img-responsive" src="../images/members/team1.jpg" alt="">
								<div class="member-social">
									<a href=""><i class="fa fa-facebook"></i></a>
									<a href=""><i class="fa fa-twitter"></i></a>
									<a href=""><i class="fa fa-google-plus"></i></a>
									<a href=""><i class="fa fa-linkedin"></i></a>
								</div>
							</div>
							<div class="member-info">
								<h4>Andrés Vieira</h4>
								<span><?= $l["main_team_role1"]?></span>
							</div>
						</div>
					</div>

					<div class="col-md-3 col-sm-6">
						<div class="team-member">
							<div class="member-image">
								<img class="img-responsive" src="../images/members/team2.jpg" alt="">
								<div class="member-social">
									<a href=""><i class="fa fa-facebook"></i></a>
									<a href=""><i class="fa fa-twitter"></i></a>
									<a href=""><i class="fa fa-google-plus"></i></a>
									<a href=""><i class="fa fa-linkedin"></i></a>
								</div>
							</div>
							<div class="member-info">
								<h4>Alejandro Gutiérrez</h4>
								<span><?= $l["main_team_role2"]?></span>
							</div>
						</div>
					</div>

					<div class="col-md-3 col-sm-6">
						<div class="team-member">
							<div class="member-image">
								<img class="img-responsive" src="../images/members/team1.jpg" alt="">
								<div class="member-social">
									<a href=""><i class="fa fa-facebook"></i></a>
									<a href=""><i class="fa fa-twitter"></i></a>
									<a href=""><i class="fa fa-google-plus"></i></a>
									<a href=""><i class="fa fa-linkedin"></i></a>
								</div>
							</div>
							<div class="member-info">
								<h4>Javier Villalobos</h4>
								<span><?= $l["main_team_role3"]?></span>
							</div>
						</div>
					</div>

					<div class="col-md-3 col-sm-6">
						<div class="team-member">
							<div class="member-image">
								<img class="img-responsive" src="../images/members/team2.jpg" alt="">
								<div class="member-social">
									<a href=""><i class="fa fa-facebook"></i></a>
									<a href=""><i class="fa fa-twitter"></i></a>
									<a href=""><i class="fa fa-google-plus"></i></a>
									<a href=""><i class="fa fa-linkedin"></i></a>
								</div>
							</div>
							<div class="member-info">
								<h4>Diego Villanueva</h4>
								<span><?= $l["main_team_role4"]?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /EQUIPO -->

		<!-- TESTIMONIAL -->
		<section id="testimonial">
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
		<script src="../js/amcharts.js"></script>
		<script src="../js/pie.js"></script>
		<script src="../js/light.js"></script>
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
		<script type="text/javascript" src="../js/main.js"></script><!-- PinchoWire Scripts -->
		<script type="text/javascript">
			var chart = AmCharts.makeChart( "chartdiv", {
				"type": "pie",
				"theme": "light",
				"dataProvider": [ {
					"campo": "Usuarios",
					"cantidad": <?= $concurso->getNumberOfUsers() ?>
				}, {
					"campo": "Pinchos",
					"cantidad": <?= $concurso->getNumberOfPinchos() ?>
				}, {
					"campo": "Establecimientos",
					"cantidad": <?= $concurso->getNumberOfEstablecimientos() ?>
				}, {
					"campo": "Votos Populares",
					"cantidad": <?= $concurso->getNumberOfVotosPopulares() ?>
				}, {
					"campo": "Comentarios",
					"cantidad": <?= $concurso->getNumberOfComments() ?>
				} ],
				"valueField": "cantidad",
				"titleField": "campo",
				"balloon":{
					"fixedPosition":false
				},
				"export": {
					"enabled": false
				}
			} );
		</script><!-- Chart -->


	</body>
	</html>