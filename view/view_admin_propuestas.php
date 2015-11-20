<?php
include_once "../resources/code/lang_coverage.php";
include_once "../controller/pincho_controller.php";
include_once "../controller/general_user_controller.php";
include_once "../model/pincho.php";
include_once "../model/administrador.php";
session_start();
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

    <title>Administración de Propuestas</title>
    
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
                        <h1>Administración de Propuestas</h1>
                        <span class="st-border"></span>
                    </div>
                </div>
                

                <div class="admin-user-table">
                    <table class="table table-stripped">
                        <thead>
                            <td>Establecimiento encargado</td>
                            <td>Nombre</td>
                            <td>Descripcion</td>
                            <td>Ingredientes</td>
                            <td>Estado</td>
                            <td>Acciones</td>
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
                                        echo "<td>Pendiente</td>";
                                        break;
                                        case 1:
                                        echo "<td>Denegado</td>";
                                        break;
                                        default:
                                        echo "<td>Error por aqui</td>";
                                        break;
                                    }

                                    switch ($row->getEstadopropuesta()) {
                                        case 0:
                                        echo "<td>
                                        <a class='btn btn-success' href='../controller/gestionpropuesta_controller.php?action=accept_pincho&idnombre=" . $row->getIdnombre() . "'>Aceptar</a>
                                        <a class='btn btn-danger' href='../controller/gestionpropuesta_controller.php?action=deny_pincho&idnombre=" . $row->getIdnombre() . "'>Denegar</a>
                                    </td>";
                                    break;
                                    case 1:
                                    echo "<td><a class='btn btn-success' href='../controller/gestionpropuesta_controller.php?action=set_pendant&idnombre=" . $row->getIdnombre() . "'>Restablecer para revision</a></td>";
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


</body>
</html>