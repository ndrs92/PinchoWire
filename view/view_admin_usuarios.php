<?php
include_once "../resources/code/models.php";
include_once "../resources/code/lang_coverage.php";

include_once "../controller/pincho_controller.php";
include_once "../controller/pw.php";
include_once "../controller/pwctrl_user.php";



if(!isset($_SESSION)) session_start();
if(get_class($_SESSION["user"])!="Administrador"){
    header("Location: 403.php");
    exit;
}
$allUsers = UserController::getAllUsuarios();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $l["view_admin_userManage"] ?></title>
    
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
                        <h1><?= $l["view_admin_userManage"] ?></h1>
                        <span class="st-border"></span>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3">                    
                        <a href="register_professional.php"><button class="btn btn-success btn-register-professional" ><?= $l["view_admin_register"] ?></button></a>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input id="filter" type="text" onkeyup="filterAdminUsers()" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="admin-user-table">

                    <div class="row">
                      <table class="table table-striped firefix">
                        <thead>
                            <td><?= $l["view_admin_email"] ?></td>
                            <td><?= $l["view_admin_name"] ?></td>
                            <td><?= $l["view_admin_userType"] ?></td>
                            <td><?= $l["view_admin_status"] ?></td>
                            <td><?= $l["view_admin_actions"] ?></td>
                        </thead>
                        <tbody >
                            <?php
                            if(isset($allUsers)) {
                                foreach ($allUsers as $user) {
                                    echo "<tr class='row-to-filter'>";
                                    echo "<td class='data-to-filter'>" . $user->getIdemail() . "</td>";
                                    echo "<td class='data-to-filter'>" . $user->getNombre() . "</td>";
                                    echo "<td class='data-to-filter'>" . get_class($user) . "</td>";
                                    if ($user->getBaneado() == '1')
                                        echo "<td class='data-to-filter'>". $l["view_admin_banned"] ."</td>";
                                    else
                                        echo "<td class='data-to-filter'>". $l["view_admin_active"] ."</td>";
                                    echo "<td>";
                                    if (get_class($user) == "JuradoPopular") {
                                        echo "<a href='../controller/pw.php?controller=user&action=edit&idemail=" . $user->getIdemail() . "'><button class='btn btn-default edit-button'>". $l["view_admin_edit"] ."</button></a>";
                                        if ($user->getBaneado()) {
                                            echo "<a href='../controller/pw.php?controller=user&action=unban&idemail=" . $user->getIdemail() . "'><button class='btn btn-success'>". $l["view_admin_unban"] ."</button></a>";
                                        } else {
                                            echo "<a href='../controller/pw.php?controller=user&action=ban&idemail=" . $user->getIdemail() . "'><button class='btn btn-warning'>". $l["view_admin_ban"] ."</button></a>";
                                        }
                                    }

                                    if (get_class($user) == "JuradoProfesional") {
                                        echo "<a href='../controller/pw.php?controller=user&action=edit&idemail=" . $user->getIdemail() . "'><button class='btn btn-default edit-button'>". $l["view_admin_edit"] ."</button></a>";
                                        if ($user->getBaneado()) {
                                            echo "<a href='../controller/pw.php?controller=user&action=unban&idemail=" . $user->getIdemail() . "'><button class='btn btn-success'>". $l["view_admin_unban"] ."</button></a>";
                                        } else {
                                            echo "<a href='../controller/pw.php?controller=user&action=ban&idemail=" . $user->getIdemail() . "'><button class='btn btn-warning'>". $l["view_admin_ban"] ."</button></a>";
                                        }
                                    }

                                    if (get_class($user) == "Establecimiento") {
                                        echo "<a href='../controller/pw.php?controller=user&action=edit&idemail=" . $user->getIdemail() . "'><button class='btn btn-default edit-button'>". $l["view_admin_edit"] ."</button></a>";
                                        if ($user->getBaneado()) {
                                            echo "<a href='../controller/pw.php?controller=user&action=unban&idemail=" . $user->getIdemail() . "'><button class='btn btn-success'>". $l["view_admin_unban"] ."</button></a>";
                                        } else {
                                            echo "<a href='../controller/pw.php?controller=user&action=ban&idemail=" . $user->getIdemail() . "'><button class='btn btn-warning'>". $l["view_admin_ban"] ."</button></a>";
                                        }
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>

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
<script type="text/javascript" src="../js/main.js"></script><!-- My Scripts -->
<script type="text/javascript" src="../js/alertify.min.js"></script><!-- Alertify -->

</body>
</html>