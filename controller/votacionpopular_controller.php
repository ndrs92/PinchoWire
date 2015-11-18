<?php
include_once "../model/juradopopular.php";
include_once "../model/pincho.php";
session_start();

if($_POST["votacionpopular_codigo1"] && $_POST["votacionpopular_codigo2"] && $_POST["votacionpopular_codigo3"] && $_POST["votacionpopular_idpincho"]){
    //All params for vote a pincho OK

    $_SESSION["user"]->votar_pincho($_POST["votacionpopular_idpincho"]);
    $pinchoCodigo1;
    $pinchoCodigo2;
    $pinchoCodigo3;

    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $relpath = '../view/viewPincho.php';
    header("Location: http://$host$uri/$relpath?id=".$_POST["addcomment_comment_idpincho"]);

}else{
    //Sketchy, should be handled by javascript, user is not supposed to be here
    echo "you should not end here. Check javascript form verification";
}
?>