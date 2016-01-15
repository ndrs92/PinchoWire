<?php
include_once __DIR__."/../resources/code/models.php";
include_once __DIR__."/../resources/code/lang_coverage.php";
include_once __DIR__."/../controller/pincho_controller.php";




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
                        <a href="list.php"><div class="back-button"></div></a><h1><?= $l["view_establishment_codes_myCodes"] ?></h1>
                        <span class="st-border"></span>
                        <h3><?= $l["view_establishment_codes_pincho"].$pinchoTarget->getIdnombre(); ?></h3>
                    </div>
                </div>

                <h4><?= $l["view_establishment_codes_generateTitle"] ?></h4>
                <div class="row">
                    <div class="col-md-3">
                        <?= $l["view_establishment_codes_numgenerate"]; ?>
                    </div>
                    <form action="../controller/pw.php?controller=competition&action=generateCodes" method="POST">
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
                    <table class="table table-striped firefix">
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
                    <table class="table table-striped firefix">
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