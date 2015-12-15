<?php 
include_once "../resources/code/lang_coverage.php";
include_once "../resources/code/models.php";
include_once "../controller/pincho_controller.php";
include_once "../controller/pw.php";
include_once "../controller/pwctrl_user.php";
include_once "../controller/pwctrl_competition.php";

if(!isset($_SESSION)) session_start();
$concurso = CompetitionController::getConcurso();
if(get_class($_SESSION["user"])!="JuradoProfesional" || $concurso->getEstado() != 1){
    header("Location: 403.php");
    exit;
}
$pinchoList = $concurso->getFinalistas();
$pinchosVotados = $_SESSION["user"]->getPinchosVotadosDeFinalistas();

$toShow = array();



if(!empty($pinchoList) && empty($pinchosVotados)){

    $toShow = $pinchoList;
}
if(!empty($pinchoList) && !empty($pinchosVotados)){
    foreach ($pinchoList as $key => $asignado) {
    	$toAdd = true;
    	foreach ($pinchosVotados as $key2 => $votado) {
    		if($asignado["pincho_idnombre"]==$votado["pincho_idnombre"]){
    			$toAdd = false;
    		}		
    	}
    	if($toAdd){
    		$toShow[$asignado["pincho_idnombre"]] = $asignado;
        }
    }
}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $l["view_votacionprofesional_tittle"] ?></title>
    
    <!-- Main CSS file -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/owl.carousel.css" />
    <link rel="stylesheet" href="../css/magnific-popup.css" />
    <link rel="stylesheet" href="../css/font-awesome.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/responsive.css" />
    <link rel="stylesheet" href="../css/main.css" />

    
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
                        <h1><?= $l["view_votacionprofesional_header"] ?></h1>
                        <span class="st-border"></span>
                    </div>
                </div>
                

                <div class="admin-user-table">
                    <table class="table table-stripped firefix">
                        <thead>
                            <td><?= $l["view_pincho_name"] ?></td>
                            <td><?= $l["view_votacionprofesional_vote"] ?></td>
                            <td><?= $l["view_votacionprofesional_enviar"] ?></td>

                        </thead>
                        <tbody>
                            <?php

                            if (count($toShow) > 0) {
                            	
                                foreach ($toShow as $indexRow => $row) {
                                    echo "<tr>";
                                    echo "<form action='../controller/pw.php?controller=user&action=votacionProfesionalParaGanador' method='post'>";

                                    echo "<td><a href='viewPincho.php?id=".$row["pincho_idnombre"]."'>" . $row["pincho_idnombre"] . "</a></td>";
                                    echo "<input type='hidden' name='pincho' value='".$row["pincho_idnombre"]."'>";

                                    echo "<td>"; 
                                    
                                    echo "<label class='radio-inline'>";
                                    echo "<input type='radio' name='puntuacion' value='1'>1 ";
                                    echo "</label>";
                                    echo "<label class='radio-inline'>";
                                    echo "<input type='radio' name='puntuacion' value='2'>2 ";
                                    echo "</label>";
                                    echo "<label class='radio-inline'>";
                                    echo "<input type='radio' name='puntuacion' value='3'>3 ";
                                    echo "</label>";
                                    echo "<label class='radio-inline'>";
                                    echo "<input type='radio' name='puntuacion' value='4'>4 ";
                                    echo "</label>";
                                    echo "<label class='radio-inline'>";
                                    echo "<input type='radio' name='puntuacion' value='5'>5 ";
                                    echo "</label>";
                                    
                                    echo "</td>";
                                    
                                    echo "<td><button type='submit' class='btn btn-success'>". $l["view_votacionprofesional_enviar"] ."</button></td>";
                                    
                                    echo "</form>";
                                    echo "</tr>";
                                }

                            }
                            else{
                            	?>
                            	<td><?= $l["view_votacionprofesional_finish"] ?></td>
                            	<td><?= $l["view_votacionprofesional_finish"] ?></td>
                            	<td><?= $l["view_votacionprofesional_finish"] ?></td>
                            	<?php
                            }
                            ?>
                        </tbody>

                    </table>
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