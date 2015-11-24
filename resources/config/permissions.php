<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Permissions Error</title>
	
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
							<h1 class="perms-error">Permissions error</h1>
							<span class="st-border"></span>
							<h3>PinchoWire could not get the appropiated permissions to work in your system. Maybe you changed something?</h3>
							<h3>Here are some recommendations to make it work:</h3>
							<br/>
							<br/>
							<div class="panel panel-danger">
								<div class="panel-heading">
									<h3 class="panel-title">Fix directory owner</h3>
								</div>
								<div class="panel-body">
									If your web server is apache2, it is recommended that you set the webroot owner to the user www-data. To fix that, type in your terminal <b>as root</b>:<br/>
									<i>Change the route /foo/bar to your path of installation.</i>
									<div class="terminal">
										$: chown -R www-data:www-data /foo/bar
									</div>
								</div>
							</div>
							<br/>

							<div class="panel panel-danger">
								<div class="panel-heading">
									<h3 class="panel-title">Fix folder permissions</h3>
								</div>
								<div class="panel-body">
									You have to ensure that the webserver can write data to your installation folder. If you're using apache2, the previous fragment would have done it, but if it did not work, try:
									<i>Change the route /foo/bar to your path of installation.</i>
									<div class="terminal">
										$: chmod -R 777 /foo/bar
									</div>
								</div>
							</div>
							<br/>
							<a href="../../index.php" class="btn btn-danger btn-lg">Retry Installation</a>
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

	</body>
	</html>