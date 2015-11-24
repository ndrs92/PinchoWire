<?php
include_once "../resources/code/models.php";
include_once "../resources/code/lang_coverage.php";

include_once "../controller/pincho_controller.php";
include_once "../controller/general_user_controller.php";
include_once "../controller/concurso_controller.php";

if (!isset($_SESSION)) session_start();
if (get_class($_SESSION["user"]) != "Administrador") {
    header("Location: 403.php");
    exit;
}
$pinchoList = Pincho::getAllPropuestas();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administración de la información del Concurso</title>

    <!-- Main CSS file -->
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/owl.carousel.css"/>
    <link rel="stylesheet" href="../css/magnific-popup.css"/>
    <link rel="stylesheet" href="../css/font-awesome.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/responsive.css"/>
    <link rel="stylesheet" href="../css/main.css"/>


    <!-- Favicon -->
    <link rel="shortcut icon" href="../../images/icon/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="../../images/icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="../../images/icon/apple-touch-icon-114-precomposed.png">
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
                    <h1><?= $l["view_admin_infoManage"] ?></h1>
                    <span class="st-border"></span>
                </div>
            </div>
            <?php
            $concurso = new Concurso();
            ?>
            <div class="admin-user-table">
                <form data-toggle="validator" class="form" action="../controller/gestionconcurso_controller.php"
                      method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name"><?= $l["view_admin_name"] ?></label>
                        <input data-error="<?= $l["register_name_error"] ?>" required data-minlength="4" type="text"
                               class="form-control" name="nombre" value="<?php echo $concurso->getTitulo(); ?>"></br>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="description"><?= $l["view_admin_contestInfo"] ?></label>
                        <textarea class="form-control" name="descripcion"
                                  rows="5"><?php echo $concurso->getDescripcion(); ?></textarea></br>
                    </div>
                    <div class="form-group">
                        <label for="avatar"><?= $l["view_admin_mainPhoto"] ?></label>
                        <input type="file" class="form-control" name="rutaportada"></br>
                    </div>
                    <input class="btn btn-success" type="submit" value="<?= $l["view_admin_send"] ?>">
                </form>

            </div>


        </div>
    </div>
</section>


<?php include("./footer.php"); ?>

<!-- Scroll-up -->
<div class="scroll-up">
    <ul>
        <li><a href="#header"><i class="fa fa-angle-up"></i></a></li>
    </ul>
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
<script type="text/javascript" src="../js/validator.min.js"></script><!-- isotope -->


</body>
</html>