<?php
include_once "../resources/code/models.php";
include_once "../resources/code/lang_coverage.php";

include_once "../controller/pincho_controller.php";

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
							<a href="list.php"><div class="back-button"></div></a><h1><?= $l["register_title"] ?></h1>
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
									<form data-toggle="validator" role="form" action="../controller/pw.php?type=juradopopular&controller=user&action=register" method="POST" enctype="multipart/form-data">
										<div class="form-group">
											<label for="name"><?= $l["register_name"] ?></label>
											<input data-error="<?= $l["register_name_error"] ?>" required data-minlength="4" type="text" class="form-control" name="nombre">
											<div class="help-block with-errors"></div>
										</div>

										<div class="form-group">
											<label for="email"><?= $l["register_email"] ?></label>
											<input data-error="<?= $l["register_email_error"] ?>" required data-minlength="7" type="email" class="form-control" name="idemail">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="pwd"><?= $l["register_password"] ?></label>
											<input data-error="<?= $l["register_password_error_length"] ?>" required data-minlength="8" id="passToMatch" type="password" class="form-control" name="contrasena">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="pwd"><?= $l["register_passwordRepeat"] ?></label>
											<input data-error="<?= $l["register_password_error_match"] ?>" data-minlength="8" data-match="#passToMatch" required type="password" class="form-control" name="contrasena_verif">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="avatar"><?= $l["register_avatar"] ?></label>
											<input type="file" class="form-control" name="rutaavatar">
										</div>
										<input class="btn btn-success" type="submit" value="<?= $l["register_createUser"] ?>" />
									</form>
								</div>
								<div id="pane2" class="tab-pane">
									<form data-toggle="validator" role="form" action="../controller/pw.php?type=establishment&controller=user&action=register" method="POST" enctype="multipart/form-data">
										<div class="form-group">
											<label for="name"><?= $l["register_name"] ?></label>
											<input required data-error="<?= $l["register_name_error"] ?>" required data-minlength="4" type="text" class="form-control" name="nombre">
											<div class="help-block with-errors"></div>
										</div>

										<div class="form-group">
											<label for="email"><?= $l["register_email"] ?></label>
											<input required data-error="<?= $l["register_email_error"] ?>" required data-minlength="7" type="email" class="form-control" name="idemail">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="direction"><?= $l["register_adress"] ?></label>
											<input required data-error="<?= $l["register_address_error"] ?>" required data-minlength="8" type="text" class="form-control" name="direccion">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="web"><?= $l["register_webPage"] ?></label>
											<input required type="url" data-error="<?= $l["register_webPage_error"] ?>" class="form-control" name="paginaweb">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="time"><?= $l["register_schedule"] ?></label>
											<input required type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9] - ([01]?[0-9]|2[0-3]):[0-5][0-9]" data-error="<?= $l["register_schedule_error"] ?>" class="form-control" name="horario">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="time"><?= $l["register_geoloc"] ?></label>
											<input required type="text" pattern="^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?), \s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$" data-error="<?= $l["register_geoloc_error"] ?>" class="form-control" name="coordenadas">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="pwd"><?= $l["register_password"] ?></label>
											<input required type="password" data-error="<?= $l["register_password_error_length"] ?>" required data-minlength="8" id="pass2ToMatch" class="form-control" name="contrasena">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="pwd"><?= $l["register_passwordRepeat"] ?></label>
											<input required type="password" data-error="<?= $l["register_password_error_match"] ?>" data-minlength="8" data-match="#pass2ToMatch" class="form-control" name="contrasena_verif">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="avatar"><?= $l["register_photo"] ?></label>
											<input type="file" class="form-control" name="foto" accept="image/*" />
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="avatar"><?= $l["register_logo"] ?></label>
											<input type="file" class="form-control" name="rutaavatar" accept="image/*" />
											<div class="help-block with-errors"></div>
										</div>
										<input class="btn btn-success" type="submit" value="<?= $l["register_createUser"] ?>" />
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