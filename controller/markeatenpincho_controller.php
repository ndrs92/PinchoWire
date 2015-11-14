<?php

    include_once "../model/pinchoMapper.php";

    if($_GET["markeatenpincho_probado_idpincho"] && $_GET["markeatenpincho_probado_idmail"]){
        //All params for delete a comment OK

        PinchoMapper::toggleMarcado($_GET["markeatenpincho_probado_idpincho"],$_GET["markeatenpincho_probado_idmail"]);


        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $relpath = '../view/list.php';
        header("Location: http://$host$uri/$relpath");

    }else{
        //Sketchy, should be handled by javascript, user is not supposed to be here
        echo "you should not end here. Check javascript form verification";
    }
?>