<?php
include_once "../resources/code/models.php";
include_once "../resources/code/lang_coverage.php";

include_once "../controller/pincho_controller.php";
include_once "../controller/general_user_controller.php";

if(!isset($_SESSION)) session_start();
if(get_class($_SESSION["user"])!="Administrador"){
    header("Location: 403.php");
    exit;
}
$pinchoList = Pincho::getAllPinchos();
$juradoList = Usuario::getAllJuradoProfesional();



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administración de Propuestas</title>
    
    <!-- Main CSS file -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/owl.carousel.css" />
    <link rel="stylesheet" href="../css/magnific-popup.css" />
    <link rel="stylesheet" href="../css/font-awesome.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/responsive.css" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/alertify.default.css" />
    <link rel="stylesheet" href="../css/alertify.core.css" />
    
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
                        <h1><?= $l["view_admin_assignPincho"] ?></h1>
                        <span class="st-border"></span>
                    </div>
                </div>
                

                <div class="admin-user-table">
                    <table class="table table-stripped">
                        <thead>
                            <td><?= $l["view_admin_name"] ?></td>
                            <td><?= $l["view_admin_jury"] ?></td>
                            <td><?= $l["view_admin_assign"] ?></td>

                        </thead>
                        <tbody>
                            <?php
                            if (isset($pinchoList)) {
                                foreach ($pinchoList as $indexRow => $row) {
                                    $boton = false;
                                    $test = false;
                                    echo "<tr>";
                                    echo "<form action='../controller/assignpinchoadmin_controller.php' method='post'>";

                                    echo "<td><a href='viewPincho.php?id=".$row->getIdnombre()."'>" . $row->getIdnombre() . "</a></td>";
                                    echo "<input type='hidden' name='pincho' value='".$row->getIdnombre()."'>";
                                    echo "<td>";
                                        echo "<select class = 'form-control' id = 'asignar' name = 'asignar'>";
                                            foreach ($juradoList as $indexRow => $fila){
                                                
                                                $var = Usuario::isAssignedPinchoJuradoProfesional( $fila->getIdemail(), $row->getIdnombre());
                                                if(!$var){
                                                    echo "<option>".$fila->getIdemail()."</option>";
                                                    $test = true;
                                                    $boton = true;
                                                }
                                                
                                            }
                                            if(!$test){
                                                    echo "<option>". $l["view_admin_noJuries"] ."</option>";
                                                } 
                                        echo "</select>";
                                    echo "</td>";
                                    if($boton){
                                        echo "<td><button type='submit' class='btn btn-success'>". $l["view_admin_assign"] ."</button></td>";
                                    }
                                    else{
                                        echo "<td><button type='submit' class='btn btn-success' disabled>". $l["view_admin_assign"] ."</button></td>";
                                    }
                                    echo "</form>";
                                echo "</tr>";
                                }

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
<script type="text/javascript" src="../js/alertify.min.js"></script><!-- Alertify -->
<script type="text/javascript" src="../js/alertify.min.js"></script><!-- Alertify -->

</body>
</html>