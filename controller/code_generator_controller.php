<?php

include_once "../model/pincho.php";

$target = Pincho::getByIdnombre($_GET["idnombre"]);

$target->createCodes(5);


$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$relpath = '../view/view_establishment_codes.php'; 

header("Location: http://$host$uri/$relpath");

?>