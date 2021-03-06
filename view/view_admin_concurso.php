<?php
include_once __DIR__."/../resources/code/models.php";
include_once __DIR__."/../resources/code/lang_coverage.php";

include_once __DIR__."/../controller/pincho_controller.php";
include_once __DIR__."/../controller/pw.php";
include_once __DIR__."/../controller/pwctrl_user.php";
include_once __DIR__."/../controller/pw.php";

if (!isset($_SESSION)) session_start();

if (get_class($_SESSION["user"]) != "Administrador") {
    header("Location: 403.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administración de la información del Concurso</title>

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
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
    href="../../images/icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
    href="../../images/icon/apple-touch-icon-114-precomposed.png">



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
                        <a href="view_administrar.php"><div class="back-button"></div></a><h1><?= $l["view_admin_infoManage"] ?></h1>
                        <span class="st-border"></span>
                    </div>
                </div>
                <?php
                $concurso = new Concurso();
                $estado = $concurso->getEstado();
                ?>
                <div class="col-md-12 competition-state">
                    <?php
                    switch($estado){
                        case 0:
                        echo "<h3>".$l["view_admin_1"]."</h3>";
                        echo '<div class="progress progress-striped active">';
                        echo '<div class="progress-bar" style="width: 33%"></div>';
                        echo '</div>';
                        echo '<button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#limit">'.$l["view_admin_1_bt"].'</button>';
                        break;

                        case 1:
                        echo "<h3>".$l["view_admin_2"]."</h3>";
                        echo '<div class="progress progress-striped active">';
                        echo '<div class="progress-bar" style="width: 66%"></div>';
                        echo '</div>';
                        echo '<button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#limitWinner">'.$l["view_admin_1_bt"].'</button>';
                        
                        //echo '<a href="../controller/pw.php?increment=true&controller=competition&action=changeState" class="btn btn-primary btn-sm pull-right">'.$l["view_admin_2_bt"].'</a>';
                        break;

                        case 2:
                        echo "<h3>".$l["view_admin_3"]."</h3>";
                        echo '<div class="progress progress-striped active">';
                        echo '<div class="progress-bar" style="width: 100%"></div>';
                        echo '</div>';
                        break;

                        default:
                        break;
                    }
                    ?>
                </div>


                <div class="admin-user-table">
                    <form data-toggle="validator" class="form" action="../controller/pw.php?controller=competition&action=gestionConcurso"
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
<?php include_once __DIR__."/../resources/code/alertify.php"; ?>

</body>
</html>


<!-- Modal -->
<div id="limit" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content search">
            <form role="form" action="../controller/pw.php?controller=competition&action=changeState" method="post"> 
                <div class="form-group has-feedback has-feedback-left search-form">
                    <input type="number" min="1" name="num" class="form-control input-lg" placeholder="<?= $l["view_admin_limit"] ?>" />
                    <i class="form-control-feedback fa fa-check-square-o"></i>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="limitWinner" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content search">
            <form role="form" action="../controller/pw.php?controller=competition&action=changeState" method="post"> 
                <div class="form-group has-feedback has-feedback-left search-form">
                    <input type="number" min="1" name="num" class="form-control input-lg" placeholder="<?= $l["view_admin_limitWinner"] ?>" />
                    <i class="form-control-feedback fa fa-check-square-o"></i>
                </div>
            </form>
        </div>
    </div>
</div>
