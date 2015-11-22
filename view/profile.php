<?php
include_once "../controller/profile_controller.php";
include_once "../resources/code/lang_coverage.php";
include_once "../model/juradopopular.php";
include_once "../model/juradoprofesional.php";
include_once "../model/establecimiento.php";
include_once "../model/administrador.php";

session_start();

if (isEstablishment($_GET["idemail"])) {
    $user = verPerfil($_GET["idemail"]);
} else {
    if (isset($_SESSION["user"]) && (get_class($_SESSION["user"]) == "Administrador" || $_SESSION["user"]->getIdemail() == $_GET["idemail"])) {
        $user = verPerfil($_GET["idemail"]);
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
                    <h1><?= $l["view_profile_title"] ?></h1>
                    <span class="st-border"></span>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="team-member">
                    <div class="member-image">
                        <img class="img-responsive" src="../<?php echo $user->getRutaavatar(); ?>" alt="">
                    </div>
                    <div class="member-info">
                        <h4><? echo $user->getNombre(); ?></h4>
                        <span><?= strtoupper(get_class($user)) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-sm-12">

                <form role="form" action="../controller/profile_controller.php" method="POST"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name"><?php echo $l["view_profile_editmail"] ?></label>

                        <div class="well well-sm"><? echo $user->getIdemail(); ?> </div>
                    </div>
                    <div class="form-group">
                        <?php
                        if (isset($_SESSION["user"]) && ($_SESSION["user"]->getIdemail() == $_GET["idemail"] || get_class($_SESSION["user"]) == "Administrador")) {
                            echo "<label for='name'>";
                            echo $l["view_profile_editpass"];
                            echo "</label>";
                            echo "<input type='password' class='form-control' name='profile_pass' value='" . $user->getContrasena() . "'/>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="name"><?php echo $l["view_profile_editname"] ?></label>
                        <input class="form-control" type="text" name="profile_name"
                               value="<? echo $user->getNombre(); ?>"/>
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
                                      name="profile_curriculum"><? echo $user->getCurriculum(); ?></textarea>
                        </div>

                    <?php } ?>

                    <?php if ($user->getTable() == "establecimiento") {
                        ?>
                        <div class="form-group">
                            <label for="name"><?php echo $l["view_profile_address"] ?></label>
                            <input class="form-control" type="text" name="profile_direccion"
                                   value="<? echo $user->getDireccion(); ?>"/>
                        </div>

                        <div class="form-group">
                            <label for="name"><?php echo $l["view_profile_web"] ?></label>
                            <input class="form-control" type="text" name="profile_web"
                                   value="<? echo $user->getWeb(); ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="name"><?php echo $l["view_profile_schedule"] ?></label>
                            <input class="form-control" type="text" name="profile_horario"
                                   value="<? echo $user->getHorario(); ?>"/>
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
                            <input class="form-control" type="text" name="profile_geoloc"
                                   value="<? echo $user->getGeoloc(); ?>"/>
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
                               value="<? echo $user->getRutaimagen(); ?>"/>
                        <br/>
                    <?php } ?>
                    <input class="btn btn-default" type="hidden" name="avatar"
                           value="<? echo $user->getRutaavatar(); ?>"/>

                    <input class="btn btn-default" type="hidden" name="profile_mail"
                           value="<? echo $user->getIdemail(); ?>"/>
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
<script>

    var map;
    function initMap() {
        var myLatLng = {lat: <?= $lat ?>, lng: <?= $lng ?>};

        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            scrollwheel: false,
            zoom: 17
        });

        // Create a marker and set its position.
        var marker = new google.maps.Marker({
            map: map,
            position: myLatLng,
            title: 'Hello World!'
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApOBPY5dso4qlFcJUfiwwALFGBmdlWPGo&callback=initMap"
        async defer></script>


</body>
</html>

