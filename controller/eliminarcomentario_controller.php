<?php

include_once "../model/juradopopular.php";
include_once "../model/pincho.php";
session_start();

if(get_class($_SESSION["user"])!="JuradoPopular"){
    header("Location: ../view/403.php");
    exit;
}

if($_GET["delcomment_comment_id"] && $_GET["delcomment_comment_idpincho"]){
    //All params for delete a comment OK

    $_SESSION["user"]->eliminar_comentario($_GET["delcomment_comment_id"]);

    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $relpath = '../view/viewPincho.php';
    header("Location: http://$host$uri/$relpath?id=".$_GET["delcomment_comment_idpincho"]);

}else{
    //Sketchy, should be handled by javascript, user is not supposed to be here
    echo "you should not end here. Check javascript form verification";
}

?>