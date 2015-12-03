<?php

include_once "../model/pincho.php";
include_once("../resources/code/bd_manage.php");
include_once "../model/establecimiento.php";

if(!isset($_SESSION)) session_start();

if(get_class($_SESSION["user"])!="Establecimiento"){
    header("Location: ../view/403.php");
    exit;
}

$target = Pincho::getByIdnombre($_POST["idnombre"]);

global $connectHandler;
$connectHandler->autocommit(false);
try {
    $target->createCodes($_POST["numCodes"]);
    $connectHandler->commit();
}
catch (Exception $e){
    $connectHandler->rollback();
}
$connectHandler->autocommit(true);
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$relpath = '../view/view_establishment_codes.php'; 

header("Location: http://$host$uri/$relpath");

?>