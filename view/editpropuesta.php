<?php
include_once "../resources/code/lang_coverage.php";
include_once "../model/establecimiento.php";

session_start();

if(get_class($_SESSION["user"])!="Establecimiento"){
	header("Location: 403.php");
	exit;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?= $l["view_editpropuesta_editpropuesta"] ?> </title>

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
  						<h1><?= $l["view_editpropuesta_editpropuesta"] ?> </h1>
  						<span class="st-border"></span>
  					</div>
  				</div>
  				<?php
  				$row = $_SESSION["user"]->havePropuesta();
  				if(!empty($row) && $row["estadoPropuesta"] == 0){
  					?>
  					<h1><?= $l["view_editpropuesta_titulo"] ?> </h1>
  					<form class="form" action="../controller/editpropuesta_controller.php" method="POST">
  						<div class="form-group">
  							<label for="email"><?= $l["view_editpropuesta_intronombre"] ?></label>
  							<input class="form-control" type="text" name="editpropuesta_propuesta_nombre" value="<?= $row['idnombre']; ?>" />
  						</div>
  						<div class="form-group">
  							<label for="email"><?= $l["view_editpropuesta_introdescripcion"] ?></label>
  							<textarea class="form-control" name="editpropuesta_propuesta_descripcion" row="4" cols="50" ><?= $row['descripcion']; ?></textarea>
  						</div>
  						<div class="form-group">
  							<label for="email"><?= $l["view_editpropuesta_introingredientes"] ?></label>
  							<textarea class="form-control" name="editpropuesta_propuesta_ingredientes" row="4" cols="50" ><?= $row['ingredientes']; ?></textarea>
  						</div>
  						<div class="form-group">
  							<label for="email"><?= $l["view_editpropuesta_introprecio"] ?></label>
  							<input class="form-control" type="text" name="editpropuesta_propuesta_precio" value="<?= $row['precio']; ?>" />
  						</div>
  						<input class="btn btn-success" type="submit" name="editpropuesta_propuesta_enviar" value="<?= $l["view_editpropuesta_enviar"] ?>" />
  					</form>
  					<?php 
  				}else{
  					echo "No tiene una propuesta, por lo que no se puede editar o su propuesta ya ha sido validada<br/>";
  					echo "<a href='./list.php'>Volver a pagina principal</a>";
  				}
  				?>
  				
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


  </body>
  </html>