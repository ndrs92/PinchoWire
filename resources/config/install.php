<?php
error_reporting(0);
ini_set('display_errors', 0);

include_once "../../model/concurso.php";
include_once "../../controller/pw.php";
include_once "../../controller/pwctrl_competition.php";

$continue = false;

try{
	$concurso = CompetitionController::getConcurso();
}catch(Exception $e){
	$continue = true;
}

if(!$continue){
	header("Location: ../../view/403.php");
	exit();
}

if(!isset($_SESSION)){
	session_start();
}

$_SESSION["installation"] = true;

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Installation</title>
	
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
		<section id="install-page">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
						<img class="install-logo" src="../../images/logo.png" />
							<h1>Installation</h1>
							<span class="st-border"></span>
							<h3>Welcome to the installation wizard</h3>
							<p>It takes just a minute to be set up in Pincho Wire. Don't worry about not inserting everything, you can manage your information later.</p>
							<br/>
							<form action="./bd-install.php" method="POST" data-toggle="validator" class="form-horizontal">
								<fieldset>
									<legend>Configuration data</legend>

									<div class="form-group">
										<label for="host" class="col-lg-2 control-label">Server hostname:</label>
										<div class="col-lg-10">
											<input required data-error="Input a valid host" pattern="^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" type="text" class="form-control" name="database-host" placeholder="127.0.0.1" value="127.0.0.1">
											<div class="help-block with-errors"></div>
										</div>
									</div>

									<div class="form-group">
										<label for="databaseUser" class="col-lg-2 control-label">Database user:</label>
										<div class="col-lg-10">
											<input required type="text" class="form-control" name="database-user" placeholder="root" value="root">
											<div class="help-block with-errors"></div>
										</div>
									</div>

									<div class="form-group">
										<label for="databasePassword" class="col-lg-2 control-label">Database password:</label>
										<div class="col-lg-10">
											<input required type="password" class="form-control" name="database-password">
											<div class="help-block with-errors"></div>
										</div>
									</div>

									<div class="form-group">
										<label for="pwAdminEmail" class="col-lg-2 control-label">Admin email:</label>
										<div class="col-lg-10">
											<input required type="email" class="form-control" name="admin-idemail" placeholder="Pincho Wire Admin Email">
											<div class="help-block with-errors"></div>
										</div>
									</div>

									<div class="form-group">
										<label for="pwAdminPassword" class="col-lg-2 control-label">Admin Password:</label>
										<div class="col-lg-10">
											<input required type="password" class="form-control" name="admin-password">
											<div class="help-block with-errors"></div>
										</div>
									</div>

								</fieldset>
								<fieldset>
									<legend>Competition Information</legend>

									<div class="form-group">
										<label for="pwName" class="col-lg-2 control-label">Competition name:</label>
										<div class="col-lg-10">
											<input required type="text" data-minlength="3" maxlength="50" class="form-control" name="pw-name" placeholder="My fancy competition">
											<div class="help-block with-errors"></div>
										</div>
									</div>

									<div class="form-group">
										<label for="pwDesc" class="col-lg-2 control-label">Description:</label>
										<div class="col-lg-10">
											<input required type="text" data-minlength="8" maxlength="500" class="form-control" name="pw-desc" placeholder="Description for the competition">
											<div class="help-block with-errors"></div>
										</div>
									</div>


									<div class="form-group">
										<label for="pwFacebook" class="col-lg-2 control-label">Facebook</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="pw-facebook" placeholder="Facebook page">
											<div class="help-block with-errors"></div>
										</div>
									</div>

									<div class="form-group">
										<label for="pwTwitter" class="col-lg-2 control-label">Twitter:</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="pw-twitter" placeholder="Twitter user">
											<div class="help-block with-errors"></div>
										</div>
									</div>

									<div class="form-group">
										<label for="pwGooglePlus" class="col-lg-2 control-label">Google +:</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="pw-google-plus" placeholder="Google + page">
											<div class="help-block with-errors"></div>
										</div>
									</div>


								</fieldset>
								<button type="submit" name="submit-install" class="btn btn-success">Install Pincho Wire</button>
							</form>

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

	<?php
	error_reporting(1);
	ini_set('display_errors', 1);
	?>