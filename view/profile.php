<?php
include_once __DIR__."/../resources/code/models.php";
include_once __DIR__."/../resources/code/lang_coverage.php";

include_once __DIR__."/../controller/pw.php";
include_once __DIR__."/../controller/pwctrl_user.php";

if(!isset($_SESSION)) session_start();

if (UserController::isEstablishment($_GET["idemail"])) {
    $user = UserController::verPerfil($_GET["idemail"]);
} else {
    if (isset($_SESSION["user"]) && (get_class($_SESSION["user"]) == "Administrador" || $_SESSION["user"]->getIdemail() == $_GET["idemail"])) {
        $user = UserController::verPerfil($_GET["idemail"]);
    } else {
        header("Location: 403.php");
    }
}
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $l["appname"] ?></title>

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
                        <a href="list.php"><div class="back-button"></div></a><h1><?= $l["view_profile_title"] ?></h1>
                        <span class="st-border"></span>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="team-member">
                        <div class="member-image">
                            <img class="img-responsive" src="../<?php echo $user->getRutaavatar(); ?>" alt="">
                        </div>
                        <div class="member-info">
                            <h4><?php echo $user->getNombre(); ?></h4>
                            <span><?= strtoupper(get_class($user)) ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-sm-12">

                    <form data-toggle="validator" role="form" action="../controller/pw.php?controller=user&action=changeProfile" method="POST"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name"><?php echo $l["view_profile_editmail"] ?></label>

                        <div class="well well-sm"><?php echo $user->getIdemail(); ?> </div>
                    </div>
                    <div class="form-group">
                        <?php
                        if (isset($_SESSION["user"]) && ($_SESSION["user"]->getIdemail() == $_GET["idemail"] || get_class($_SESSION["user"]) == "Administrador")) {
                            echo "<label for='name'>";
                            echo $l["view_profile_editpass"];
                            echo "</label>";
                            echo "<input type='password' class='form-control' name='profile_pass'/>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="name"><?php echo $l["view_profile_editname"] ?></label>
                        <input data-error="<?= $l["view_profile_name_error"] ?>" required data-minlength="4" class="form-control" type="text" name="profile_name"
                        value="<?php echo $user->getNombre(); ?>"/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">

                        <?php
                        if (isset($_SESSION["user"]) && ($_SESSION["user"]->getIdemail() == $_GET["idemail"] || get_class($_SESSION["user"]) == "Administrador")) {
                            echo "<label for='name'>";
                            echo $l["view_profile_editavatar"];
                            echo "</label>";
                            echo "<input type='file' class='form-control' name='profile_avatar' accept='image/*'/>";
                        }
                        ?>
                    </div>

                    <?php if ($user->getTable() == "juradoprofesional") {
                        ?>
                        <div class="form-group">
                            <label for="name"><?php echo $l["view_profile_editcurriculum"] ?></label>
                            <textarea class="form-control" type="text"
                            name="profile_curriculum"><?php echo $user->getCurriculum(); ?></textarea>
                        </div>

                        <?php } ?>

                        <?php if ($user->getTable() == "establecimiento") {
                            ?>
                            <div class="form-group">
                                <label for="name"><?php echo $l["view_profile_address"] ?></label>
                                <input required data-error="<?= $l["view_profile_place_error"] ?>" required data-minlength="8" class="form-control" type="text" name="profile_direccion"
                                value="<?php echo $user->getDireccion(); ?>"/>
                            </div>

                            <div class="form-group">
                                <label for="name"><?php echo $l["view_profile_web"] ?></label>
                                <input required type="url" data-error="<?= $l["view_profile_url_error"] ?>" class="form-control" name="profile_web"
                                value="<?php echo $user->getWeb(); ?>"/>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="name"><?php echo $l["view_profile_schedule"] ?></label>
                                <input required type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9] - ([01]?[0-9]|2[0-3]):[0-5][0-9]" data-error="<?= $l["view_profile_schedule_error"] ?>"  class="form-control" type="text" name="profile_horario"
                                value="<?php echo $user->getHorario(); ?>"/>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="name"><?php echo $l["view_profile_image"] ?></label>
                                <?php
                                if ($user->getRutaimagen() != "")
                                    echo "<img class='img-responsive' src='../" . $user->getRutaimagen() . "' alt=''>";

                                if (isset($_SESSION["user"]) && ($_SESSION["user"]->getIdemail() == $_GET["idemail"] || get_class($_SESSION["user"]) == "Administrador")) {
                                    echo "<input type='file' class='form-control' name='profile_foto' accept='image/*'/>";
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="name"><?php echo $l["view_profile_geloc"] ?></label>
                                <input required type="text" pattern="^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?), \s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$" data-error="<?= $l["view_profile_geoloc_error"] ?>" class="form-control" type="text" name="profile_geoloc"
                                value="<?php echo $user->getGeoloc(); ?>"/>
                                <div class="help-block with-errors"></div>
                                <?php
                                $lat = explode(", ", $user->getGeoloc())[0];
                                $lng = explode(", ", $user->getGeoloc())[1];
                                ?>
                            </div>
                            <?php
                            if (isset($lat) && isset($lng)) {
                                echo '<div id="map"></div>';
                            }
                            ?>

                            <input class="btn btn-default" type="hidden" name="imagen"
                            value="<?php echo $user->getRutaimagen(); ?>"/>
                            <br/>
                            <?php } ?>
                            <input class="btn btn-default" type="hidden" name="avatar"
                            value="<?php echo $user->getRutaavatar(); ?>"/>

                            <input class="btn btn-default" type="hidden" name="profile_mail"
                            value="<?php echo $user->getIdemail(); ?>"/>
                            <input class="btn btn-default" type="hidden" name="type" value="<?php echo $user->getTable(); ?>"/>
                            <?php
                            if (isset($_SESSION["user"]) && ($_SESSION["user"]->getIdemail() == $_GET["idemail"] || get_class($_SESSION["user"]) == "Administrador")) {
                                ?>
                                <input class="btn btn-default" type="submit" name="profile_user_submit"
                                value="<?php echo $l["view_profile_save"]; ?>"/>
                                <?php
                            }

                            ?>
                        </form>


                    </div>

                </div>
            </div>
        </section>
        <!-- /PINCHOS -->


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
        <script type="text/javascript"><?php include_once __DIR__."/../js/profile-maps-php.js"; ?></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApOBPY5dso4qlFcJUfiwwALFGBmdlWPGo&callback=initMap" async defer></script>
    </body>
    </html>

