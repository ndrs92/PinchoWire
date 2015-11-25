<?php

    include_once "../model/pinchoMapper.php";
    include_once "../model/juradopopular.php";
    include_once "../resources/code/lang_coverage.php";

    if(!isset($_SESSION)) session_start();
    if(get_class($_SESSION["user"])!="JuradoPopular"){
        header("Location: ../view/403.php");
        exit;
    }

    if($_GET["markeatenpincho_probado_idpincho"] && $_GET["markeatenpincho_probado_idemail"]){
        //All params for delete a comment OK

        PinchoMapper::toggleMarcado($_GET["markeatenpincho_probado_idpincho"],$_GET["markeatenpincho_probado_idemail"]);
        if(PinchoMapper::isProbado($_GET["markeatenpincho_probado_idpincho"],$_GET["markeatenpincho_probado_idemail"])){
            $_SESSION["alert"]["success"] = $l["alertify_eatenPincho_eaten"];
        } else {
            $_SESSION["alert"]["success"] = $l["alertify_eatenPincho_noEaten"];
        }

        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $relpath = '../view/list.php';

        header("Location: http://$host$uri/$relpath");

    }else{
        //Sketchy, should be handled by javascript, user is not supposed to be here
        header("Location: ../view/404.php");
        exit();//echo "you should not end here. Check javascript form verification";
    }
?>