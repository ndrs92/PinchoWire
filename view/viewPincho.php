<?php
include_once "../resources/code/models.php";
include_once "../resources/code/lang_coverage.php";

include_once "../controller/pincho_controller.php";
include_once "../controller/pw.php";
include_once "../controller/pwctrl_user.php";



if(!isset($_SESSION)) session_start();
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
							<a href="list.php"><div class="back-button"></div></a><h1><?php echo $pinchoActual->getIdnombre(); ?></h1>
							<span class="st-border"></span>
						</div>
					</div>
					<div class="col-md-12">
						<?php
						if ($pinchoActual->getRutaimagen() == "")
							echo "<img class='img-responsive' src='../images/pinchos/default.jpg' alt=''>";
						else
							echo "<img class='img-responsive' src='../".$pinchoActual->getRutaimagen()."' alt=''>"; ?>

					</div>
					<div class="col-md-12">
						<h3><?= $l["view_pincho_description"] . $pinchoActual->getDescripcion(); ?> </h3>
						<h3><?= $l["view_pincho_price"] . $pinchoActual->getPrecio(); ?>€</h3>
						<h3><?= $l["view_pincho_ingredients"] . $pinchoActual->getIngredientes(); ?> </h3>
						<h3><?= $l["view_pincho_establishment"] ?>
							<?php
							echo "<a href=profile.php?idemail=".$establecimientoAsociado->getIdemail().">";
							echo $establecimientoAsociado->getNombre();
							echo "</a>";
							?>
						</h3>
						<h3><?= $l["view_pincho_score"].$pinchoActual->getPopularScore(); ?></h3>
						<?php if(isset($_SESSION["user"]) && get_class($_SESSION["user"]) == "JuradoPopular"){ ?>
						<a href='./view_votacionpopular.php?idpincho=<?= $pinchoActual->getIdnombre() ?>'><div class='btn btn-success'><?= $l["view_list_vote"] ?></div></a>
						<?php } ?>
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
							<h1><?= $l["view_pincho_comment"] ?></h1>
							<span class="st-border"></span>
						</div>
					</div>

					<div class="comments-body">

						<?php
						if(isset($_SESSION["user"]) && get_class($_SESSION["user"]) == "JuradoPopular"){
							?>
							<div class="row insert-comment">
								<div>
									<form role="form" action="../controller/pw.php?controller=user&action=addComment" method="POST">
										<input type="hidden" name="addcomment_comment_idpincho" value="<?php echo $pinchoActual->getIdnombre(); ?>"/>
										<div class="col-md-2"><h5><?= $l["view_pincho_insertComment"] ?></h5></div>
										<div class="col-md-6"><textarea class="form-control" rows="1" name="addcomment_comment_name" ></textarea></div>
										<br class="visible-xs visible-sm" />
										<div class="col-md-1"><input class="btn btn-success" type="submit" name="submit_button" value="<?= $l["view_pincho_sendComment"] ?>" /></div>

									</form>
								</div>
							</div>
							<?php
						}
						?>


						<?php
						if(getAllComentarios($pinchoActual) != NULL) {
							foreach (getAllComentarios($pinchoActual) as $comentario) {
								$rutaImagen = UserController::getUsuarioByID($comentario["juradopopular_idemail"])->getRutaavatar();
								?>


								<!-- Start comment -->
								<div class="row">
									<div class="single-comment">
										<div class="col-md-1 botonera-comment">
											<?php
											if (isset($_SESSION["user"]) && ((get_class($_SESSION["user"]) == "JuradoPopular" && $_SESSION["user"]->getIdemail() == $comentario["juradopopular_idemail"]) || get_class($_SESSION["user"]) == "Administrador")) {
												?>
												<form id="comment_<?= $comentario["idcomentario"] ?>" method="post" action="../controller/pw.php?controller=user&action=deleteComment">
													<input type="hidden" name="delcomment_comment_id" value="<?= $comentario["idcomentario"] ?>" />  
													<input type="hidden" name="delcomment_comment_idpincho" value="<?= $pinchoActual->getIdnombre() ?>" />  
													<a onclick="document.getElementById('comment_<?= $comentario["idcomentario"] ?>').submit();"><img class='delete-comment' src='../images/trash.png'/></a>
												</form>
												<?php
											}
											?>
										</div>
										<div class="col-md-1 comment-avatar" style="background-image: url(../<?= $rutaImagen ?>)"></div>
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