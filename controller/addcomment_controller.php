<?php

include_once "../model/juradopopular.php";
include_once "../model/pincho.php";


if($_POST["addcomment_comment_name"] && $_POST["addcomment_comment_idpincho"]){
    //All params for add a comment OK

    $user = new JuradoPopular($_SESSION["mail"],$_SESSION["name"],$_SESSION["pass"],$_SESSION["avatar"]);
    //Saving in user the "jurado popular" who wants to comment

    Establecimiento::enviar_propuesta($_POST["enviarpropuesta_propuesta_nombre"], $_POST["enviarpropuesta_propuesta_descripcion"], $_POST["enviarpropuesta_propuesta_ingredientes"], $_POST["enviarpropuesta_propuesta_precio"]);
    $user->comentar_pincho($_POST["addcomment_comment_idpincho"],$_POST["addcomment_comment_name"]);

    //should redirect to pincho page

}else{
    //Sketchy, should be handled by javascript, user is not supposed to be here
    echo "you should not end here. Check javascript form verification";
}

?>