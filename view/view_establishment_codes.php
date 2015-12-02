<?php
include_once "../resources/code/models.php";
include_once "../resources/code/lang_coverage.php";
include_once "../controller/pincho_controller.php";




if(!isset($_SESSION)) session_start();


if(get_class($_SESSION["user"])!="Establecimiento"){
    header("Location: 403.php");
    exit;
}


$pinchoTarget = $_SESSION["user"]->getAssociatedPincho();

$availableCodes = $pinchoTarget->getAvailableCodes();
$retrievedCodes = $pinchoTarget->getRetrievedCodes();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $l["view_establishment_codes_myCodes"] ?></title>
    
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
                        <h1><?= $l["view_establishment_codes_myCodes"] ?></h1>
                        <span class="st-border"></span>
                        <h3><?= $l["view_establishment_codes_pincho"].$pinchoTarget->getIdnombre(); ?></h3>
                    </div>
                </div>

                <h4><?= $l["view_establishment_codes_generateTitle"] ?></h4>
                <div class="row">
                    <div class="col-md-3">
                        <?= $l["view_establishment_codes_numgenerate"]; ?>
                    </div>
                    <form action="../controller/code_generator_controller.php" method="POST">
                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="form-control" name="numCodes">
                                    <option "selected" value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" name="idnombre" value="<?= $pinchoTarget->getIdnombre(); ?>"/>
                            <input class="btn btn-success" type="submit" name="profile_user_submit" value="<?= $l["view_establishment_codes_generate"] ?>"/>
                        </div>
                    </form>
                </div>

                <h4><?= $l["view_establishment_codes_unretrieved"] ?></h4>
                <div class="admin-user-table">
                    <table class="table table-striped">
                        <thead>
                            <td><?= $l["view_establishment_codes_code"] ?></td>
                        </thead>
                        <tbody>
                            <?php
                            if(isset($availableCodes)) {
                                foreach ($availableCodes as $fila) {
                                    echo "<tr>";
                                    echo "<td>" . $fila["idcodigo"] . "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>

                        </tbody>

                    </table>

                </div>
                <h4><?= $l["view_establishment_codes_burnt"] ?></h4>
                <div class="admin-user-table">
                    <table class="table table-striped">
                        <thead>
                            <td><?= $l["view_establishment_codes_code"] ?></td>
                            <td><?= $l["view_establishment_codes_user"] ?></td>
                        </thead>
                        <tbody>

                            <?php
                            if(isset($retrievedCodes)){

                                foreach($retrievedCodes as $fila){
                                    echo "<tr>";
                                    echo "<td>".$fila["codigo_idcodigo"]."</td>";
                                    echo "<td>".$fila["juradopopular_idemail"]."</td>";
                                    echo "</tr>";
                                }

                            }else{
                                echo "No hay codigos canjeados";
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
    <script type="text/javascript" src="../js/alertify.min.js"></script><!-- Alertify -->

</body>
</html>