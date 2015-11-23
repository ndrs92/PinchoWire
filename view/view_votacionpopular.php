<?php
include_once "../resources/code/models.php";
include_once "../resources/code/lang_coverage.php";

include_once "../controller/pincho_controller.php";



if(!isset($_SESSION)) session_start();
if(get_class($_SESSION["user"]) != "JuradoPopular"){
    header("Location: ../view/403.php");
    exit;
}

$pinchoActual = getCurrentPincho($_GET["idpincho"]);

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

    <title><?= $l["view_votacionpopular_tittle"]?></title>
    
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
                        <h1><?= $l["view_votacionpopular_titulo"] . $_GET["idpincho"]?> </h1>
                        <span class="st-border"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <img src="../images/pinchos/default.jpg" height="250px" />
                </div>
                <div class="col-md-12">
                    <h3><?= $l["view_votacionpopular_description"] . $pinchoActual->getIdnombre(); ?> </h3>
                    <h3><?= $l["view_votacionpopular_price"] . $pinchoActual->getPrecio(); ?>€</h3>
                    <h3><?= $l["view_votacionpopular_ingredients"] . $pinchoActual->getIngredientes(); ?> </h3>
                </div>
            </div>
        </div>
    </section>
    <!-- /PINCHOS -->


    <section id="stats">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h1><?= $l["view_votacionpopular_vote"] ?></h1>
                        <?php
                        if(isset($_SESSION["vote"]))
                        {
                            if($_SESSION["vote"] == "burned_code") {
                                echo "<h3>". $l["view_votacionpopular_burntCode"] ."</h3>";
                            }
                            if($_SESSION["vote"] == "repeated_code") {
                                echo "<h3>". $l["view_votacionpopular_repeatedPincho"] ."</h3>";
                            }
                            if($_SESSION["vote"] == "invalid_code") {
                                echo "<h3>". $l["view_votacionpopular_invalidCode"] ."</h3>";
                            }
                            if($_SESSION["vote"] == "incorrect_pincho_code") {
                                echo "<h3>". $l["view_votacionpopular_noPinchoCode"] ."</h3>";
                            }
                            unset($_SESSION["vote"]);
                        }
                        ?>
                        <span class="st-border"></span>
                    </div>
                </div>

                <div class="votacion-body">
                    <form role="form" action="../controller/votacionpopular_controller.php" method="POST">
                      <div class="form-group">
                          <label for="codigo1"><?= $l["view_votacionpopular_codigo1"] . $_GET["idpincho"] ?></label>
                          <input class="form-control" type="text" name="votacionpopular_codigo1" placeholder="<?= $l["view_votacionpopular_codigo1_placeholder"]?>"/>
                      </div>
                      <div class="form-group">
                        <label for="pwd"><?= $l["view_votacionpopular_codigo2"] ?></label>
                        <input class="form-control" type="text" name="votacionpopular_codigo2" placeholder="<?= $l["view_votacionpopular_codigo2_placeholder"] ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="pwd"><?= $l["view_votacionpopular_codigo3"] ?></label>
                        <input class="form-control" type="text" name="votacionpopular_codigo3" placeholder="<?= $l["view_votacionpopular_codigo3_placeholder"] ?>"/>
                    </div>
                    <?= "<input type=\"hidden\" name=\"votacionpopular_idpincho\" value=\"" . $_GET["idpincho"] ."\">"; ?>
                    <input type="submit" class="btn btn-success" name="enviarpropuesta_propuesta_enviar" value="<?= $l["view_votacionpopular_enviar"] ?>" />
                </form>
            </div><!-- votacion-body -->


        </div>
    </section>



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