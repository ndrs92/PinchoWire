<?php

include_once "../model/juradopopular.php";
include_once "../model/pincho.php";
session_start();

if($_POST["addcomment_comment_name"] && $_POST["addcomment_comment_idpincho"]){
    //All params for add a comment OK

    $_SESSION["user"]->comentar_pincho($_POST["addcomment_comment_idpincho"],$_POST["addcomment_comment_name"]);

    //should redirect to pincho page

}else{
    //Sketchy, should be handled by javascript, user is not supposed to be here
    echo "you should not end here. Check javascript form verification";
}

?>