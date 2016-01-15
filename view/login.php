<?php
include_once __DIR__."/../resources/code/models.php";
include_once __DIR__."/../resources/code/lang_coverage.php";

include_once __DIR__."/../controller/pincho_controller.php";

if(!isset($_SESSION)) session_start();

if(!empty($_SESSION["user"])){
    header("Location: list.php");
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $l["login_title"] ?></title>
    
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
                        <a href="list.php"><div class="back-button"></div></a><h1><?= $l["login_title"] ?></h1>
                        <p class="register-description" ><?= $l["login_desc"]?></p>
                        <span class="st-border"></span>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <h1>Credenciales: </h1>
                    <?php
                    if (isset($_SESSION["login"])) {
                        if ($_SESSION["login"] == "fail")
                            echo "<p class='error-message'>". $l["login_incorrect"] ."</p>";
                        if ($_SESSION["login"] == "banned")
                            echo "<p class='error-message'>". $l["login_baned"] ."</p>";
                        session_unset();
                    }
                    ?>
                    <br/>

                    <form data-toggle="validator" role="form" action="../controller/pw.php?controller=user&action=login" method="POST">
                        <div class="form-group">
                            <label for="email"><?= $l["login_email"] ?></label>
                            <div class="input-group">
                                <input data-error="<?= $l["register_email_error"] ?>" required data-minlength="7" type="email" class="form-control" name="login_user_login">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="pwd"><?= $l["login_password"] ?></label>
                            <div class="input-group">
                                <input data-error="<?= $l["register_password_error_length"] ?>" required data-minlength="8"  type="password" class="form-control" name="login_user_pass">
                                <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <input id="login-button" class="btn btn-success" type="submit" value="Log In" />
                    </form>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-7">
                    <h1><?= $l["login_info_welcome"] ?></h1>
                    <p><?= $l["login_info_loginfeatures"] ?></p>
                    <div style="padding-left: 15px;">
                        <h5><?= $l["login_info_as_popular"] ?></h5>
                        <p><?= $l["login_info_popular_info"] ?></p>
                        <h5><?= $l["login_info_as_professional"] ?></h5>
                        <p><?= $l["login_info_professional_info"] ?></p>
                        <h5><?= $l["login_info_as_establishment"] ?></h5>
                        <p><?= $l["login_info_establishment_info"] ?></p>
                    </div>
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
    <?php include_once __DIR__."/../resources/code/alertify.php"; ?>

</body>
</html>