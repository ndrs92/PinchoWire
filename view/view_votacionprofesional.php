<?php
include_once "../resources/code/lang_coverage.php";
include_once "../controller/pincho_controller.php";
include_once "../controller/general_user_controller.php";
include_once "../model/pincho.php";
include_once "../model/usuario.php";
include_once "../model/juradoprofesional.php";
include_once "../model/administrador.php";

if(!isset($_SESSION)) session_start();
if(get_class($_SESSION["user"])!="JuradoProfesional"){
    header("Location: 403.php");
    exit;
}
$pinchoList = $_SESSION["user"]->getPinchosAsignados();
 

?>