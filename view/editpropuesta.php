<?php
include_once __DIR__."/../resources/code/models.php";
include_once __DIR__."/../resources/code/lang_coverage.php";

if(!isset($_SESSION)) session_start();

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
        <a href="list.php"><div class="back-button"></div></a><h1><?= $l["view_editpropuesta_editpropuesta"] ?> </h1>
        <span class="st-border"></span>
      </div>
    </div>
    <?php
    $row = $_SESSION["user"]->havePropuesta();
    if(!empty($row) && $row["estadoPropuesta"] == 0){
     ?>
     <h1><?= $l["view_editpropuesta_titulo"] ?> </h1>
     <form class="form" action="../controller/pw.php?controller=competition&action=editPropuesta" method="POST" enctype="multipart/form-data">
       <div class="col-md-6 col-sm-12 col-xs-12">
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
     </div>
     <div class="col-md-6 col-sm-12 col-xs-12">
       <div class="form-group">
         <label for="image"><?= $l["view_editpropuesta_actual"] ?></label><br/>
         <img height="230px" src="../<?= $row['rutaimagen']; ?>" />
       </div>
       <div class="form-group">
         <label for="image"><?= $l["view_editpropuesta_introimagen"] ?></label>
         <input type='file' name='propuesta_imagen' class='form-control' accept='image/*'/>
       </div>
     </div>
     <input class="btn btn-default" type="hidden" name="imagen" value="<?= $row['rutaimagen']; ?>"/>
     <div class="col-md-12">
       <input class="btn btn-success" type="submit" name="editpropuesta_propuesta_enviar" value="<?= $l["view_editpropuesta_enviar"] ?>" />
     </div>
   </form>
   <?php 
 }else{
   echo $l["view_editpropuesta_exists"]."<br/>";
   echo "<a href='./list.php'>". $l["view_editpropuesta_return"] ."</a>";
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