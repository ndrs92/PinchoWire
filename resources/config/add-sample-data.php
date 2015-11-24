<?php
if(!isset($_SESSION)){
	session_start();
}

if(!isset($_SESSION["installation"])){
	header("Location: ../../view/403.php");
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Installation completed!</title>
	
	<!-- Main CSS file -->
	<link rel="stylesheet" href="../../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../../css/font-awesome.css" />
	<link rel="stylesheet" href="../../css/style.css" />
	<link rel="stylesheet" href="../../css/responsive.css" />
	<link rel="stylesheet" href="../../css/main.css" />

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

		<!-- STATS -->
		<section id="stats">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h1>Pincho Wire Installation</h1>
							<span class="st-border"></span>
							<h3>Installation is completed! You can now start using your application or initialize it with some sample data. Choose wisely.</h3>
							<br/>
							<br/>
							<div class="row">
								<div class="col-md-2 hidden-sm hidden-xs"></div>
								<div class="col-md-8 col-sm-12 col-xs-12">
									<div class="panel panel-primary">
										<div class="panel-heading">
											<h3 class="panel-title">Initialize sample data?</h3>
										</div>
										<div class="panel-body">
											<div class="col-md-12">
												<a href="raw-data.php" class="btn btn-success btn-lg">Add sample data</a>
												<a href="../../index.php" class="btn btn-primary btn-lg">Continue without data</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-2 hidden-sm hidden-xs"></div>
							</div>
							

						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- /STATS -->

		<!-- FOOTER -->
		<footer id="footer">
			<div class="container">
				<div class="row">
					<!-- SOCIAL ICONS -->
					<div class="col-sm-6 col-sm-push-6 footer-social-icons">
					</div>
					<!-- /SOCIAL ICONS -->
					<div class="col-sm-6 col-sm-pull-6 copyright">
						<p>&copy; Pincho Wire - ABP</p>
					</div>
				</div>
			</div>
		</footer>
		<!-- /FOOTER -->

		<!-- Scroll-up -->
		<div class="scroll-up">
			<ul><li><a href="#header"><i class="fa fa-angle-up"></i></a></li></ul>
		</div>


		<!-- JS -->
		<script type="text/javascript" src="../../js/jquery.min.js"></script><!-- jQuery -->
		<script type="text/javascript" src="../../js/bootstrap.min.js"></script><!-- Bootstrap -->
		<script type="text/javascript" src="../../js/jquery.parallax.js"></script><!-- Parallax -->
		<script type="text/javascript" src="../../js/smoothscroll.js"></script><!-- Smooth Scroll -->
		<script type="text/javascript" src="../../js/scripts.js"></script><!-- Smooth Scroll -->
		<script type="text/javascript" src="../../js/validator.min.js"></script><!-- Validator -->

	</body>
	</html>