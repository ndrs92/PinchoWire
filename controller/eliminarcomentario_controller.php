<?php

include_once "../model/juradopopular.php";
include_once "../model/pincho.php";
session_start();

if($_GET["delcomment_comment_id"]){
    //All params for delete a comment OK

    $_SESSION["user"]->eliminar_pincho($_GET["delcomment_comment_id"]);

    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $relpath = '../view/viewPincho.php';
    header("Location: http://$host$uri/$relpath");

}else{
    //Sketchy, should be handled by javascript, user is not supposed to be here
    echo "you should not end here. Check javascript form verification";
}

?>