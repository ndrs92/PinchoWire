<?php
include_once "../controller/pincho_controller.php";
include_once "../resources/code/lang_coverage.php";
include_once "../model/juradopopular.php";
include_once "../model/juradoprofesional.php";
include_once "../model/establecimiento.php";
include_once "../model/administrador.php";

session_start();
$pinchoActual = getCurrentPincho($_GET["id"]);
$establecimientoAsociado = getCurrentEstablishment($pinchoActual);

if($pinchoActual->getIdnombre() == NULL){
	header("Location: 404.php");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo $pinchoActual->getIdnombre(); ?></title>
	
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


		<!-- PINCHOS -->
		<section id="pinchos">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h1><?php echo $pinchoActual->getIdnombre(); ?></h1>
							<span class="st-border"></span>
						</div>
					</div>
					<div class="col-md-12">
						<img src="../images/pinchos/default.jpg" height="250px" />
					</div>
					<div class="col-md-12">
						<h3> Descripción: <?php echo $pinchoActual->getIdnombre(); ?> </h3>
						<h3> Precio: <?php echo $pinchoActual->getPrecio(); ?>€</h3>
						<h3> Ingredientes: <?php echo $pinchoActual->getIngredientes(); ?> </h3>
						<h3> Establecimiento:
							<?php
							echo "<a href=profile.php?idemail=".$establecimientoAsociado->getIdemail().">";
							echo $establecimientoAsociado->getNombre();
							echo "</a>";
							?>
						</h3>
					</div>
				</div>
			</div>
		</section>
		<!-- /PINCHOS -->


		<!-- COMMENTS -->
		<section id="stats">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h1>Comentarios</h1>
							<span class="st-border"></span>
						</div>
					</div>

					<div class="comments-body">

						<?php
						if($_SESSION && get_class($_SESSION["user"]) == "JuradoPopular"){
							?>
							<div class="row insert-comment">
								<div>
									<form role="form" action="../controller/addcomment_controller.php" method="POST">
										<input type="hidden" name="addcomment_comment_idpincho" value="<?php echo $pinchoActual->getIdnombre(); ?>"/>
										<div class="col-md-2"><h5>Insertar comentario:</h5></div>
										<div class="col-md-6"><textarea class="form-control" rows="1" name="addcomment_comment_name" ></textarea></div>
										<br class="visible-xs visible-sm" />
										<div class="col-md-1"><input class="btn btn-success" type="submit" name="submit_button" value="Enviar Comentario" /></div>

									</form>
								</div>
							</div>
							<?php
						}
						?>


						<?php
						if(getAllComentarios($pinchoActual) != NULL) {
							foreach (getAllComentarios($pinchoActual) as $comentario) {
								?>

								<!-- Start comment -->
								<div class="row">
									<div class="single-comment">
										<div class="col-md-1 botonera-comment">
											<?php
											if ($_SESSION && get_class($_SESSION["user"]) == "JuradoPopular" && $_SESSION["user"]->getIdemail() == $comentario["juradopopular_idemail"]) {
												?>
												<form id="comment_<?= $comentario["idcomentario"] ?>" method="post" action="../controller/eliminarcomentario_controller.php">
													<input type="hidden" name="delcomment_comment_id" value="<?= $comentario["idcomentario"] ?>" />  
													<input type="hidden" name="delcomment_comment_idpincho" value="<?= $pinchoActual->getIdnombre() ?>" />  
													<a onclick="document.getElementById('comment_<?= $comentario["idcomentario"] ?>').submit();"><img class='delete-comment' src='../images/trash.png'/></a>
												</form>
												<?php
											}
											?>
										</div>
										<div class="col-md-1">
											<img height="56px"src="../images/avatars/defect" />
										</div>
										<div class="col-md-8">
											<div class="panel panel-default">
												<div class="panel-body">
													<div class="comment-content"><p><?= $comentario["contenido"] ?> </p></div>
													<div class="comment-date"><?= $comentario["fecha"] ?></div>
												</div>
											</div>
										</div>
										<div class="col-md-2" />
									</div>
								</div>
							</div>
							<!-- End comment -->



							<?php
						}
					}
					?>

				</div><!-- comments-body -->


			</div>
		</section>
		<!-- /COMMENTS -->


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


	</body>
	</html>