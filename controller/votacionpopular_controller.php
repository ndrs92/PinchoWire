<?php
include_once "../model/juradopopular.php";
include_once("../resources/code/bd_manage.php");
include_once "pincho_controller.php";

if(!isset($_SESSION)) session_start();

if(get_class($_SESSION["user"]) != "JuradoPopular"){
    header("Location: ../view/403.php");
    exit;
}

if($_POST["votacionpopular_codigo1"] && $_POST["votacionpopular_codigo2"] && $_POST["votacionpopular_codigo3"] && $_POST["votacionpopular_idpincho"]){
    //All params for vote a pincho OK

    //$_SESSION["user"]->votar_pincho($_POST["votacionpopular_idpincho"]);
    $pinchoCodigo1 = PinchoMapper::getPinchoIdFromCode($_POST["votacionpopular_codigo1"]);
    $pinchoCodigo2 = PinchoMapper::getPinchoIdFromCode($_POST["votacionpopular_codigo2"]);
    $pinchoCodigo3 = PinchoMapper::getPinchoIdFromCode($_POST["votacionpopular_codigo3"]);
    $relpath = '../view/view_votacionpopular.php?idpincho='. $_POST["votacionpopular_idpincho"];

    if( $pinchoCodigo1 == $_POST["votacionpopular_idpincho"] ||
        $pinchoCodigo2 == $_POST["votacionpopular_idpincho"] ||
        $pinchoCodigo3 == $_POST["votacionpopular_idpincho"]) {
        //Uno de los pinchos es el pincho por el cual se quiere votar
        if(isset($pinchoCodigo1,$pinchoCodigo2,$pinchoCodigo3)) {
            //Todos los códigos existen en la BD
            if (($pinchoCodigo1 != $pinchoCodigo2) && ($pinchoCodigo1 != $pinchoCodigo3) && ($pinchoCodigo2 != $pinchoCodigo3)) {
                //Todos los codigos son de pinchos diferentes
                if((!PinchoMapper::isRetrieved($_POST["votacionpopular_codigo1"])) &&
                   (!PinchoMapper::isRetrieved($_POST["votacionpopular_codigo2"])) &&
                   (!PinchoMapper::isRetrieved($_POST["votacionpopular_codigo3"]))){
                    //Ninguno de los pinchos ha sido usado ya
                    global $connectHandler;
                    try {

                        $connectHandler->autocommit(false);
                        $_SESSION["user"]->votar_pincho($_POST["votacionpopular_idpincho"]);
                        PinchoMapper::burnCode($_POST["votacionpopular_codigo1"], $_SESSION["user"]->getIdemail());
                        PinchoMapper::burnCode($_POST["votacionpopular_codigo2"], $_SESSION["user"]->getIdemail());
                        PinchoMapper::burnCode($_POST["votacionpopular_codigo3"], $_SESSION["user"]->getIdemail());

                        if( !PinchoMapper::isProbado($pinchoCodigo1, $_SESSION["user"]->getIdemail()) ){
                            PinchoMapper::toggleMarcado($pinchoCodigo1, $_SESSION["user"]->getIdemail());
                        }
                        if( !PinchoMapper::isProbado($pinchoCodigo2, $_SESSION["user"]->getIdemail()) ){
                            PinchoMapper::toggleMarcado($pinchoCodigo2, $_SESSION["user"]->getIdemail());
                        }
                        if( !PinchoMapper::isProbado($pinchoCodigo3, $_SESSION["user"]->getIdemail()) ){
                            PinchoMapper::toggleMarcado($pinchoCodigo3, $_SESSION["user"]->getIdemail());
                        }
                        $connectHandler->commit();

                        $relpath = '../view/list.php';
                        $_SESSION["vote"] = "success";
                    }
                    catch (Exception $e){
                        $connectHandler->rollback();
                    }
                    $connectHandler->autocommit(true);
                }
                else {
                    $_SESSION["vote"] = "burned_code";
                    echo "Algun código está canjeado ya";
                }
            }
            else {
                $_SESSION["vote"] = "repeated_code";
                echo "Existe más de 1 codigo del mismo pincho";
            }
        }
        else {
            $_SESSION["vote"] = "invalid_code";
            echo "Algún codigo es invalido";
        }
    }
    else{
        $_SESSION["vote"] = "incorrect_pincho_code";
        echo "No se ha introducido un codigo del pincho que se quiere votar";
    }
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("Location: http://$host$uri/$relpath");
    echo "$relpath";
}else{
    header("Location: ../view/404.php");
    exit();//Sketchy, should be handled by javascript, user is not supposed to be here
    //echo "you should not end here. Check javascript form verification";
}
?>