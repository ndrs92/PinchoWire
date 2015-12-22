<?php
include_once "../resources/code/models.php";
include_once "../resources/code/lang_coverage.php";

include_once "../controller/pincho_controller.php";
include_once "../controller/pwctrl_user.php";


if(!isset($_SESSION)) session_start();
if(get_class($_SESSION["user"])!="Administrador"){
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

    <title><?= $l["view_admin_proposeManage"] ?></title>
    
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
                        <a href="view_administrar.php"><div class="back-button"></div></a><h1><?= $l["view_admin_proposeManage"] ?></h1>
                        <span class="st-border"></span>
                    </div>
                </div>
                
                <div class="row">
                    <div class="admin-user-table">
                        <table class="table table-stripped firefix">
                            <thead>
                                <td><?= $l["view_admin_propertyManager"] ?></td>
                                <td><?= $l["view_admin_name"] ?></td>
                                <td><?= $l["view_admin_description"] ?></td>
                                <td><?= $l["view_admin_ingredients"] ?></td>
                                <td><?= $l["view_admin_status"] ?></td>
                                <td><?= $l["view_admin_actions"] ?></td>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($pinchoList)) {
                                    foreach ($pinchoList as $indexRow => $row) {
                                        echo "<tr>";
                                        echo "<td>" . $indexRow . "</td>";
                                        echo "<td>" . $row->getIdnombre() . "</td>";
                                        echo "<td>" . $row->getDescripcion() . "</td>";
                                        echo "<td>" . $row->getIngredientes() . "</td>";

                                        switch ($row->getEstadopropuesta()) {
                                            case 0:
                                            echo "<td>". $l["view_admin_pending"] ."</td>";
                                            break;
                                            case 1:
                                            echo "<td>". $l["view_admin_denied"] ."</td>";
                                            break;
                                            default:
                                            echo "<td>Error por aqui</td>";
                                            break;
                                        }

                                        switch ($row->getEstadopropuesta()) {
                                            case 0:
                                            echo "<td>
                                            <a class='btn btn-success' href='../controller/pw.php?controller=competition&action=validate_pincho&estado=2&idnombre=" . $row->getIdnombre() . "'>". $l["view_admin_accept"] ."</a>
                                            <a class='btn btn-danger' href='../controller/pw.php?controller=competition&action=validate_pincho&estado=1&idnombre=" . $row->getIdnombre() . "'>". $l["view_admin_deny"] ."</a>
                                        </td>";
                                        break;
                                        case 1:
                                        echo "<td><a class='btn btn-success' href='../controller/pw.php?controller=competition&action=set_pendant&estado=0&idnombre=" . $row->getIdnombre() . "'>". $l["view_admin_revision"] ."</a></td>";
                                        break;
                                        default:
                                        echo "<td>Error por aqui</td>";
                                        break;
                                    }

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